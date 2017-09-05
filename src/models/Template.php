<?php

namespace dvizh\production\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "production_template".
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property string $price
 *
 * @property ProductionCategory $category
 * @property ProductionTemplateElement[] $productionTemplateElements
 */
class Template extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'production_template';
    }

    public function behaviors()
    {
        return [
            [
                'class' => \voskobovich\linker\LinkerBehavior::className(),
                'relations' => [
                    'component_ids' => 'components',
                ],
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_name'], 'required'],
            [['category_id', 'model_id'], 'integer'],
            [['price'], 'number'],
            [['component_ids'], 'each', 'rule' => ['integer']],
            [['name', 'model_name'], 'string', 'max' => 255],
            [['sku', 'code'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku' => 'Внешний код',
            'code' => 'Внутренний код',
            'category_id' => 'Категория',
            'model_id' => 'Объект',
            'model_name' => 'Объект',
            'price' => 'Цена',
            'component_ids' => 'Компоненты',
        ];
    }

    public function getName()
    {
        if(!$this->model_id) {
            return null;
        }
        
        if($modelName = $this->model_name) {
            if($product = $modelName::findOne($this->model_id)) {
                return $product->name;
            }
        }
        
        return null;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComponents()
    {
        return $this->hasMany(
                Component::className(),
                ['id' => 'component_id']
            )->viaTable(
                TemplateElement::tableName(),
                ['template_id' => 'id']
            );
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElements()
    {
        return $this->hasMany(TemplateElement::className(), ['template_id' => 'id']);
    }
    
    public function setComponentAmount($componentId, $amount)
    {
        return yii::$app->db->createCommand()->update(
                'production_template_element',
                ['amount' => $amount],
                'template_id=:id1 AND component_id=:id2',
                [':id1' => $this->id, ':id2' => $componentId]
        )->execute();
    }
    
    public function getComponentAmount($componentId)
    {
        $query = new Query;
        $relation = $query->select('amount')
                ->from('production_template_element')
                ->where(['template_id' => $this->id, 'component_id' => $componentId])
                ->one();
        
        if(isset($relation['amount'])) {
            return $relation['amount'];
        }
        
        return 0;
    }
}

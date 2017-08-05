<?php

namespace dvizh\production\models;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['category_id'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductionCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'category_id' => 'Категория',
            'price' => 'Цена',
        ];
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
}

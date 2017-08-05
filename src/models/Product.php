<?php

namespace dvizh\production\models;

use Yii;

/**
 * This is the model class for table "production_product".
 *
 * @property int $id
 * @property int $name
 * @property int $category_id
 * @property int $status
 * @property string $sku
 * @property string $code
 * @property string $price
 * @property string $model_name
 * @property int $model_id
 * @property int $amount
 * @property int $template_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ProductionCategory $category
 * @property ProductionProductElement[] $productionProductElements
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'production_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'status', 'model_id', 'amount', 'template_id', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            [['model_name', 'model_id', 'template_id'], 'required'],
            [['sku', 'code', 'model_name'], 'string', 'max' => 255],
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
            'status' => 'Статус',
            'sku' => 'Код',
            'code' => 'Код',
            'price' => 'Цена',
            'model_name' => 'Объект',
            'model_id' => 'ID объекта',
            'amount' => 'Количество',
            'template_id' => 'Шаблон',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProductionCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductionProductElements()
    {
        return $this->hasMany(ProductionProductElement::className(), ['production_id' => 'id']);
    }
}

<?php

namespace dvizh\production\models;

use Yii;

/**
 * This is the model class for table "production_product_element".
 *
 * @property int $id
 * @property int $name
 * @property string $price
 * @property string $model_name
 * @property int $model_id
 * @property int $amount
 * @property int $production_id
 *
 * @property ProductionProduct $production
 */
class ProductElement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'production_product_element';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'amount', 'production_id', 'component_id'], 'integer'],
            [['price'], 'number'],
            [['product_id'], 'required'],
            [['production_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductionProduct::className(), 'targetAttribute' => ['production_id' => 'id']],
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
            'price' => 'Цена',
            'component_id' => 'Компонент',
            'amount' => 'Количество',
            'product_id' => 'Продукт',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduction()
    {
        return $this->hasOne(ProductionProduct::className(), ['id' => 'production_id']);
    }
}

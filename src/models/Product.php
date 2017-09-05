<?php

namespace dvizh\production\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
 * @property int $template_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Category $category
 * @property ProductionProductElement[] $productionProductElements
 */
class Product extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

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
            [['name', 'category_id', 'status', 'model_id', 'template_id', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            [['model_name', 'model_id', 'template_id'], 'required'],
            [['sku', 'code', 'model_name'], 'string', 'max' => 255],
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
            'name' => 'Название',
            'category_id' => 'Категория',
            'status' => 'Статус',
            'sku' => 'Код внешний',
            'code' => 'Код внутренний',
            'price' => 'Цена',
            'model_name' => 'Объект',
            'model_id' => 'Объект',
            'template_id' => 'Шаблон',
            'created_at' => 'Произведено',
            'updated_at' => 'Обновлено',
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
        return $this->hasMany(ProductElement::className(), ['product_id' => 'id']);
    }
}

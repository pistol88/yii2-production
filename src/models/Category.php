<?php

namespace dvizh\production\models;

use Yii;

/**
 * This is the model class for table "production_category".
 *
 * @property int $id
 * @property string $name
 *
 * @property ProductionProduct[] $productionProducts
 * @property ProductionTemplate[] $productionTemplates
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'production_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplates()
    {
        return $this->hasMany(Template::className(), ['category_id' => 'id']);
    }
}

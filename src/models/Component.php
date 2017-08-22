<?php

namespace dvizh\production\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "production_component".
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $amount
 *
 */
class Component extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'production_component';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['price'], 'number'],
            [['amount'], 'integer'],
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
            'amount' => 'Остаток',
        ];
    }
    
    public function minusAmount($amount)
    {
        $this->amount = $this->amount-$amount;
        return $this->save(false);
    }
    
    public function plusAmount($amount)
    {
        $this->amount = $this->amount+$amount;
        return $this->save(false);
    }
}

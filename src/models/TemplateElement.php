<?php

namespace dvizh\production\models;

use Yii;

/**
 * This is the model class for table "production_template_element".
 *
 * @property int $id
 * @property string $name
 * @property int $template_id
 * @property int $amount
 *
 * @property ProductionTemplate $template
 */
class TemplateElement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'production_template_element';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['template_id', 'amount'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductionTemplate::className(), 'targetAttribute' => ['template_id' => 'id']],
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
            'template_id' => 'Шаблон',
            'amount' => 'Количество',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(Template::className(), ['id' => 'template_id']);
    }
}

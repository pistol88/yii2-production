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
 * @property TemplateElement $template
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
            [['template_id', 'amount', 'component_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => Template::className(), 'targetAttribute' => ['template_id' => 'id']],
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
            'amount' => 'Необходимое количество',
            'component_id' => 'Компонент',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(Template::className(), ['id' => 'template_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComponent()
    {
        return $this->hasOne(Component::className(), ['id' => 'component_id']);
    }
}

<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dvizh\production\models\Template;
use kartik\select2\Select2;

$templates = Template::find()->all();
?>

<div class="template-element-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'name')->textInput() ?>

        <?= $form->field($model, 'template_id')
            ->widget(Select2::classname(), [
            'data' => ArrayHelper::map($templates, 'id', 'name'),
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите шаблон ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <div class="row">

            <div class="col-md-4">
                <?= $form->field($model, 'amount')->textInput() ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

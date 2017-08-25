<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dvizh\production\models\Category;
use dvizh\production\models\Component;
use kartik\select2\Select2;

$productionModel = new $module->productionModel;
$products = $productionModel::find()->all();
?>

<div class="template-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->field($model, 'model_name')->textInput(['type' => 'hidden'])->label(false) ?>

        <?= $form->field($model, 'model_id')
            ->widget(Select2::classname(), [
            'data' => ArrayHelper::map($products, 'id', 'name'),
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите объект ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?= $form->field($model, 'component_ids')
            ->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Component::find()->all(), 'id', 'name'),
                'language' => 'ru',
                'theme' => Select2::THEME_BOOTSTRAP,
                'options' => [
                    'placeholder' => 'Выберите компоненты',
                    'multiple' => true,
                    'class' => 'rooms-form-input',
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>

        <?php if($components = $model->components) { ?>
            <p>Кол-во компонентов:</p>
            <ul>
                <?php foreach($components as $component) { ?>
                    <li><?=$component->name;?>: <input type="number" name="counts[<?=$component->id;?>]" value="<?=$model->getComponentAmount($component->id);?>" style="width: 50px;" /></li>
                <?php } ?>
            </ul>
        <?php } ?>

        <div class="row">

            <div class="col-md-4">
                <?= $form->field($model, 'price')->textInput() ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'sku')->textInput() ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'code')->textInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'category_id')
                    ->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Category::find()->all(), 'id', 'name'),
                    'language' => 'ru',
                    'options' => ['placeholder' => 'Выберите категорию ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>

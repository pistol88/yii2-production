<?php
use yii\helpers\Html;

$this->title = 'Обновить шаблон: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
\dvizh\production\assets\BackendAsset::register($this);
?>

<div class="template-update">

    <?= $this->render('_form', [
        'module' => $module,
        'model' => $model,
    ]) ?>
    
</div>

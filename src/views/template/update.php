<?php
use yii\helpers\Html;

$this->title = 'Обновить шаблона: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
\dvizh\shop\assets\BackendAsset::register($this);
?>

<div class="template-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
</div>

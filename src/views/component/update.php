<?php
use yii\helpers\Html;

$this->title = 'Обновить компонент: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Компоненты', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
\dvizh\production\assets\BackendAsset::register($this);
?>
<div class="category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
</div>

<?php
use yii\helpers\Html;

$this->title = 'Создать компонент';
$this->params['breadcrumbs'][] = ['label' => 'Компоненты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\dvizh\production\assets\BackendAsset::register($this);
?>
<div class="category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

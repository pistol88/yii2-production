<?php
use yii\helpers\Html;

$this->title = 'Создать продукт';
$this->params['breadcrumbs'][] = ['label' => 'Продукты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\dvizh\production\assets\BackendAsset::register($this);
?>
<div class="template-create">

    <?= $this->render('_form', [
        'module' => $module,
        'model' => $model,
    ]) ?>

</div>

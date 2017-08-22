<?php
use yii\helpers\Html;

$this->title = 'Создать шаблон';
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\dvizh\shop\assets\BackendAsset::register($this);
?>
<div class="template-create">

    <?= $this->render('_form', [
        'module' => $module,
        'model' => $model,
    ]) ?>

</div>

<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use dvizh\production\models\Category;
use kartik\grid\GridView;

$this->title = 'Продукты';
$this->params['breadcrumbs'][] = ['label' => 'Производство', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;

\dvizh\shop\assets\BackendAsset::register($this);
?>
<div class="template-index">
    
    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Создать продукт', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-4">

        </div>
    </div>

    <?=GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => '\kartik\grid\CheckboxColumn'],
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'filter' => false, 'options' => ['style' => 'width: 55px;']],
            'name',
            'category.name',
            'price',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}']
        ],
    ]); ?>

</div>

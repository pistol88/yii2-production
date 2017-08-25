<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use dvizh\production\models\Component;
use kartik\grid\GridView;

$this->title = 'Компоненты';
$this->params['breadcrumbs'][] = ['label' => 'Производство', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;

\dvizh\production\assets\BackendAsset::register($this);
?>
<div class="category-index">

    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Добавить компонент', ['create'], ['class' => 'btn btn-success']) ?>
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
            'price',
            'amount',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}']
        ],
    ]); ?>

</div>

<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use dvizh\production\models\Category;
use kartik\grid\GridView;

$this->title = 'Продукты';
$this->params['breadcrumbs'][] = ['label' => 'Производство', 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;

\dvizh\production\assets\BackendAsset::register($this);
?>
<div class="template-index">
    
    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Произвести продукт', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'label' => 'Продукт',
                'content' => function($model) {
                    return $model->name;
                }
            ],
            'price',
            [
                'attribute' =>  'category.name',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'category_id',
                    ArrayHelper::map(Category::find()->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Категория']
                ),
                'label' => 'Категория',
            ],
            [
                'attribute' => 'created_at',
                'content' => function($model) {
                    return date('d.m.Y H:i:s', $model->created_at);
                }
            ],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}']
        ],
    ]); ?>

</div>

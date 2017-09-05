<?php
use yii\helpers\Url;

$this->title = 'Производство';
$this->params['breadcrumbs'][] = $this->title;

\dvizh\production\assets\BackendAsset::register($this);

?>
<div class="model-index">
    <table class="table">
        <tr>
            <th>Шаблоны</th>
            <td>
                <a href="<?=Url::toRoute(['template/index']);?>" class="btn btn-default"><i class="glyphicon glyphicon-eye-open" /></i></a>
                <a href="<?=Url::toRoute(['template/create']);?>" class="btn btn-default"><i class="glyphicon glyphicon-plus" /></i></a>
            </td>
        </tr>
        <tr>
            <th>Категории</th>
            <td>
                <a href="<?=Url::toRoute(['category/index']);?>" class="btn btn-default"><i class="glyphicon glyphicon-eye-open" /></i></a>
                <a href="<?=Url::toRoute(['category/create']);?>" class="btn btn-default"><i class="glyphicon glyphicon-plus" /></i></a>
            </td>
        </tr>
        <tr>
            <th>Произведенная продукция</th>
            <td>
                <a href="<?=Url::toRoute(['product/index']);?>" class="btn btn-default"><i class="glyphicon glyphicon-eye-open" /></i></a>
                <a href="<?=Url::toRoute(['product/create']);?>" class="btn btn-default"><i class="glyphicon glyphicon-plus" /></i></a>
            </td>
        </tr>
        <tr>
            <th>Компоненты</th>
            <td>
                <a href="<?=Url::toRoute(['component/index']);?>" class="btn btn-default"><i class="glyphicon glyphicon-eye-open" /></i></a>
                <a href="<?=Url::toRoute(['component/create']);?>" class="btn btn-default"><i class="glyphicon glyphicon-plus" /></i></a>
            </td>
        </tr>
    </table>
</div>

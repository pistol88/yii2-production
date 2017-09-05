<?php
namespace dvizh\production;

class Module extends \yii\base\Module
{   
    public $adminRoles = ['administratior', 'superadmin', 'admin'];
    
    public $productionModel = 'dvizh\shop\models\Product';
    
    public function init()
    {
        parent::init();
    }
}

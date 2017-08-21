<?php
namespace dvizh\production;

class Module extends \yii\base\Module
{   
    public $adminRoles = ['administratior', 'superadmin', 'admin'];
    
    public function init()
    {
        parent::init();
    }
}

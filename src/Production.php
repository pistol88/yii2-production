<?php
namespace dvizh\production;

use dvizh\production\models\Template;
use dvizh\production\models\Product;
use dvizh\production\models\ProductElement;

class Production extends \yii\base\Component
{   
    public function produce($template)
    {
        $product = new Product;
        $product->name = $template->name;
        $product->category_id = $template->category_id;
        $product->status = 1;
        $product->sku = $template->sku;
        $product->code = $template->code;
        $product->price = $template->price;
        $product->model_name = $template->model_name;
        $product->model_id = $template->model_id;
        $product->template_id = $template->id;
        $product->save();
        
        foreach($template->elements as $templateElement) {
            
            $templateElement->component->minusAmount($templateElement->amount);
            
            $element = new ProductElement;
            $element->amount = $templateElement->amount;
            $element->price = $templateElement->price;
            $element->save(false);
        }
    }
}

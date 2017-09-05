<?php
namespace dvizh\production;

use dvizh\production\models\Template;
use dvizh\production\models\Product;
use dvizh\production\models\ProductElement;

class Production extends \yii\base\Component
{
    public function produce($externalProduct, $count)
    {
        $template = Template::find()->where(['model_name' => $externalProduct::className(), 'model_id' => $externalProduct->id])->one();

        if(!$template) {
            return false;
        }

        for($i = 1; $i <= $count; $i++) {
            $product = new Product;
            $product->name = $externalProduct->name;
            $product->model_name = $externalProduct::className();
            $product->model_id = $externalProduct->id;
            $product->template_id = $template->id;
            $product->price = $externalProduct->price;
            $product->save();

            foreach($template->elements as $templateElement) {
                $templateElement->component->minusAmount($templateElement->amount);

                $productElement = new ProductElement;
                $productElement->product_id = $product->id;
                // $productElement->price = $templateElement->price;
                $productElement->component_id = $templateElement->component->id;
                $productElement->amount = $templateElement->amount;
                $productElement->save();
            }
        }

        return true;
    }
}

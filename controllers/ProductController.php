<?php


class ProductController
{
    public function actionView($id)
    {
        $product=Product::getProductById($id);

        $images=json_decode($product['image_path']);

        require_once(ROOT . '/views/product/view.php');
        return true;
    }
}
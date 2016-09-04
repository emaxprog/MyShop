<?php

/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 21.08.16
 * Time: 11:51
 */
class CartController
{
    public function actionIndex()
    {
        $productsInCart = Cart::getProducts();
        if ($productsInCart) {

            $productsIds = array_keys($productsInCart);

            $products = Product::getProductsByIds($productsIds);

            $totalQuantity = Cart::countQuantity();

            $totalPrice = Cart::getTotalPrice($products);
        }
        require_once(ROOT . '/views/cart/index.php');
        return true;
    }

    public function actionCheckout()
    {
        $productsInCart = Cart::getProducts();

        if (!$productsInCart)
            header('Location:/');
        $result = false;
        $productsIds = array_keys($productsInCart);
        $products = Product::getProductsByIds($productsIds);

        $totalQuantity = Cart::countQuantity();
        $totalPrice = Cart::getTotalPrice($products);

        if (!User::isGuest()) {
            $customerId = User::checkLogged();
            $customer = User::getCustomerById($customerId);
        } else
            header('Location:/user/login');

        if (isset($_POST['submit'])) {
            $result = Order::save($customerId,$productsInCart);
            if ($result) {
                $adminEmail = 'alexandr@localhost';
                $subject = 'Тема';
                $message = 'Заказ';

                $headers = "Content-type:text/plain; charset=utf-8";

                mail($adminEmail, $subject, $message, $headers);

                Cart::clear();
            }
        }

        require_once(ROOT . '/views/cart/checkout.php');
        return true;
    }

    public function actionAdd($id)
    {
        echo Cart::addProduct($id);
        return true;
    }

    public function actionDelete($id)
    {
        Cart::deleteProduct($id);
        header('Location:/cart');
    }
}

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
        $userName = $userPhone = $userComment = '';
        $errors = $result = false;

        $productsIds = array_keys($productsInCart);
        $products = Product::getProductsByIds($productsIds);

        $totalQuantity = Cart::countQuantity();
        $totalPrice = Cart::getTotalPrice($products);

        if (!User::isGuest()) {
            $userId = User::checkLogged();
            $user = User::getUserById($userId);

            $userName = $user['name'];
        } else
            $userId = false;

        if (isset($_POST['submit'])) {
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];

            if (!User::checkName($userName))
                $errors[] = 'Имя не может быть менее 2-х символов';
            if (!User::checkPhone($userPhone))
                $errors[] = 'Некорректный телефон';
            if (!$errors) {
                $result=Order::save($userName,$userPhone,$userComment,$userId,$productsInCart);
                if($result){
                    $adminEmail='alexandr@localhost';
                    $subject='Тема';
                    $message='Заказ';

                    $headers="Content-type:text/plain; charset=utf-8";

                    mail($adminEmail,$subject,$message,$headers);

                    Cart::clear();
                }
            }
        }

        require_once (ROOT.'/views/cart/checkout.php');
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

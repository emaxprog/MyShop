<?php

class Cart
{
    public static function addProduct($id)
    {
        $productsInCart = array();

        if (isset($_SESSION['products']))
            $productsInCart = $_SESSION['products'];
        if (array_key_exists($id, $productsInCart))
            $productsInCart[$id]++;
        else
            $productsInCart[$id] = 1;
        $_SESSION['products'] = $productsInCart;

        return self::countQuantity();
    }

    public static function countQuantity()
    {
        $count = 0;
        if (isset($_SESSION['products']))
            foreach ($_SESSION['products'] as $id => $quantity)
                $count += $quantity;
        return $count;
    }

    public static function getProducts()
    {
        if (isset($_SESSION['products']))
            return $_SESSION['products'];
        return false;
    }

    public static function getTotalPrice($products)
    {
        $totalPrice = 0;
        $productsInCart = self::getProducts();
        if ($productsInCart)
            foreach ($products as $product)
                $totalPrice += $product['price'] * $productsInCart[$product['product_id']];
        return $totalPrice;
    }

    public static function deleteProduct($id)
    {
        $productsInCart = self::getProducts();
        if (isset($productsInCart))
            unset($productsInCart[$id]);
        $_SESSION['products'] = $productsInCart;
    }

    public static function clear()
    {
        if (isset($_SESSION['products']))
            unset($_SESSION['products']);
    }
}
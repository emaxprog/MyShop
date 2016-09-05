<?php

class Order
{

    public static function save($customerId, $products)
    {
        try {
            $orderId = self::saveOrder($customerId);
            foreach ($products as $productId => $quantity) {
                for ($i = 0; $i < $quantity; $i++) {
                    if (!self::saveOrderProduct($orderId, $productId))
                        throw new Exception('Ошибка! Продукт №' . $productId . ' не добавлен');
                }
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public static function saveOrder($customerId)
    {
        $db = DB::getConnection();
        $sql = "INSERT INTO orders (customer_id) VALUES (:customer_id)";
        $result = $db->prepare($sql);
        $result->bindParam(':customer_id', $customerId, PDO::PARAM_INT);
        if ($result->execute())
            return $db->lastInsertId();
        return false;
    }

    public static function saveOrderProduct($orderId, $productId)
    {
        $db = DB::getConnection();
        $sql = "INSERT INTO order_product (order_id,product_id) VALUES (:order_id,:product_id)";
        $result = $db->prepare($sql);
        $result->bindParam(':order_id', $orderId, PDO::PARAM_INT);
        $result->bindParam(':product_id', $productId, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function updateOrder($id, $userName, $userPhone, $status)
    {
        $db = DB::getConnection();
        $sql = "UPDATE orders SET 
user_name=:user_name,
user_phone=:user_phone,
status=:status
WHERE id=:id
";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userPhone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getOrders()
    {
        $db = DB::getConnection();
        $sql = "SELECT order_id,name,phone,date,status FROM orders INNER JOIN customers 
ON (orders.customer_id=customers.customer_id) ORDER BY order_id DESC ";
        $result = $db->prepare($sql);
        $result->execute();
        $orders = array();
        $orders = self::getAssocArray($result);
        return $orders;
    }

    public static function getProductsIdsByOrder($orderId)
    {
        $db = DB::getConnection();
        $sql = "SELECT product_id FROM order_product WHERE order_id=:orderId GROUP BY product_id";
        $result = $db->prepare($sql);
        $result->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $result->execute();
        $productsIds = array();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $result->fetch())
            $productsIds[] = $row['product_id'];
        return $productsIds;
    }

    public static function getQuantityProduct($productId, $orderId)
    {
        $db = DB::getConnection();
        $sql = "SELECT COUNT(product_id) FROM order_product WHERE product_id=:productId AND order_id=:orderId";
        $result = $db->prepare($sql);
        $result->bindParam(':productId', $productId, PDO::PARAM_INT);
        $result->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchColumn();
    }

    public static function getQuantityProducts($orderId)
    {
        $productsIds = self::getProductsIdsByOrder($orderId);
        $productsQuantity = array();
        foreach ($productsIds as $productsId) {
            $productsId = intval($productsId);
            $productsQuantity[$productsId] = self::getQuantityProduct($productsId, $orderId);
        }
        return $productsQuantity;
    }

    private static function getAssocArray($result)
    {
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $arr = array();
        while ($row = $result->fetch()) {
            $arr[] = $row;
        }
        return $arr;
    }

    public static function getOrderById($id)
    {
        $db = DB::getConnection();
        $sql = "SELECT order_id,name,phone,status,date FROM orders INNER JOIN customers 
ON (orders.customer_id=customers.customer_id) WHERE order_id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }

    public static function deleteOrder($id)
    {
        $db = DB::getConnection();
        $sql = "DELETE FROM orders WHERE order_id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Новый заказ';
                break;
            case '2':
                return 'В обработке';
                break;
            case '3':
                return 'Доставляется';
                break;
            case '4':
                return 'Доставлено';
                break;
        }
    }


}
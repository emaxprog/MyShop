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

//    public static function save($userName, $userPhone, $userComment, $userId, $products)
//    {
//        $products = json_encode($products);
//        $db = DB::getConnection();
//        $sql = "INSERT INTO orders (user_name,user_phone,user_comment,user_id,products)
//VALUES (:userName,:userPhone,:userComment,:userId,:products)";
//        $result = $db->prepare($sql);
//        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
//        $result->bindParam(':userPhone', $userPhone, PDO::PARAM_STR);
//        $result->bindParam(':userComment', $userComment, PDO::PARAM_STR);
//        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
//        $result->bindParam(':products', $products, PDO::PARAM_STR);
//        return $result->execute();
//    }


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
        $sql = "SELECT order_id,date,status FROM orders ORDER BY id DESC ";
        $result = $db->prepare($sql);
        $result->execute();
        $orders = array();
        $orders = self::getAssocArray($result);
        return $orders;
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
        $sql = "SELECT * FROM orders WHERE id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }

    public static function deleteOrder($id)
    {
        $db = DB::getConnection();
        $sql = "DELETE FROM orders WHERE id=:id";
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
            case '1':
                return 'Доставляется';
                break;
            case '1':
                return 'Доставлено';
                break;
        }
    }


}
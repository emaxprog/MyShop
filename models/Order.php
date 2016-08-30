<?php

class Order
{
    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        $products = json_encode($products);
        $db = DB::getConnection();
        $sql = "INSERT INTO orders (user_name,user_phone,user_comment,user_id,products) 
VALUES (:userName,:userPhone,:userComment,:userId,:products)";
        $result = $db->prepare($sql);
        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userPhone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':userComment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function updateOrder($id,$userName,$userPhone,$userComment,$date,$status)
    {
        $db = DB::getConnection();
        $sql = "UPDATE orders SET 
user_name=:user_name,
user_phone=:user_phone,
user_comment=:user_comment,
date=:date,
status=:status
WHERE id=:id
";
        $result = $db->prepare($sql);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userPhone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':userComment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getOrders()
    {
        $db = DB::getConnection();
        $sql = "SELECT id,user_name,user_phone,date,status FROM orders ORDER BY id DESC ";
        $result = $db->prepare($sql);
        $result->execute();
        $orders = array();
        for ($i = 0; $row = $result->fetch(); $i++) {
            $orders[$i]['id'] = $row['id'];
            $orders[$i]['user_name'] = $row['user_name'];
            $orders[$i]['user_phone'] = $row['user_phone'];
            $orders[$i]['date'] = $row['date'];
            $orders[$i]['status'] = $row['status'];
        }
        return $orders;
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
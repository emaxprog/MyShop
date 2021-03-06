<?php

class User
{
    public static function checkName($name)
    {
        if (strlen($name) >= 2)
            return true;
        return false;
    }

    public static function checkSurname($surname)
    {
        if (strlen($surname) >= 1)
            return true;
        return false;
    }

    public static function checkEmail($name)
    {
        if (filter_var($name, FILTER_VALIDATE_EMAIL))
            return true;
        return false;
    }

    public static function checkPassword($password)
    {
        if (strlen($password) >= 6)
            return true;
        return false;
    }


    public static function checkPhone($phone)
    {
        if (strlen($phone) == 11 && preg_match('~[0-9]+~', $phone))
            return true;
        return false;
    }

    public static function checkAddress($address)
    {
        if (strlen($address) > 10)
            return true;
        return false;
    }

    public static function checkEmailExists($email)
    {
        $db = DB::getConnection();
        $sql = "SELECT COUNT(id) FROM users WHERE email=:email";
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        if (!$result->fetchColumn())
            return true;
        return false;
    }

    public static function registration($email, $password, $name, $surname, $phone, $address)
    {
        $password = md5($password);
        $db = DB::getConnection();
        $sql = "INSERT INTO customers (email,password,name,surname,phone,address) VALUES (:email,:password,:name,:surname,:phone,:address)";
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);
        $result->bindParam(':phone', $phone, PDO::PARAM_INT);
        $result->bindParam(':address', $address, PDO::PARAM_STR);
        if ($result->execute())
            return $db->lastInsertId();
        return false;
    }

    public static function checkUserData($email, $password)
    {
        $password = md5($password);
        $db = DB::getConnection();
        $sql = "SELECT customer_id FROM customers WHERE email=:email AND password=:password";
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        return $result->fetchColumn();
    }

    public static function checkAdminData($email, $password)
    {
        $password = md5($password);
        $db = DB::getConnection();
        $sql = "SELECT admin_id FROM admins WHERE email=:email AND password=:password";
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        return $result->fetchColumn();
    }

    public static function updateUserData($name, $password, $userId)
    {
        $db = DB::getConnection();
        $sql = "UPDATE users SET name=:name,password=:password WHERE id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function authAdmin($adminId)
    {
        $_SESSION['admin'] = $adminId;
    }

    public static function checkLoggedAdmin()
    {
        if (isset($_SESSION['admin']))
            return $_SESSION['admin'];
        return false;
    }

    public static function checkLogged()
    {
        if (isset($_SESSION['user']))
            return $_SESSION['user'];
        return false;
    }

    public static function getCustomerById($id)
    {
        $db = DB::getConnection();
        $sql = "SELECT * FROM customers WHERE customer_id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }

    public static function getAdminById($id)
    {
        $db = DB::getConnection();
        $sql = "SELECT * FROM admins WHERE admin_id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }

    public static function logout()
    {
        if (isset($_SESSION['user']))
            unset($_SESSION['user']);
        if (isset($_SESSION['admin']))
            unset($_SESSION['admin']);
    }

    public static function isGuest()
    {
        if (isset($_SESSION['user']) || isset($_SESSION['admin']))
            return false;
        return true;
    }

    public static function isAdmin()
    {
        $adminId = self::checkLoggedAdmin();

        if ($adminId)
            return true;
        return false;
    }
}
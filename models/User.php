<?php

class User
{
    public static function checkName($name)
    {
        if (strlen($name) >= 2)
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
        if (strlen($phone) == 11)
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

    public static function registration($name, $email, $password)
    {
        $password=md5($password);
        $db = DB::getConnection();
        $sql = "INSERT INTO users (name,email,password) VALUES (:name,:email,:password)";
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function checkUserData($email, $password)
    {
        $password=md5($password);
        $db = DB::getConnection();
        $sql = "SELECT id FROM users WHERE email=:email AND password=:password";
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

    public static function checkLogged()
    {
        if (isset($_SESSION['user']))
            return $_SESSION['user'];
        return false;
    }

    public static function getUserById($id)
    {
        $db = DB::getConnection();
        $sql = "SELECT * FROM users WHERE id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }

    public static function logout()
    {
        if (isset($_SESSION['user']))
            unset($_SESSION['user']);
    }

    public static function isGuest()
    {
        if (isset($_SESSION['user']))
            return false;
        return true;
    }

    public static function isAdmin()
    {
        $userId = self::checkLogged();

        $user = self::getUserById($userId);

        if ($user['role'] == 'admin')
            return true;
        return false;
    }
}
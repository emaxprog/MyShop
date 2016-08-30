<?php

class CabinetController
{
    public function actionIndex()
    {
        $userId = User::checkLogged();
        if (!$userId)
            header('Location:/user/login');
        if(User::isAdmin())
            header('Location:/admin');
        $user = User::getUserById($userId);

        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    public function actionEdit()
    {
        $userId=User::checkLogged();
        $user=User::getUserById($userId);

        $name=$user['name'];
        $password=$user['password'];

        $errors=$result=false;
        if (isset($_POST['submit'])) {
            $name=$_POST['name'];
            $password=$_POST['password'];

            if(!User::checkName($name))
                $errors[]='Имя не может быть менее 2-х символов';
            if(!User::checkPassword($password))
                $errors[]='Пароль не может быть менее 6-ти символов';
            if(!$errors){
                $result=User::updateUserData($name,$password,$userId);
            }
        }

        require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }
}
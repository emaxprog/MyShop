<?php

class UserController
{
    public function actionRegistration()
    {
        $categories = Category::getCategories();
        $name = $email = $password = '';
        $result = $errors = false;

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!User::checkName($name))
                $errors[] = 'Имя не может быть менее 2-х символов';
            if (!User::checkEmail($email))
                $errors[] = 'Некорректный Email';
            if (!User::checkPassword($password))
                $errors[] = 'Пароль не может быть менее 6-ти символов';
            if (!User::checkEmailExists($email))
                $errors[] = 'Данный Email уже существует';
            if (!$errors)
                $result = User::registration($name, $email, $password);
        }

        require_once(ROOT . '/views/user/registration.php');
        return true;
    }

    public function actionLogin()
    {
        $categories = Category::getCategories();
        $email = $password = '';
        $errors = false;

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (!User::checkEmail($email))
                $errors[] = 'Некорректный Email';
            if (!User::checkPassword($password))
                $errors[] = 'Пароль не может быть менее 6-ти символов';
            $userId = User::checkUserData($email, $password);
            if (!$userId)
                $errors[] = 'Неправильно введен логин или пароль';
            else {
                User::auth($userId);
                header('Location:/cabinet');
            }
        }

        require_once(ROOT . '/views/user/login.php');
        return true;
    }

    public function actionLogout()
    {
        User::logout();
        header('Location:/');
    }
}
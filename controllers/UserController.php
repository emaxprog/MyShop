<?php

class UserController
{
    public function actionRegistration()
    {
        $categories = Category::getCategories();
        $email = $password = $name = $surname = $address = '';
        $result = $errors = false;

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $address = $_POST['address'];

            if (!User::checkEmail($email))
                $errors[] = 'Некорректный Email';
            if (!User::checkPassword($password))
                $errors[] = 'Пароль не может быть менее 6-ти символов';
            if (!User::checkEmailExists($email))
                $errors[] = 'Данный Email уже существует';
            if (!User::checkName($name))
                $errors[] = 'Имя не может быть менее 2-х символов';
            if (!User::checkSurName($surname))
                $errors[] = 'Фамилия не может быть менее 1-го символов';
            if (!User::checkAddress($address))
                $errors[] = 'Введите полный адрес';
            if (!$errors)
                $result = User::registration($email, $password, $name, $surname, $address);
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
            $adminId = User::checkAdminData($email, $password);
            $userId = User::checkUserData($email, $password);
            if (!$userId && !$adminId)
                $errors[] = 'Неправильно введен логин или пароль';
            else {
                if ($userId) {
                    User::auth($userId);
                    header('Location:/cabinet');
                }
                if ($adminId) {
                    User::authAdmin($adminId);
                    header('Location:/admin');
                }
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
<?php

class SiteController
{
    public function actionIndex()
    {
        $images=Header::getAfisha();
        $categories = Category::getCategories();
        $latestProducts = Product::getProducts();
        $recommendedProducts = Product::getProducts(true, 3);
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    public function actionGuarantee()
    {
        $categories=Category::getCategories();
        $article = Article::getArticleByTitle('Гарантия');
        require_once(ROOT . '/views/site/guarantee.php');
        return true;
    }

    public function actionAbout()
    {
        $categories=Category::getCategories();
        $article = Article::getArticleByTitle('О компании');
        require_once(ROOT . '/views/site/about.php');
        return true;
    }


    public function actionFeedback()
    {
        $userName = $_POST['name'];
        $userEmail = $_POST['email'];
        $userPhone = $_POST['phone'];
        $userMessage = $_POST['message'];

        $errors = $errorName = $errorPhone = $errorEmail = false;
        if (!User::checkName($userName)) {
            $errors = true;
            $errorName = 'Имя не может быть менее 2-х символов';
        }
        if (!User::checkPhone($userPhone)) {
            $errors = true;
            $errorPhone = 'Некорректный телефон';
        }
        if (!User::checkEmail($userEmail)) {
            $errors = true;
            $errorEmail = 'Некорректный Email';
        }
        if (!$errors) {
            $adminEmail = 'alexandr@localhost';
            $subject = 'Тема';
            $message = "От кого:" . $userEmail . "\n\nТел:" . $userPhone . "\n\nСообщение:" . $userMessage;
            $headers = "Content-type:text/plain; charset=utf-8";

            mail($adminEmail, $subject, $message, $headers);
            echo 'Сообщение отправлено!';
        }
        return true;
    }
}
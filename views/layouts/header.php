<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Интернет-магазин</title>
    <link rel="icon" type="image/x-icon" href="/upload/logotype/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/template/styles/font-awesome-4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/template/styles/css/styles.css">
    <script rel="script" type="text/javascript" src="/template/js/jQuery/jquery-3.1.0.js"></script>
    <link rel="stylesheet" type="text/css" href="/template/js/jquery-ui-1.12.0.custom/jquery-ui.css">
    <script rel="script" type="text/javascript" src="/template/js/jquery-ui-1.12.0.custom/jquery-ui.min.js"></script>
    <script rel="script" type="text/javascript" src="/template/js/slider/js/jssor.slider-21.1.5.mini.js"></script>
    <script rel="script" type="text/javascript" src="/template/js/slider/slider.js"></script>
    <link rel="stylesheet" type="text/css" href="/template/js/slider/slider.css">
    <script rel="script" type="text/javascript" src="/template/js/fixed_menu.js"></script>
    <script rel="script" type="text/javascript" src="/template/js/fixed_hover.js"></script>
    <script rel="script" type="text/javascript" src="/template/js/tabs.js"></script>
    <script rel="script" type="text/javascript" src="/template/js/addProductToCart.js"></script>
    <script rel="script" type="text/javascript" src="/template/js/feedback.js"></script>
    <script rel="script" type="text/javascript" src="/template/js/menu-select.js"></script>
</head>
<body>
<?php $contacts = Header::getContacts(); ?>
<div class="wrapper-header">
    <?php if (!User::isGuest()): ?>
        <div class="header-user">
            <div class="mid">
                <a href="/cabinet"><i class="fa fa-user fa-lg"></i> Личный кабинет</a>
                <span>Здравствуйте,Александр!</span>
            </div>
        </div>
    <?php endif; ?>
    <div class="mid">
        <header class="header">
            <div class="logotype">
                <img src="/upload/logotype/logotype.png" alt="Логотип" title="Логотип">
            </div>
            <div class="contacts">
                <ul>
                    <li>
                        <i class="fa fa-phone fa-lg"></i> <?php echo $contacts[0]['content'] ?>
                    </li>
                    <li>
                        <i class="fa fa-phone fa-lg"></i> <?php echo $contacts[1]['content'] ?>
                    </li>
                </ul>
            </div>
            <div class="authorization">
                <ul>
                    <?php if (User::isGuest()): ?>
                        <li>
                            <a href="/user/login"><i class="fa fa-lock fa-lg"></i> Войти</a>
                        </li>
                        <li>
                            <a href="/user/registration"><i class="fa fa-key fa-lg"></i> Регистрация</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="/user/logout"><i class="fa fa-unlock fa-lg"></i> Выйти</a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="/cart"><i class="fa fa-shopping-cart fa-lg"></i> Корзина(<span
                                class="quantity-in-cart"><?= Cart::countQuantity() ?></span>)</a>
                    </li>
                </ul>
            </div>
        </header>
    </div>
</div>
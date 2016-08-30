<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Интернет-магазин</title>
    <link rel="icon" type="image/x-icon" href="/template/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="/template/styles/font-awesome-4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/template/styles/css/styles.css">
    <link rel="stylesheet" type="text/css" href="/template/styles/css/product/styles.css">
    <script rel="script" type="text/javascript" src="/template/js/jQuery/jquery-3.1.0.js"></script>
    <link rel="stylesheet" type="text/css" href="/template/js/jquery-ui-1.12.0.custom/jquery-ui.css">
    <script rel="script" type="text/javascript" src="/template/js/jquery-ui-1.12.0.custom/jquery-ui.min.js"></script>
    <script rel="script" type="text/javascript" src="/template/js/fixed_menu.js"></script>
    <script rel="script" type="text/javascript" src="/template/js/fixed_hover.js"></script>
    <script rel="script" type="text/javascript" src="/template/js/tabs.js"></script>
    <script rel="script" type="text/javascript" src="/template/js/image-gallery-slider/js/jssor.slider-21.1.5.mini.js"></script>
    <script rel="script" type="text/javascript" src="/template/js/image-gallery-slider/image_gallery_slider.js"></script>
    <link rel="stylesheet" type="text/css" href="/template/js/image-gallery-slider/image_gallery_slider.css">
    <script rel="script" type="text/javascript" src="/template/js/addProductToCart.js"></script>
</head>
<body>
<div class="wrapper-header">
    <?php if (!User::isGuest()): ?>
        <div class="header-user">
            <div class="mid">
                <?php if (User::isAdmin()): ?>
                    <a href="/admin"><i class="fa fa-edit"></i> Админпанель</a>
                <?php else: ?>
                    <a href="/cabinet"><i class="fa fa-user"></i> Личный кабинет</a>
                <?php endif; ?>
                <span>Здравствуйте,Александр!</span>
            </div>
        </div>
    <?php endif; ?>
    <div class="mid">
        <header class="header">
            <div class="logotype">
                <img src="/template/images/logotype.png" alt="Логотип" title="Логотип">
            </div>
            <div class="contacts">
                <ul>
                    <li>
                        <i class="fa fa-phone"></i> 8(800)000-00-00
                    </li>
                    <li>
                        <i class="fa fa-phone"></i> 8(863)52-0-00-00
                    </li>
                </ul>
            </div>
            <div class="authorization">
                <ul>
                    <?php if (User::isGuest()): ?>
                        <li>
                            <a href="/user/login"><i class="fa fa-lock"></i> Войти</a>
                        </li>
                        <li>
                            <a href="/user/registration"><i class="fa fa-key"></i> Регистрация</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="/user/logout"><i class="fa fa-unlock"></i> Выйти</a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="/cart"><i class="fa fa-shopping-cart"></i>Корзина(<span
                                class="quantity-in-cart"><?= Cart::countQuantity() ?></span>)</a>
                    </li>
                </ul>
            </div>
        </header>
    </div>
</div>
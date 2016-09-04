<?php include ROOT . "/views/layouts/header.php" ?>
    <div id="fixed"></div>
    <div class="wrapper-menu">
        <div class="mid">
            <?php include ROOT . "/views/layouts/menu.php" ?>
        </div>
    </div>
    <div class="wrapper-content">
        <div class="mid">
            <div class="center">
                <div class="cabinet">
                    <h2>Кабинет пользователя</h2>
                    <h3>Привет, <?php echo $user['name']; ?>!</h3>
                    <ul class="cabinet-menu">
                        <li><a href="/cabinet/edit"><i class="fa fa-edit fa-lg"></i> Редактировать данные</a></li>
                        <li><a href="/cart"><i class="fa fa-shopping-cart fa-lg"></i> Перейти в корзину</a></li>
                        <!--<li><a href="/cabinet/history">Список покупок</a></li>-->
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php include ROOT . "/views/layouts/footer.php" ?>
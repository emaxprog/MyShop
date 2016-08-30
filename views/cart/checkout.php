<?php include ROOT . "/views/layouts/header.php" ?>
    <div id="fixed"></div>
    <div class="wrapper-menu">
        <div class="mid">
            <?php include ROOT . "/views/layouts/menu.php" ?>
        </div>
    </div>
    <div class="wrapper-content">
        <div class="mid">
            <div class="center-cart">
                <div class="cart">
                    <h2>Корзина</h2>
                    <?php if ($result): ?>
                        <p>Заказ оформлен. Мы Вам перезвоним.</p>
                    <?php else: ?>
                        <div class="brief-info">
                            <ul>
                                <li>Товаров в корзине: <?= $totalQuantity; ?></li>
                                <li>Общая стоимость: <?= $totalPrice ?> руб.</li>
                            </ul>
                        </div>
                        <?php if ($errors): ?>
                            <div class="errors">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li>-<?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="checkout">
                            <p>Для оформления заказа заполните форму. Наш менеджер свяжется с Вами.</p>
                            <div class="form">
                                <form name="checkout-form" action="#" method="post">

                                    <label for="userName">Ваше имя</label><br>
                                    <input type="text" name="userName" id="userName" placeholder=""
                                           value="<?php echo $userName; ?>"/><br>

                                    <label for="userPhone">Номер телефона</label><br>
                                    <input type="text" name="userPhone" id="userPhone" placeholder=""
                                           value="<?php echo $userPhone; ?>"/><br>

                                    <label for="userComment">Комментарий к заказу</label><br>
                                    <textarea name="userComment" id="userComment" placeholder="Сообщение"
                                           value="<?php echo $userComment; ?>"></textarea> <br>

                                    <input type="submit" name="submit" class="btn-checkout" value="Оформить"/><br>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
<?php include ROOT . "/views/layouts/footer.php" ?>
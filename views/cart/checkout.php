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
                        <div class="checkout">
                            <p>Вы действительно хотите оформить данный заказ?</p>
                            <div class="form">
                                <form name="checkout-form" action="#" method="post">
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
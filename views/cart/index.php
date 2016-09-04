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
                    <?php if ($productsInCart): ?>
                        <div class="brief-info">
                            <ul>
                                <li>Товаров в корзине: <?= $totalQuantity; ?></li>
                                <li>Общая стоимость: <?= $totalPrice ?> руб.</li>
                            </ul>
                        </div>
                        <div class="products-in-cart">
                            <table class="table-cart">
                                <tr>
                                    <th>Код</th>
                                    <th>Название</th>
                                    <th>Стоимость (руб)</th>
                                    <th>Количество, шт</th>
                                    <th></th>
                                </tr>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td><?= $product['code']; ?></td>
                                        <td><?= $product['name']; ?></td>
                                        <td><?= $product['price']; ?></td>
                                        <td><?= $productsInCart[$product['product_id']]; ?></td>
                                        <td><a href="/cart/delete/<?= $product['product_id']; ?>"><i class="fa fa-trash-o fa-lg"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <a class="checkout" href="/cart/checkout"><i class="fa fa-credit-card fa-lg"></i> Оформить заказ</a>
                        </div>
                    <?php else: ?>
                        <div class="empty-cart">
                            <span>Корзина пуста!</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php include ROOT . "/views/layouts/footer.php" ?>
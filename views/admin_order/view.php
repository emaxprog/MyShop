<?php include ROOT . "/views/layouts/admin/header.php" ?>
<div class="wrapper-content">
    <div class="mid">

        <div class="center-admin">
            <div class="admin-view">
                <h2>Просмотр заказа #<?php echo $order['id']; ?></h2>
                <h3>Информация о заказе</h3>
                <table class="table-orders-info">
                    <tr>
                        <td>Номер заказа</td>
                        <td><?php echo $order['id']; ?></td>
                    </tr>
                    <tr>
                        <td>Имя клиента</td>
                        <td><?php echo $order['user_name']; ?></td>
                    </tr>
                    <tr>
                        <td>Телефон клиента</td>
                        <td><?php echo $order['user_phone']; ?></td>
                    </tr>
                    <tr>
                        <td>Комментарий клиента</td>
                        <td><?php echo $order['user_comment']; ?></td>
                    </tr>
                    <?php if ($order['user_id'] != 0): ?>
                        <tr>
                            <td>ID клиента</td>
                            <td><?php echo $order['user_id']; ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td>Статус заказа</td>
                        <td><?php echo Order::getStatusText($order['status']); ?></td>
                    </tr>
                    <tr>
                        <td>Дата заказа</td>
                        <td><?php echo $order['date']; ?></td>
                    </tr>
                </table>
                <h3>Товары в заказе</h3>
                <table class="table-products-orders">
                    <tr>
                        <th>ID товара</th>
                        <th>Артикул товара</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Количество</th>
                    </tr>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><?php echo $product['code']; ?></td>
                            <td><?php echo $product['name']; ?></td>
                            <td>$<?php echo $product['price']; ?></td>
                            <td><?php echo $productsQuantity[$product['id']]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <a href="/admin/order/" class="btn-back"><i class="fa fa-arrow-left"></i> Назад</a>
            </div>
        </div>
    </div>
</div>

<?php include ROOT . "/views/layouts/admin/footer.php" ?>

<?php include ROOT . "/views/layouts/admin/header.php" ?>
<div class="wrapper-content">
    <div class="mid">

        <div class="center-admin">
            <div class="admin-view">
                <h2>Просмотр заказа #<?php echo $order['order_id']; ?></h2>
                <h3>Информация о заказе</h3>
                <table class="table-orders-info">
                    <tr>
                        <td>Номер заказа</td>
                        <td><?php echo $order['order_id']; ?></td>
                    </tr>
                    <tr>
                        <td>Имя клиента</td>
                        <td><?php echo $order['name']; ?></td>
                    </tr>
                    <tr>
                        <td>Телефон клиента</td>
                        <td><?php echo $order['phone']; ?></td>
                    </tr>
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
                            <td><?php echo $product['product_id']; ?></td>
                            <td><?php echo $product['code']; ?></td>
                            <td><?php echo $product['name']; ?></td>
                            <td>$<?php echo $product['price']; ?></td>
                            <td><?php echo $productsQuantity[$product['product_id']]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <a href="/admin/order/" class="btn-back"><i class="fa fa-arrow-left"></i> Назад</a>
            </div>
        </div>
    </div>
</div>

<?php include ROOT . "/views/layouts/admin/footer.php" ?>

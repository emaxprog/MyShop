<?php include ROOT . "/views/layouts/admin/header.php" ?>
    <div class="wrapper-content">
        <div class="mid">
            <div class="center-admin">
                <div class="admin">
                    <h2>Список заказов</h2>
                    <table class="table-orders">
                        <tr>
                            <th>ID заказа</th>
                            <th>Имя покупателя</th>
                            <th>Телефон покупателя</th>
                            <th>Дата оформления</th>
                            <th>Статус</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= $order['order_id']; ?></td>
                                <td><?= $order['name']; ?></td>
                                <td><?= $order['phone']; ?></td>
                                <td><?= $order['date']; ?></td>
                                <td><?= Order::getStatusText($order['status']); ?></td>
                                <td><a href="/admin/order/view/<?= $order['order_id']; ?>" title="Смотреть"><i
                                            class="fa fa-eye fa-lg"></i></a></td>
                                <td><a href="/admin/order/update/<?= $order['order_id']; ?>" title="Редактировать"><i
                                            class="fa fa-edit fa-lg"></i></a></td>
                                <td><a href="/admin/order/delete/<?= $order['order_id']; ?>" title="Удалить"><i
                                            class="fa fa-trash-o fa-lg"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include ROOT . "/views/layouts/admin/footer.php" ?>
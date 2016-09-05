<?php include ROOT."/views/layouts/admin/header.php" ?>
<div class="wrapper-content">
    <div class="mid">
        <div class="center-admin">
            <div class="admin">
                <h2>Управление товарами</h2>
                <a href="/admin/product/create" class="btn-add-product"><i class="fa fa-plus"></i> Добавить товар</a>
                <h4>Список товаров</h4>
                <table class="table-products" id="table-products-ajax">
                    <tr>
                        <th>ID товара</th>
                        <th>Артикул</th>
                        <th>Название товара</th>
                        <th>Цена</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['product_id']; ?></td>
                            <td><?php echo $product['code']; ?></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['price']; ?></td>
                            <td><a href="/admin/product/update/<?php echo $product['product_id']; ?>" title="Редактировать"><i class="fa fa-edit fa-lg"></i></a></td>
                            <td><a href="/admin/product/delete/<?php echo $product['product_id']; ?>" title="Удалить"><i class="fa fa-trash-o fa-lg"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <div class="btn-more">
                    <button id="btn-more"><i class="fa fa-arrow-down fa-lg"></i> Дальше <i class="fa fa-arrow-down fa-lg"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include ROOT."/views/layouts/admin/footer.php" ?>

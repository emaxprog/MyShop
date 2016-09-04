<?php include ROOT . "/views/layouts/admin/header.php" ?>
    <div class="wrapper-content">
        <div class="mid">
            <div class="center-admin">
                <div class="admin">
                    <h2>Список категорий</h2>

                    <a href="/admin/category/create" class="btn-add-category"><i class="fa fa-plus"></i> Добавить
                        категорию</a>

                    <table class="table-categories">
                        <tr>
                            <th>ID категории</th>
                            <th>Название категории</th>
                            <th>Название главной категории</th>
                            <th>Порядковый номер</th>
                            <th>Статус</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php foreach ($categoriesList as $category): ?>
                            <tr>
                                <td><?php echo $category['category_id']; ?></td>
                                <td><?php echo $category['name']; ?></td>
                                <td><?php echo Category::getCategoryText($category['parent_id']) ?></td>
                                <td><?php echo $category['sort_order']; ?></td>
                                <td><?php echo Category::getStatusText($category['status']); ?></td>
                                <td><a href="/admin/category/update/<?php echo $category['category_id']; ?>"
                                       title="Редактировать"><i class="fa fa-edit fa-lg"></i></a></td>
                                <td><a href="/admin/category/delete/<?php echo $category['category_id']; ?>" title="Удалить"><i
                                            class="fa fa-trash-o fa-lg"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include ROOT . "/views/layouts/admin/footer.php" ?>
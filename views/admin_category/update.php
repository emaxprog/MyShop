<?php include ROOT . "/views/layouts/admin/header.php" ?>
    <div class="wrapper-content">
        <div class="mid">
            <div class="center-admin">
                <div class="admin">
                    <h2>Редактировать категорию "<?php echo $category['name']; ?>"</h2>


                    <div class="login-form">
                        <form action="#" method="post">

                            <label>Название</label>
                            <input type="text" name="name" placeholder="" value="<?php echo $category['name']; ?>">

                            <label>Главная категория</label>
                            <select name="parent_id">
                                <option value="0">Главная категория</option>
                                <?php if (isset($parentCategories)): ?>
                                    <?php foreach ($parentCategories as $parentCategory): ?>
                                        <option <?php if ($parentCategory['id'] == $category['parent_id']) echo 'selected' ?>
                                            value="<?= $parentCategory['id'] ?>"><?= $parentCategory['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <label>Порядковый номер</label>
                            <input type="text" name="sort_order" placeholder=""
                                   value="<?php echo $category['sort_order']; ?>">

                            <label>Статус</label>
                            <select name="status">
                                <option
                                    value="1" <?php if ($category['status'] == 1) echo ' selected="selected"'; ?>>
                                    Отображается
                                </option>
                                <option
                                    value="0" <?php if ($category['status'] == 0) echo ' selected="selected"'; ?>>
                                    Скрыта
                                </option>
                            </select>

                            <br><br>

                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include ROOT . "/views/layouts/admin/footer.php" ?>
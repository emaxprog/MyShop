<?php include ROOT . "/views/layouts/admin/header.php" ?>
    <div class="wrapper-content">
        <div class="mid">
            <div class="center-admin">
                <div class="admin">
                    <h2>Добавить новую категорию</h2>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="col-lg-4">
                        <div class="login-form">
                            <form action="#" method="post">
                                <label for="name">Название</label>
                                <input type="text" name="name" id="name" placeholder="" value="">
                                <select name="parent_id">
                                    <option value="0">Главная категория</option>
                                    <?php if (isset($parentCategories)): ?>
                                        <?php foreach ($parentCategories as $parentCategory): ?>
                                            <option
                                                value="<?= $parentCategory['id'] ?>"><?= $parentCategory['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <label for="sort_order">Порядковый номер</label>
                                <input type="text" name="sort_order" id="sort_order" placeholder="" value="">
                                <label>Статус</label>
                                <select name="status">
                                    <option value="1" selected="selected">Отображается</option>
                                    <option value="0">Скрыта</option>
                                </select>
                                <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include ROOT . "/views/layouts/admin/footer.php" ?>
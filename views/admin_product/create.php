<?php include ROOT . "/views/layouts/admin/header.php" ?>
<div class="wrapper-content">
    <div class="mid">
        <div class="center-admin">
            <div class="admin-create">
                <h2>Добавить новый товар</h2>
                <?php if ($errors): ?>
                    <ul class="errors">
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <div class="create-product-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <label>Название товара</label><br>
                        <input type="text" name="name" placeholder="" value=""><br>

                        <label>Бренд</label><br>
                        <input type="text" name="brand" placeholder="" value=""><br>

                        <label>Артикул</label><br>
                        <input type="text" name="code" placeholder="" value=""><br>

                        <label>Стоимость, руб.</label><br>
                        <input type="text" name="price" placeholder="" value=""><br>

                        <label>Старая стоимость, руб.</label><br>
                        <input type="text" name="old_price" placeholder="" value=""><br>

                        <label>Категория</label><br>
                        <select name="category_id">
                            <?php foreach ($subcategories as $subcategory): ?>
                                <option value="<?php echo $subcategory['category_id']; ?>">
                                    <?php echo $subcategory['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <label>Изображение товара №<?= $i + 1; ?><?php if($i==0) echo '(Основное изображение)'?> </label><br>
                            <input type="file" name="image[]" placeholder=""><input name="delete-img-<?= $i ?>"
                                                                                    id="delete-img-<?= $i ?>"
                                                                                    value="<?= null ?>" type="checkbox">
                            <label for="delete-img-<?= $i ?>">Удалить</label><br>
                            <br>
                        <?php endfor; ?>

                        <label>Детальное описание</label><br>
                        <textarea name="description"></textarea><br>

                        <label>Наличие на складе</label><br>
                        <select name="availability"><br>
                            <option value="1" selected="selected">Да</option>
                            <option value="0">Нет</option>
                        </select>
                        <br>

                        <label>Новинка</label><br>
                        <select name="is_new"><br>
                            <option value="1" selected="selected">Да</option>
                            <option value="0">Нет</option>
                        </select>
                        <br>

                        <label>Рекомендуемые</label><br>
                        <select name="is_recommended"><br>
                            <option value="1" selected="selected">Да</option>
                            <option value="0">Нет</option>
                        </select>
                        <br>

                        <label>Статус</label><br>
                        <select name="status"><br>
                            <option value="1" selected="selected">Отображается</option>
                            <option value="0">Скрыт</option>
                        </select>
                        <br>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include ROOT . "/views/layouts/admin/footer.php" ?>

<?php include ROOT . "/views/layouts/admin/header.php" ?>
    <div class="wrapper-content">
        <div class="mid">
            <div class="center-admin">
                <div class="admin-update">
                    <h2>Редактировать товар #<?php echo $id; ?></h2>
                    <?php if ($errors): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="login-form">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <label>Название товара</label><br>
                            <input type="text" name="name" placeholder="" value="<?php echo $product['name']; ?>"><br>

                            <label>Артикул</label><br>
                            <input type="text" name="code" placeholder="" value="<?php echo $product['code']; ?>"><br>

                            <label>Стоимость, Руб.</label><br>
                            <input type="text" name="price" placeholder="" value="<?php echo $product['price']; ?>"><br>

                            <label>Старая стоимость, Руб.</label><br>
                            <input type="text" name="old_price" placeholder=""
                                   value="<?php echo $product['old_price']; ?>"><br>

                            <label>Категория</label><br>
                            <select name="category_id">
                                <?php foreach ($subcategories as $subcategory): ?>
                                    <option value="<?php echo $subcategory['id']; ?>"
                                        <?php if ($product['subcategory_id'] == $subcategory['id']) echo ' selected="selected"'; ?>>
                                        <?php echo $subcategory['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>

                            <label>Производитель</label><br>
                            <input type="text" name="brand" placeholder="" value="<?php echo $product['brand']; ?>"><br>

                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <label>Изображение товара №<?= $i + 1; ?></label><br>
                                <img src="<?= Product::getImage($imagesPaths[$i]); ?>" width="200" alt=""/><br>
                                <input type="file" name="image[]" placeholder=""><br>
                            <?php endfor; ?>
                            <br>

                            <label>Наличие на складе</label><br>
                            <select name="availability">
                                <option
                                    value="1" <?php if ($product['availability'] == 1) echo ' selected="selected"'; ?>>
                                    Да
                                </option>
                                <option
                                    value="0" <?php if ($product['availability'] == 0) echo ' selected="selected"'; ?>>
                                    Нет
                                </option>
                            </select>
                            <br>
                            <label>Новинка</label><br>
                            <select name="is_new">
                                <option value="1" <?php if ($product['is_new'] == 1) echo ' selected="selected"'; ?>>
                                    Да
                                </option>
                                <option value="0" <?php if ($product['is_new'] == 0) echo ' selected="selected"'; ?>>
                                    Нет
                                </option>
                            </select>
                            <br>

                            <label>Рекомендуемые</label><br>
                            <select name="is_recommended">
                                <option
                                    value="1" <?php if ($product['is_recommended'] == 1) echo ' selected="selected"'; ?>>
                                    Да
                                </option>
                                <option
                                    value="0" <?php if ($product['is_recommended'] == 0) echo ' selected="selected"'; ?>>
                                    Нет
                                </option>
                            </select>
                            <br>

                            <label>Статус</label><br>
                            <select name="status">
                                <option value="1" <?php if ($product['status'] == 1) echo ' selected="selected"'; ?>>
                                    Отображается
                                </option>
                                <option value="0" <?php if ($product['status'] == 0) echo ' selected="selected"'; ?>>
                                    Скрыт
                                </option>
                            </select>
                            <br>

                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить"><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include ROOT . "/views/layouts/admin/footer.php" ?>
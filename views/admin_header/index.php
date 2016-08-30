<?php include ROOT . "/views/layouts/admin/header.php" ?>
    <div class="wrapper-content">
        <div class="mid">
            <div class="center-admin">
                <div class="admin-update">
                    <h2>Редактировать шапку</h2>
                    <?php if ($errors): ?>
                        <ul class="errors">
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="header-form">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <label for="phone1">Тел:</label><br>
                            <input type="text" name="phone1" placeholder=""
                                   value="<?php echo $contacts[0]['content'] ?>"><br>
                            <label for="phone2">Тел:</label><br>
                            <input type="text" name="phone2" placeholder=""
                                   value="<?php echo $contacts[1]['content']; ?>"><br>
                            <label>Логотип</label><br>
                            <img src="/upload/logotype/logotype.png" width="200px" alt=""/><br>
                            <input type="file" name="logotype" placeholder=""><br>
                            <br>
                            <label>Иконка</label><br>
                            <img src="/upload/logotype/favicon.ico" width="64px" alt=""/><br>
                            <input type="file" name="favicon" placeholder=""><br>
                            <br>
                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить"><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include ROOT . "/views/layouts/admin/footer.php" ?>
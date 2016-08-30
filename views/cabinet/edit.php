<?php include ROOT . "/views/layouts/header.php" ?>
    <div id="fixed"></div>
    <div class="wrapper-menu">
        <div class="mid">
            <?php include ROOT . "/views/layouts/menu.php" ?>
        </div>
    </div>
    <div class="wrapper-content">
        <div class="mid">
            <div class="center">
                <div class="cabinet-edit">
                    <?php if ($result): ?>
                        <p>Данные отредактированы!</p>
                    <?php else: ?>
                        <?php if ($errors): ?>
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li> - <?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <div class="correct-form">
                            <h2>Редактирование данных</h2>
                            <form action="#" method="post">
                                <label>Имя:</label><br>
                                <input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>"/><br>
                                <label>Пароль:</label><br>
                                <input type="password" name="password" placeholder="Пароль"
                                       value="<?php echo $password; ?>"/><br>
                                <input type="submit" name="submit" class="btn btn-default" value="Сохранить"/><br>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php include ROOT . "/views/layouts/footer.php" ?>
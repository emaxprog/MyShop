<?php include ROOT . "/views/layouts/header.php" ?>
    <div id="fixed"></div>
    <div class="wrapper-menu">
        <div class="mid">
            <?php include ROOT . "/views/layouts/menu.php" ?>
        </div>
    </div>
    <div class="wrapper-content">
        <div class="mid">
            <?php include ROOT . "/views/layouts/left.php" ?>
            <div class="center">
                <div class="login">
                    <?php if ($errors): ?>
                        <ul class="errors">
                            <?php foreach ($errors as $error): ?>
                                <li>-<?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="registration-form">
                        <form action="#" method="post">
                            <label for="email">Email:</label><br>
                            <input type="email" name="email" id="email" placeholder="Введите Email"
                                   value="<?= $email; ?>"><br>
                            <label for="password">Пароль:</label><br>
                            <input type="password" name="password" id="password" placeholder="Введите пароль"
                                   value="<?= $password; ?>"><br>
                            <input type="submit" name="submit" class="btn btn-reg" value="Войти"><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include ROOT . "/views/layouts/footer.php" ?>
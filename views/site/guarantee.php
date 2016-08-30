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
                <?= $article ?>
            </div>
        </div>
    </div>
<?php include ROOT . "/views/layouts/footer.php" ?>
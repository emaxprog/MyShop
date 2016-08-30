<?php include ROOT . "/views/layouts/admin/header.php" ?>
    <div class="wrapper-content">
    <div class="mid">
        <div class="center-admin">
            <div class="admin">
                <h2>Удалить категорию #<?php echo $id; ?></h2>
                <p>Вы действительно хотите удалить эту категорию?</p>
                <form method="post">
                    <input type="submit" name="submit" value="Удалить"/>
                </form>
            </div>
        </div>
    </div>
<?php include ROOT . "/views/layouts/admin/footer.php" ?>
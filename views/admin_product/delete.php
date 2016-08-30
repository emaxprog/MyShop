<?php include ROOT . "/views/layouts/admin/header.php" ?>
<div class="wrapper-content">
    <div class="mid">
        <div class="center-admin">
            <div class="admin-delete">
                <h2>Удалить товар #<?php echo $id; ?></h2>
                <p>Вы действительно хотите удалить этот товар?</p>
                <form method="post">
                    <input type="submit" name="submit" value="Удалить" />
                </form>
            </div>
        </div>
    </div>
</div>

<?php include ROOT . "/views/layouts/admin/footer.php" ?>

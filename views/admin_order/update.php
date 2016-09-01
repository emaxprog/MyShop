<?php include ROOT . "/views/layouts/admin/header.php" ?>
<div class="wrapper-content">
    <div class="mid">
        <div class="center-admin">
            <div class="admin">
            <h2>Редактировать заказ #<?php echo $id; ?></h2>
                <div class="login-form">
                    <form action="#" method="post">
                        <label>Имя клиента</label><br>
                        <input type="text" name="userName" placeholder="" value="<?php echo $order['user_name']; ?>"><br>

                        <label>Телефон клиента</label><br>
                        <input type="text" name="userPhone" placeholder="" value="<?php echo $order['user_phone']; ?>"><br>

                        <label>Статус</label><br>
                        <select name="status">
                            <option value="1" <?php if ($order['status'] == 1) echo ' selected="selected"'; ?>>Новый заказ</option>
                            <option value="2" <?php if ($order['status'] == 2) echo ' selected="selected"'; ?>>В обработке</option>
                            <option value="3" <?php if ($order['status'] == 3) echo ' selected="selected"'; ?>>Доставляется</option>
                            <option value="4" <?php if ($order['status'] == 4) echo ' selected="selected"'; ?>>Закрыт</option>
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

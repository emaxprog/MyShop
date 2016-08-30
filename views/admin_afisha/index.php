<?php include ROOT . "/views/layouts/admin/header.php" ?>
    <div class="wrapper-content">
        <div class="mid">
            <div class="center-admin">
                <div class="admin-afisha">
                    <h2>Управление афишей</h2>
                    <?php if ($errors): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="login-form">
                        <form action="#" method="post" enctype="multipart/form-data">
                            <?php for($i=0;$i<5;$i++):?>
                                <label>Баннер №<?=$i+1;?></label><br>
                                <img src="<?=Afisha::getImage($images[$i]);?>" width="200" alt=""/><br>
                                <input type="file" name="image[]" placeholder=""><br>
                            <?php endfor;?>
                            <br>
                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить"><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include ROOT . "/views/layouts/admin/footer.php" ?>
<?php

/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 23.08.16
 * Time: 15:51
 */
class AdminAfishaController
{
    public function actionIndex()
    {
        $images = Header::getAfisha();
        $errors = false;
        if (isset($_POST['submit'])) {
            for ($i = 0; $i < 5; $i++) {
                if (is_uploaded_file($_FILES['image']['tmp_name'][$i])) {
                    if (!move_uploaded_file($_FILES['image']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . '/upload/afisha/' . $i . '.jpg'))
                        $errors[] = 'Ошибка при загрузке файла' . $i + 1;
                } else {
                    if (isset($_POST['delete-img-' . $i]))
                        unlink($_SERVER['DOCUMENT_ROOT'] . '/upload/afisha/' . $i . '.jpg');
                }
            }
            if (!$errors)
                header('Location:/admin');
        }
        require_once(ROOT . '/views/admin_afisha/index.php');
        return true;
    }
}
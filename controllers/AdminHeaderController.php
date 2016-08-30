<?php

/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 30.08.16
 * Time: 12:59
 */
class AdminHeaderController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin();
        $contacts = Header::getContacts();
        $errors = false;
        if (isset($_POST['submit'])) {
            $phone1 = $_POST['phone1'];
            $phone2 = $_POST['phone2'];
            if (strlen($phone1) < 6 || strlen($phone2) < 6)
                $errors[] = 'Введите корректные телефоны';
            if (is_uploaded_file($_FILES['logotype']['tmp_name']))
                if (!move_uploaded_file($_FILES['logotype']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/upload/logotype/logotype.png'))
                    $errors[] = 'Ошибка при загрузке логотипа';
            if (is_uploaded_file($_FILES['favicon']['tmp_name']))
                if (!move_uploaded_file($_FILES['favicon']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/upload/logotype/favicon.ico'))
                    $errors[] = 'Ошибка при загрузке иконки';
            if (!$errors){
                Header::updateContacts(1,$phone1);
                Header::updateContacts(2,$phone2);
                header('Location:/admin');
            }
        }

        require_once(ROOT . '/views/admin_header/index.php');
        return true;
    }
}
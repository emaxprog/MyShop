<?php

/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 22.08.16
 * Time: 13:26
 */
class AdminController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        require_once (ROOT.'/views/admin/index.php');
        return true;
    }
}
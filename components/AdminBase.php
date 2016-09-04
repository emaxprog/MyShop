<?php

abstract class AdminBase
{
    public static function checkAdmin()
    {
        $adminId = User::checkLoggedAdmin();

        $admin = User::getAdminById($adminId);

        if ($admin)
            return true;

        die('Access denied');
    }
}
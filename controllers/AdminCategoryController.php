<?php

/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 22.08.16
 * Time: 14:06
 */
class AdminCategoryController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        $categoriesList = Category::getCategoriesAll();

        require_once(ROOT . '/views/admin_category/index.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();
        $parentCategories = Category::getParentCategories();
        $errors = false;
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];
            $parentId = $_POST['parent_id'];


            if (!isset($name) || empty($name))
                $errors[] = 'Введите название категории';

            if (!$errors) {
                Category::createCategory($name, $sortOrder, $status, $parentId);
                header("Location: /admin/category");
            }

        }

        require_once(ROOT . '/views/admin_category/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAdmin();

        $category = Category::getCategoryById($id);

        $parentCategories = Category::getParentCategories();
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status = $_POST['status'];
            $parentId = $_POST['parent_id'];

            Category::updateCategoryById($id, $name, $sortOrder, $status, $parentId);

            header("Location: /admin/category");
        }

        require_once(ROOT . '/views/admin_category/update.php');
        return true;
    }


    public function actionDelete($id)
    {
        self::checkAdmin();

        if (isset($_POST['submit'])) {

            Category::deleteCategoryById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/category");
        }

        require_once(ROOT . '/views/admin_category/delete.php');
        return true;
    }
}
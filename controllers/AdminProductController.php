<?php

/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 22.08.16
 * Time: 14:06
 */
class AdminProductController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        $products = Product::getProductsAll();

        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }

    public function actionCreate()
    {
        self::checkAdmin();

        $categories = Category::getCategoriesAll();
        $subcategories = Category::getSubcategoriesAll();

        $errors = false;
        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            if (isset($_POST['old_price']))
                $options['old_price'] = $_POST['old_price'];
            else
                $options['old_price'] = null;

            $images = array();

            for ($i = 0; $i < 5; $i++) {
                if (is_uploaded_file($_FILES['image']['tmp_name'][$i])) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . '/upload/products/' . $_FILES['image']['name'][$i]))
                        $images[$i] = '/upload/products/' . $_FILES['image']['name'][$i];
                    else
                        $errors[] = 'Ошибка при загрузке файла' . $i + 1;
                } else {
                    $images[$i] = null;
                    if (isset($_POST['delete-img-' . $i]))
                        $images[$i] = null;
                }
            }
            $options['image_path'] = json_encode($images);

            if (!isset($options['name']) || empty($options['name']))
                $errors[] = 'Введите название продукта!';
            if (!Product::checkNumeral($options['code']))
                $errors[] = 'Некорректный артикул';
            if (!Product::checkNumeral($options['price']))
                $errors[] = 'Некорректная стоимость';
            if (!$errors) {
                Product::createProduct($options);
                header('Location:/admin/product');
            }
        }

        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }

    public function actionUpdate($id)
    {
        self::checkAdmin();

        $product = Product::getProductById($id);

        $imagesPaths = json_decode($product['image_path'], true);

        $categories = Category::getCategoriesAll();

        $subcategories = Category::getSubcategoriesAll();
        $errors = false;

        if (isset($_POST['submit'])) {
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            if (isset($_POST['old_price']))
                $options['old_price'] = $_POST['old_price'];
            else
                $options['old_price'] = null;
            if (isset($_POST['description']))
                $options['description'] = $_POST['description'];
            else
                $options['description'] = null;
            $images = array();

            for ($i = 0; $i < 5; $i++) {
                if (is_uploaded_file($_FILES['image']['tmp_name'][$i])) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $_SERVER['DOCUMENT_ROOT'] . '/upload/products/' . $_FILES['image']['name'][$i]))
                        $images[$i] = '/upload/products/' . $_FILES['image']['name'][$i];
                    else
                        $errors[] = 'Ошибка при загрузке файла' . $i + 1;
                } else {
                    $images[$i] = $imagesPaths[$i];
                    if (isset($_POST['delete-img-' . $i])) {
                        $images[$i] = null;
                        unlink($_SERVER['DOCUMENT_ROOT'] . $imagesPaths[$i]);
                    }
                }
            }

            $options['image_path'] = json_encode($images);

            if (!isset($options['name']) || empty($options['name']))
                $errors[] = 'Введите название продукта!';
            if (!Product::checkNumeral($options['code']))
                $errors[] = 'Некорректный артикул';
            if (!Product::checkNumeral($options['price']))
                $errors[] = 'Некорректная стоимость';
            if (!$errors) {
                Product::updateProduct($options, $id);
                header('Location:/admin/product');
            }
        }
        require_once(ROOT . '/views/admin_product/update.php');
        return true;
    }

    public function actionDelete($id)
    {
        self::checkAdmin();
        if (isset($_POST['submit'])) {
            Product::deleteProduct($id);
            header('Location:/admin/product');
        }

        require_once(ROOT . '/views/admin_product/delete.php');
        return true;
    }

}
<?php

class CatalogController
{
    public function actionCategory($categoryId, $page = 1)
    {
        $minPrice = 10000;
        $maxPrice = 300000;
        $brands = null;
        $categories = Category::getCategories();

        $brandsList = Product::getBrands();

//        $products = Product::getProductsBySubcategory($subcategoryId, $page);
//
//        $totalProducts = Product::getTotalProductsInSubcategory($subcategoryId);

        if (isset($_GET['min-price']) && isset($_GET['max-price'])) {
            $minPrice = $_GET['min-price'];
            $maxPrice = $_GET['max-price'];
        }
        if (isset($_GET['brand'])) {
            foreach ($_GET['brand'] as $brandItem) {
                $brands[$brandItem] = $brandItem;
            }
        }

        $products = Product::getProductsInRange($categoryId, $page, $minPrice, $maxPrice);
        $totalProducts = Product::getTotalProductsInRange($categoryId, $minPrice, $maxPrice);
        if (isset($brands)) {
            $products = Product::getProductsByBrands($categoryId, $brands, $page, $minPrice, $maxPrice);
            $totalProducts = Product::getProductsByBrands($categoryId, $brands, $page, $minPrice, $maxPrice, true);
        }
        $pagination = new Pagination($totalProducts, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/catalog/category.php');
        return true;
    }

}
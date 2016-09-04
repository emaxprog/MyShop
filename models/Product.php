<?php

class Product
{
    const SHOW_BY_DEFAULT = 3;

    public static function getProductById($id)
    {
        $db = DB::getConnection();
        $sql = "SELECT * FROM products WHERE product_id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetch();
    }


    public static function getProductsByBrands($categoryId, $brands, $page = 1, $min = 10000, $max = 300000, $total = false)
    {
        $limit = self::SHOW_BY_DEFAULT;
        $offset = ($page - 1) * $limit;

        $productsBrands = array();
        foreach ($brands as $brand) {
            $productsBrands[] = self::getProductsByBrand($categoryId, $brand, $page, $min, $max);
        }

        $productsByBrands = array();
        foreach ($productsBrands as $products) {
            foreach ($products as $product) {
                $productsByBrands[] = $product;
            }
        }
        if ($total)
            return count($productsByBrands);
//        var_dump($productsBrands);
//        var_dump($productsByBrands);
        $productsList = array();
        for ($i = 0; $i < $limit; $i++) {
            if (isset($productsByBrands[$offset + $i]))
                $productsList[] = $productsByBrands[$offset + $i];
        }

        return $productsList;
    }

    public static function getProductsByBrand($categoryId, $brand, $page = 1, $min = 10000, $max = 300000)
    {

        $limit = self::SHOW_BY_DEFAULT;
        $offset = ($page - 1) * $limit;

        $db = DB::getConnection();

        $sql = "SELECT product_id,name,brand,price,old_price,is_new,image_path FROM products WHERE status=1 
AND category_id=:categoryId 
AND price>=:minPrice AND price<=:maxPrice AND brand=:brand";

        $result = $db->prepare($sql);
        $result->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':minPrice', $min, PDO::PARAM_INT);
        $result->bindParam(':maxPrice', $max, PDO::PARAM_INT);
        $result->bindParam(':brand', $brand, PDO::PARAM_STR);
        $result->execute();

        $products = self::getAssocArray($result);
        return $products;

    }

    private static function getAssocArray($result)
    {
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $arr = array();
        while ($row = $result->fetch()) {
            $arr[] = $row;
        }
        return $arr;
    }

    public static function checkNumeral($num)
    {
        if (preg_match('~[0-9]+~', $num))
            return true;
        return false;
    }

    public static function getProductsInRange($categoryId, $page = 1, $min = 10000, $max = 300000)
    {
        $limit = self::SHOW_BY_DEFAULT;
        $offset = ($page - 1) * $limit;

        $db = DB::getConnection();
        $sql = "SELECT product_id,name,price,old_price,is_new,image_path FROM products WHERE status=1 
AND category_id=:categoryId 
AND price>=:minPrice AND price<=:maxPrice
ORDER BY id ASC LIMIT :limit OFFSET :offset";
        $result = $db->prepare($sql);
        $result->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->bindParam(':minPrice', $min, PDO::PARAM_INT);
        $result->bindParam(':maxPrice', $max, PDO::PARAM_INT);
        $result->execute();

        $products = self::getAssocArray($result);
        return $products;
    }

    public static function getAvailabilityText($availability)
    {
        switch ($availability) {
            case '1':
                return 'В наличии';
                break;
            case '0':
                return 'Под заказ';
                break;
        }
    }

    public static function getProducts($recommended = false, $limit = self::SHOW_BY_DEFAULT)
    {
        $db = DB::getConnection();
        $sql = "SELECT product_id,name,price,old_price,is_new,is_recommended,image_path FROM products WHERE status=1  ORDER BY product_id DESC LIMIT :limit";
        if ($recommended)
            $sql = "SELECT product_id,name,price,old_price,is_new,is_recommended,image_path FROM products WHERE status=1 AND is_recommended=1  ORDER BY product_id DESC LIMIT :limit";
        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->execute();
        $products = self::getAssocArray($result);
        return $products;
    }

    public static function getProductsAll()
    {
        $db = DB::getConnection();
        $result = $db->query('SELECT product_id, name, price, code FROM products ORDER BY product_id ASC');
        $products = self::getAssocArray($result);
        return $products;
    }

    public static function createProduct($options)
    {
        $db = DB::getConnection();
        $sql = 'INSERT INTO products '
            . '(name, brand, description,category_id, code, price, old_price,'
            . 'availability, is_new, is_recommended, status,image_path)'
            . 'VALUES '
            . '(:name, :brand, :description,:category_id, :code, :price, :old_price,'
            . ':availability, :is_new, :is_recommended, :status, :image_path)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':code', $options['code'], PDO::PARAM_INT);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':old_price', $options['old_price'], PDO::PARAM_INT);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':image_path', $options['image_path'], PDO::PARAM_STR);
        return $result->execute();
    }

    public static function updateProduct($options, $id)
    {

        $db = DB::getConnection();
        $sql = "UPDATE products
            SET 
                name = :name, 
                brand = :brand, 
                description = :description, 
                category_id = :category_id, 
                code = :code, 
                price = :price,
                old_price = :old_price,
                availability = :availability, 
                is_new = :is_new, 
                is_recommended = :is_recommended, 
                status = :status,
                image_path=:image_path
            WHERE product_id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':code', $options['code'], PDO::PARAM_INT);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':old_price', $options['old_price'], PDO::PARAM_INT);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':image_path', $options['image_path'], PDO::PARAM_STR);
        return $result->execute();
    }


    public static function getImage($imagePath)
    {
        $noImage = '/template/images/content/Products/noImage.jpg';

        if ($imagePath != null)
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath))
                return $imagePath;
        return $noImage;
    }


    public static function getMainImage($imagePath)
    {
        $images = json_decode($imagePath, true);
        return self::getImage($images[0]);
    }


    public static function deleteProduct($id)
    {
        $db = DB::getConnection();
        $sql = "DELETE FROM products WHERE product_id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getProductsByIds($arrayIds)
    {
        $stringIds = implode(',', $arrayIds);
        $db = DB::getConnection();
        $sql = "SELECT product_id,name,code,price FROM products WHERE product_id IN({$stringIds})";
        $result = $db->query($sql);
        $products = self::getAssocArray($result);
        return $products;
    }

    public static function getProductsBySubcategory($categoryId, $page = 1)
    {
        $limit = self::SHOW_BY_DEFAULT;
        $offset = ($page - 1) * $limit;

        $db = DB::getConnection();
        $sql = "SELECT product_id,name,price,old_price,is_new,image_path FROM products WHERE status=1 AND category_id=:categoryId ORDER
BY id ASC LIMIT :limit OFFSET :offset";
        $result = $db->prepare($sql);
        $result->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();

        $products = self::getAssocArray($result);
        return $products;
    }

    public static function getTotalProductsInSubcategory($categoryId)
    {
        $db = DB::getConnection();
        $sql = "SELECT COUNT(id) FROM products WHERE status=1 AND category_id=:categoryId";
        $result = $db->prepare($sql);
        $result->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchColumn();
    }

    public static function getTotalProductsInRange($categoryId, $min, $max)
    {
        $db = DB::getConnection();

        $sql = "SELECT COUNT(id) FROM products WHERE status=1 AND category_id=:categoryId AND price>=:minPrice AND price<=:maxPrice";
        $result = $db->prepare($sql);
        $result->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $result->bindParam(':minPrice', $min, PDO::PARAM_INT);
        $result->bindParam(':maxPrice', $max, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchColumn();
    }

    public static function getBrands()
    {
        $db = DB::getConnection();
        $sql = "SELECT brand FROM products GROUP BY brand";
        $result = $db->query($sql);
        $brands = array();
        for ($i = 0; $row = $result->fetch(); $i++) {
            $brands[$row['brand']] = $row['brand'];
        }
        return $brands;
    }
}
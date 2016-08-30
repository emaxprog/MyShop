<?php

class Category
{
    public static function getCategories()
    {
        $db = DB::getConnection();
        $sql = "SELECT id,name,parent_id FROM categories WHERE status=1 AND parent_id=0 ORDER BY sort_order ASC ";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $categories = array();
        for ($i = 0; $row = $result->fetch(); $i++) {
            $categories[$i] = $row;
            if (!empty($subcategories = self::getSubcategories($row['id'])))
                $categories[$i]['subcategories'] = $subcategories;
        }
        return $categories;
    }

    public static function createCategory($name, $sortOrder, $status, $parentId = 0)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO categories (name, sort_order, status,parent_id) '
            . 'VALUES (:name, :sort_order, :status,:parentId)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':parentId', $parentId, PDO::PARAM_INT);

        return $result->execute();
    }
    public static function deleteCategoryById($id)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM categories WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function updateCategoryById($id, $name, $sortOrder, $status,$parentId)
    {
        $db = Db::getConnection();

        $sql = "UPDATE categories
            SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status,
                parent_id=:parentId
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':parentId', $parentId, PDO::PARAM_INT);

        return $result->execute();
    }


    public static function getCategoryById($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM categories WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $result->execute();

        return $result->fetch();
    }

    public static function getParentCategories()
    {
        $db = DB::getConnection();
        $sql = "SELECT id,name FROM categories WHERE parent_id=0";
        $result = $db->query($sql);
        $categories = self::getAssocArray($result);
        return $categories;
    }

    private static function getAssocArray($result)
    {
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $arr = array();
        for ($i = 0; $row = $result->fetch(); $i++) {
            $arr[] = $row;
        }
        return $arr;
    }

    public static function getCategoriesAll()
    {
        $db = DB::getConnection();
        $sql = "SELECT id,name,sort_order,status,parent_id FROM categories ORDER BY sort_order ASC ";
        $result = $db->query($sql);
        $categories = self::getAssocArray($result);
        return $categories;
    }

    public static function getSubcategories($id)
    {
        $db = DB::getConnection();
        $sql = "SELECT id,name FROM categories WHERE status=1 AND parent_id=:id ORDER BY sort_order ASC ";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $subcategories = self::getAssocArray($result);
        return $subcategories;
    }

    public static function getSubcategoriesAll()
    {
        $db = DB::getConnection();
        $sql = "SELECT id,name,sort_order,status,parent_id FROM categories WHERE parent_id<>0 ORDER BY sort_order ASC ";
        $result = $db->query($sql);
        $subcategories = self::getAssocArray($result);
        return $subcategories;
    }


    public static function getCategoryText($id)
    {
        if (!$id)
            return 'Главная категория';
        $db = DB::getConnection();
        $sql = "SELECT name FROM categories WHERE id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchColumn();
    }

    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }
}
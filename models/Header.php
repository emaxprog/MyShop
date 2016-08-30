<?php

class Header
{
    public static function getAfisha()
    {
        $noImage = '/template/images/content/Products/noImage.jpg';
        $path = '/upload/afisha/';
        $images = array();
        for ($i = 0; $i < 5; $i++) {
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path . $i . '.jpg'))
                $images[] = $path . $i . '.jpg';
            else
                $images[] = null;
        }
        return $images;
    }

    public static function getImage($imagePath)
    {
        $noImage = '/template/images/content/Products/noImage.jpg';

        if ($imagePath != null)
            if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath))
                return $imagePath;
        return $noImage;
    }

    public static function getContacts()
    {
        $db = DB::getConnection();
        $sql = "SELECT * FROM contacts";
        $result = $db->query($sql);
        $contacts = array();
        while ($row = $result->fetch()) {
            $contacts[] = $row;
        }
        return $contacts;
    }

    public static function updateContacts($id,$phone)
    {
        $db = DB::getConnection();
        $sql = "UPDATE contacts SET content=:phone WHERE id=:id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':phone', $phone, PDO::PARAM_STR);
        return $result->execute();
    }
}
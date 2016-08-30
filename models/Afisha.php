<?php

class Afisha
{
    public static function getAfisha()
    {
        $noImage = '/template/images/content/Products/noImage.jpg';
        $path='/upload/afisha/';
        $images=array();
        for ($i=0;$i<5;$i++){
            if(file_exists($_SERVER['DOCUMENT_ROOT'].$path.$i.'.jpg'))
                $images[]=$path.$i.'.jpg';
            else
                $images[]=null;
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
}
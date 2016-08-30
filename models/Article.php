<?php

class Article
{
    public static function getArticleByTitle($title)
    {
        $db = DB::getConnection();
        $sql="SELECT text FROM articles WHERE title=:title";
        $result=$db->prepare($sql);
        $result->bindParam(':title',$title,PDO::PARAM_STR);
        $result->execute();
        return $result->fetchColumn();
    }
}
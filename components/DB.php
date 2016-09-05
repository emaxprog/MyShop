<?php

class DB
{
    public static function getConnection()
    {
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include $paramsPath;

        $dsn = "{$params['type']}:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);

        $db->query("SET NAMES utf8");

        return $db;
    }

    public static function run()
    {
        $db = self::getConnection();
        $db->query("
START TRANSACTION;
        CREATE TABLE categories
(
    category_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR (50) NOT NULL,
    sort_order INT(3) UNSIGNED NOT NULL,
    status INT(1) UNSIGNED NOT NULL,
    parent_id INT (3) UNSIGNED NOT NULL,
    PRIMARY KEY (category_id)
)ENGINE=INNODB CHARACTER SET=UTF8;

CREATE TABLE customers
(
    customer_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    name VARCHAR(30) NOT NULL,
    email VARCHAR (30) NOT NULL UNIQUE,
    password VARCHAR (32) NOT NULL,
    admin INT UNSIGNED NOT NULL,
    PRIMARY KEY(customer_id)
)ENGINE=INNODB CHARACTER SET=UTF8;


CREATE TABLE orders
(
    order_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    customer_id INT UNSIGNED NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status INT(1) UNSIGNED NOT NULL,
    PRIMARY KEY (order_id),
    FOREIGN KEY (customer_id) REFERENCES customers (customer_id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
)ENGINE=INNODB CHARACTER SET=UTF8;


CREATE TABLE products
(
    product_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    name VARCHAR(50) NOT NULL,
    brand VARCHAR(50) NOT NULL,
    description TEXT DEFAULT NULL,
    category_id INT UNSIGNED NOT NULL,
    code INT UNSIGNED NOT NULL,
    price INT UNSIGNED NOT NULL,
    old_price INT UNSIGNED DEFAULT NULL,
    availability INT(1) UNSIGNED NOT NULL,
    is_new INT(1) UNSIGNED NOT NULL,
    is_recommended INT(1) UNSIGNED NOT NULL,
    status INT(1) UNSIGNED NOT NULL,
    image_path VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY(product_id),
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
)ENGINE=INNODB CHARACTER SET=UTF8;

CREATE TABLE order_product
(
    id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    order_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (order_id) REFERENCES orders(order_id)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products (product_id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
)ENGINE=INNODB CHARACTER SET=UTF8;


CREATE TABLE admins
(
    admin_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR (30) NOT NULL,
    surname VARCHAR (30) NOT NULL,
    email VARCHAR (30) NOT NULL UNIQUE,
    password VARCHAR (32) NOT NULL,
    PRIMARY KEY (admin_id)
)ENGINE=INNODB CHARACTER SET=UTF8;


CREATE TABLE articles
(
    article_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    text TEXT NOT NULL,
    PRIMARY KEY (article_id)
)ENGINE=INNODB CHARACTER SET=UTF8;

COMMIT;
        ");
    }

    public static function rollback()
    {
        $db = self::getConnection();
        $db->query("
DROP TABLE order_product,products,orders,customers,admins,categories,articles;
        ");
    }
}
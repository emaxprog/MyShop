<?php include ROOT . "/views/layouts/header.php" ?>
    <div id="fixed"></div>
    <div class="wrapper-menu">
        <div class="mid">
            <?php include ROOT . "/views/layouts/menu.php" ?>
        </div>
    </div>
    <div class="wrapper-content">
        <div class="mid">
            <?php include ROOT . "/views/layouts/category/left.php" ?>
            <div class="center">
                <div class="latest-products">
                    <h1><?php ?></h1>
                    <div class="blocks">
                        <?php foreach ($products as $product): ?>
                            <div class="block">
                                <?php if ($product['is_new']): ?>
                                    <img src="/template/images/content/Products/new.png" class="new">
                                <?php endif; ?>
                                <a href="/product/<?= $product['product_id']; ?>">
                                    <div class="img-product">
                                        <img src="<?= Product::getMainImage($product['image_path']) ?>"
                                             alt="Apple MacBook"
                                             title="Apple MacBook">
                                    </div>
                                    <div class="about-product">
                                        <ul>
                                            <li><?= $product['name']; ?></li>
                                            <?php if ($product['old_price']): ?>
                                                <li class="old-price"><?= $product['old_price']; ?>руб.</li>
                                            <?php endif; ?>
                                            <li><?= $product['price']; ?> руб.</li>
                                        </ul>
                                    </div>
                                </a>
                                <div class="button-add-basket">
                                    <a href="#" data-id="<?= $product['product_id']; ?>" class="btn-add-to-cart"><i
                                            class="fa fa-shopping-cart fa-2x"></i>Добавить в корзину</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="pagination">
                    <?= $pagination->get(); ?>
                </div>
            </div>
        </div>
    </div>
<?php include ROOT . "/views/layouts/footer.php" ?>
<?php include ROOT."/views/layouts/product/header.php" ?>
    <div id="fixed"></div>
    <div class="wrapper-menu">
        <div class="mid">
            <?php include ROOT."/views/layouts/menu.php" ?>
        </div>
    </div>
    <div class="wrapper-content">
        <div class="mid">
            <div class="center">
                <div class="about-product">
                    <?php include ROOT . '/template/js/image-gallery-slider/image_gallery_slider.php' ?>
                    <section class="info-product">
                        <h2><?= $product['name']; ?></h2>
                        <ul>
                            <li><b>Код товара:</b> <?= $product['code']; ?></li>
                            <li><b>Цена:</b><?= $product['price']; ?>руб.</li>
                            <li><b>Наличие:</b> <?= Product::getAvailabilityText($product['availability']); ?></li>
                            <li><b>Производитель:</b> <?= $product['brand']; ?></li>
                        </ul>
                        <a href="#" data-id="<?= $product['id']; ?>" class="btn-add-to-cart"><i
                                class="fa fa-shopping-cart fa-2x"></i> Добавить в корзину</a>
                    </section>
                </div>

                <div id="tabs">
                    <ul>
                        <li><a href="#about">Описание</a></li>
                        <li><a href="#reviews">Отзывы</a></li>
                        <li><a href="#comments">Комментарии</a></li>
                        <li><a href="#views">Обзоры</a></li>
                        <li><a href="#question-answer">Вопрос-ответ</a></li>
                    </ul>
                    <div id="about">
                        <p><?= $product['description']; ?></p>
                    </div>
                    <div id="reviews">

                    </div>
                    <div id="comments">

                    </div>
                    <div id="views">

                    </div>
                    <div id="question-answer">

                    </div>
                </div>
            </div>        </div>
    </div>
<?php include ROOT."/views/layouts/footer.php" ?>
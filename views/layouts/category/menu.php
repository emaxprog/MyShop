<div class="menu-select" xmlns="http://www.w3.org/1999/html">
    <form name="form-range-price" id="form-selection" method="get">
        <div class="range-price">
            <span>Цена, руб.</span>
            <div class="price-input">
                <input type="text" name="min-price" id="min-price" value="<?= $minPrice ?>">
                -
                <input type="text" name="max-price" id="max-price" value="<?= $maxPrice ?>">
            </div>
            <div id="slider-range"></div>
        </div>
        <div class="brand">
            <span>Производитель</span>
            <div class="brand-list">
                <?php foreach ($brandsList as $brand): ?>
                    <div class="brand-row">
                        <input type="checkbox" class="checkbox" name="brand[]" id="brand-<?= $brand ?>"
                               value="<?= $brand ?>"<?php if (isset($brands[$brand])) echo 'checked' ?>>
                        <label for="brand-<?= $brand ?>"><?= $brand ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button id="btn-selection" formaction="/category/<?= $categoryId ?>/page-1">Показать</button>
    </form>
</div>
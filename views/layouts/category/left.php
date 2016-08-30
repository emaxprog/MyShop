<div class="left">
    <nav class="menu-products">
        <ul>
            <?php foreach ($categories as $category): ?>
                <li>
                    <a href="#"  class="menu-products-anchor" data-category="<?=$category['id'];?>"><?= $category['name']; ?></a>
                    <?php if (isset($category['subcategories'])): ?>
                        <ul class="sub-menu">
                            <?php foreach ($category['subcategories'] as $subcategory): ?>
                                <li>
                                    <a href="/category/<?=$subcategory['id'];?>/page-1"  data-category="<?=$subcategory['id'];?>"><?= $subcategory['name']; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <?php include ROOT."/views/layouts/category/menu.php";?>
</div>
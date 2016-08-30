
<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 940px; height: 300px; overflow: hidden; visibility: hidden;">
    <!-- Loading Screen -->
    <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
        <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
        <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
    </div>
    <div class="slides" data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 940px; height: 300px; overflow: hidden;">
        <?php foreach ($images as $image):?>
            <?php if($image==null) continue;?>
            <div data-p="112.50" style="display: none;">
            <img class="slides-img" data-u="image" src="<?=$image?>" />
        </div>
        <?php endforeach;?>
<!--        <div data-p="112.50" style="display: none;">-->
<!--            <img data-u="image" src="template/images/content/Afisha/2011-08-05notebooks-study.jpg" />-->
<!--        </div>-->
<!--        <div data-p="112.50" style="display: none;">-->
<!--            <img data-u="image" src="template/images/content/Afisha/Acer_promo.jpg" />-->
<!--        </div>-->
<!--        <div data-p="112.50" style="display: none;">-->
<!--            <img data-u="image" src="template/images/content/Afisha/нотик-купон-50-скидки.png" />-->
<!--        </div>-->

    </div>
    <!-- Bullet Navigator -->
    <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
        <!-- bullet navigator item prototype -->
        <div data-u="prototype" style="width:16px;height:16px;"></div>
    </div>
    <!-- Arrow Navigator -->
    <span data-u="arrowleft" class="jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
    <span data-u="arrowright" class="jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
</div>

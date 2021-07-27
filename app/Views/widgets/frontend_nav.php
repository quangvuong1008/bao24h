<?php

use App\Helpers\Html;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\CategoryModel[] $items
 * @var \App\Models\ProjectCategoryModel[] $projects
 */
?>
<header>
    <div class=container>
        <div class=row>
            <div class="col-xs-12 col-md-4 header-left">
                <div class="logo edit_potion_logo">
                    <a href="/" title="Về trang chủ">
                        <img src=<?php echo base_url('/images/' . $settings['home_logo_link']) ?> alt="rao chung "
                        class=img-responsive>
                    </a>
                </div>
            </div>
            <div class="col-xs-8 col-md-8 header-right text-right">
                <div class="search-bar hidden-xs">
                    <form action="<?= route_to('home_search') ?>" method=get>
                        <div id=custom-search-input>
                            <div class=input-group>
                                <input type=text name=query class="form-control input-sm"
                                       placeholder="Nhập từ khóa để tìm kiếm...">
                                <span class=input-group-btn>
                                    <button class="btn btn-info btn-lg" type=submit>
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="div_nav_button_head hidden-xs">
                    <a href="tel:<?= $settings['home_goi_ngay'] ?>">
                        <img class="img-nav-btn-hotline" src="/images/hotline.png">
                        <?= $settings['home_goi_ngay'] ?>

                    </a>
                    <a href="tel:<?= $settings['home_hot_line'] ?> ">
                        <img class="img-nav-btn-tel" src="/images/tel.png">
                        <?= $settings['home_hot_line'] ?>
                    </a>
                    <a href="<?= $settings['home_link_facebook'] ?>">
                        <img class="img-nav-btn-tel" src="/images/icon-facebook.png">
                    </a>
                    <a href="<?= $settings['home_link_pinterest'] ?>">
                        <img class="img-nav-btn-tel" src="/images/icon-pinterest.png">
                    </a>
                    <a href="<?= $settings['home_link_youtube'] ?>">
                        <img class="img-nav-btn-tel" src="/images/icon-youtube.png">
                    </a>
                    <a href="<?= $settings['home_link_twitter'] ?>">
                        <img class="img-nav-btn-tel" src="/images/icon-twitter.png">
                    </a>
                </div>
                <div class="hotline-head hidden" id="cart-badge">
                    <a href="<?= base_url('cart') ?>" class=ico-head>
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                        <span>0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-navbar visible-xs">
    <a href="/"><h3>Trang chủ</h3></a>
    <?php if ($items && !empty($items)) {
        foreach ($items as $item) {
            echo Html::a(Html::tag('h3', $item->title), $item->getUrl());
        }
    } ?>

    <?php if ($product_category && !empty($product_category)) {
        foreach ($product_category as $product_cate) {
            echo Html::a(Html::tag('h3', $product_cate->title), $product_cate->getUrl());
        }
    } ?>
    
    <?= Html::a(Html::tag('h3', 'Liên hệ'), base_url('lien-he')) ?>
</div>
<nav class="navbar navbar-inverse main-nav">
    <div class=container>
        <div class=navbar-header>
            <a href="/"><img class="visible-xs" src="<?php echo base_url('/images/' . $settings['home_logo_link']) ?> " alt=""></a>
            <button type="button" class="navbar-toggle" data-target="#nav" data-toggle="collapse" aria-expanded=false>
                <span class=sr-only>Toggle navigation</span>
                <span class=icon-bar></span>
                <span class=icon-bar></span>
                <span class=icon-bar></span>
            </button>
        </div>
        <div class="collapse navbar-collapse edit_potion_menu" id="nav">
            <ul class="nav navbar-nav">
                <li><a href="/">Trang chủ</a></li>
                <?php if ($items && !empty($items)): ?>
                    <?php foreach ($items as $n => $item): ?>
                        <li class=dropdown>
                            <?= Html::a($item->title . ($item->children ? '<b class=></b>' : ''), $item->getUrl(), [
//                                'class' => 'dropdown-toggle',
//                                'data-toggle' => 'dropdown'
                            ]) ?>
                            <?php if ($item->children): ?>
                                <div class="dropdown-menu multi-column columns-2 wrap-col-menu <?php if ($n > 3): ?> edit_potion_sub_menu_1 <?php endif; ?>">
                                    <ul class="multi-column-dropdown">
                                        <?php foreach ($item->children as $child): ?>
                                            <li class="">
                                                <?= Html::a($child->title, $child->getUrl()) ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if ($product_category && !empty($product_category)): ?>
                    <?php foreach ($product_category as $n => $product_cate): ?>
                        <li class=dropdown>
                            <?= Html::a($product_cate->title . ($product_cate->children ? '<b class=></b>' : ''), $product_cate->getUrl(), [
//                                'class' => 'dropdown-toggle',
//                                'data-toggle' => 'dropdown'
                            ]) ?>
                            <?php if ($product_cate->children): ?>
                                <div class="dropdown-menu multi-column columns-2 wrap-col-menu <?php if ($n > 3): ?> edit_potion_sub_menu_1 <?php endif; ?>">
                                    <ul class="multi-column-dropdown">
                                        <?php foreach ($product_cate->children as $child): ?>
                                            <li class="">
                                                <?= Html::a($child->title, $child->getUrl()) ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>

                <li><a rel=nofollow href="/lien-he">Liên hệ</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="threadbar">
    <div class="threadbar_wrapper w1040">
        <a class="threadbar-info ">

        </a><a  class="threadbar-info fix-span"><span class="">Tin Mới</span></a>
        <marquee style="width: 77% ;" scrolldelay="200">
            <ul class="list-threadbar">
                <?php if ($category):?>
                    <?php foreach ($category as $ct):?>
                        <li class="threadbar-item" id="sub_562"><a href="<?=$ct->getUrl()?>"
                                                                   title="<?=$ct->title?>"><span class="item-txt"><?=$ct->title?></span></a>
                        </li>
                    <?php endforeach;?>
                <?php endif;?>
            </ul>
        </marquee>

        <div class="time-header  ">
            <?php
            $futureDate = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
            ?>
                    <span id="miniclock">
                        <span class="date "><?php echo date('l',$futureDate );?>, <?php echo date("d/m/Y", $futureDate);?></span>
                        <span class="time" id="time"> |</span>
                    </span>
        </div>
    </div>
</div>
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
                        <img src=/images/logo.png alt="An Gia Khang" class=img-responsive>
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
                <div class="div_nav_button_head hidden-xs" >
                    <a href="tel:028.3989.7088 ">
                        <img class="img-nav-btn-hotline" src="/images/hotline.png">
						028.3989.7088
                        
                    </a>
                    <a href="tel:0937181181 ">
                        <img class="img-nav-btn-tel" src="/images/tel.png">
                        0937181181
                    </a>
                    <a href="https://www.facebook.com/congtyangiakhang/">
                        <img class="img-nav-btn-tel" src="/images/icon-facebook.png">
                    </a>
                    <a>
                        <img class="img-nav-btn-tel" src="/images/icon-pinterest.png">
                    </a>
                    <a href="https://www.youtube.com/watch?time_continue=67&v=atUEemufouk">
                        <img class="img-nav-btn-tel" src="/images/icon-youtube.png">
                    </a>
                    <a>
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
<!--    --><?//= Html::a(Html::tag('h3', 'Mẫu nhà đẹp'), base_url('mau-nha-dep')) ?>
<!--    --><?//= Html::a(Html::tag('h3', 'Báo giá'), base_url('bao-gia')) ?>
    <?= Html::a(Html::tag('h3', 'Kinh nghiệm hay'), route_to('news')) ?>
    <?= Html::a(Html::tag('h3', 'Liên hệ'), base_url('lien-he')) ?>
</div>
<nav class="navbar navbar-inverse main-nav">
    <div class=container>
        <div class=navbar-header>
            <button type="button" class="navbar-toggle" data-target="#nav" data-toggle="collapse" aria-expanded=false>
                <span class=sr-only>Toggle navigation</span>
                <span class=icon-bar></span>
                <span class=icon-bar></span>
                <span class=icon-bar></span>
            </button>
        </div>
        <div class="collapse navbar-collapse edit_potion_menu" id="nav" >
            <ul class="nav navbar-nav">
                <li><a href="/">Trang chủ</a></li>
                <?php if ($items && !empty($items)): ?>
                    <?php foreach ($items as $item): ?>
                        <li class=dropdown>
                            <?= Html::a($item->title . ($item->children ? '<b class=caret></b>' : ''), $item->getUrl(), [
                                'class' => 'dropdown-toggle',
                                'data-toggle' => 'dropdown'
                            ]) ?>
                            <?php if ($item->children): ?>
                                <div class="dropdown-menu multi-column columns-2 wrap-col-menu edit_potion_sub_menu_1">
                                    <ul class="multi-column-dropdown">
                                        <?php foreach ($item->children as $child): ?>
                                            <li class="col-md-6">
                                                <?= Html::a($child->title, $child->getUrl()) ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if ($projects && !empty($projects)): ?>
                    <li class=dropdown>
                        <?= Html::a('Dự án tiêu biểu' . Html::tag('span', '', ['class' => 'caret']),
                            base_url('du-an-tieu-bieu'),[ 'class' => 'dropdown-toggle','data-toggle' => 'dropdown']) ?>
                        <div class="dropdown-menu multi-column wrap-col-menu edit_potion_sub_menu_1" >
                            <ul class="multi-column-dropdown">
                                <?php foreach ($projects as $project): ?>
                                    <li class="col-md-6">
                                        <?= Html::a($project->title, $project->getUrl()) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="/bao-gia">Báo giá <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/bao-gia">BÁO GIÁ CHI TIẾT</a></li>
                        <li class="hidden"><a href="<?= route_to('product') ?>">BÁO GIÁ THEO SẢN PHẨM</a></li>
                    </ul>
                </li>
                <li><a rel=nofollow href="/lien-he">Liên hệ</a></li>
            </ul>
        </div>
    </div>
</nav>
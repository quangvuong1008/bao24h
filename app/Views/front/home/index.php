<?php

use App\Helpers\Html;
use App\Helpers\StringHelper;
use App\Helpers\Widgets\NewsKingNghiemHay;
use App\Models\SettingsModel;
use App\Helpers\SettingHelper;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\SliderModel[] $sliders
 * @var \App\Models\ProjectCategoryModel[] $projectCategories
 * @var \App\Models\CategoryModel[] $categories
 * @var \App\Models\TestimonialModel[] $testimonials
 * @var \App\Models\PartnerModel[] $partners
 * @var \App\Models\NewsModel[] $newsItems
 */
$this->title = $title;
$this->meta_image_url = $meta_image_url;
$home_posts_block_id = explode(',', $settings['home_posts_block_id']);
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="tn-left">
                <ul class="list-box">
                    <?php if ($posts_top): ?>
                        <?php foreach ($posts_top as $post_top): ?>
                            <li>

                                <a href="<?= $post_top->getUrl() ?>"
                                   title="<?= $post_top->title ?>">
                                    <span class="thumb"><img src="<?= $post_top->getImage() ?>"
                                                             alt="<?= $post_top->title ?>"></span>
                                    <span class="title fix-title"><?= $post_top->title ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>


                </ul>
                <?php if ($new): ?>
                    <?php foreach ($new as $n): ?>
                        <div class="thread">
                            <h2>
                                <a href=""><span>Góc nhìn</span></a>
                            </h2>

                            <a href="<?= $n->getUrl() ?>"
                               title=" <?= $n->title ?>">
                                <h3 class="title">
                                    <?= $n->title ?>
                                </h3>
                            </a>
                            <div class="thread_box">
                                <div class="fix-cut-string">
                                    <p>
                                        <?= $n->meta_description ?>
                                    </p>
                                </div>

                                <span class="thumb">
                                <a href="<?= $n->getUrl() ?>"
                                   title="<?= $n->title ?>">
                                    <img src="<?= $n->getImage() ?>"
                                         alt="<?= $n->title ?>">
                                </a>
                            </span>
                            </div>

                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6">
            <?php if ($posts_new): ?>
                <?php foreach ($posts_new as $post_new): ?>
                    <div class="tn-newsest">
                        <a href="<?= $post_new->getUrl() ?>"
                           title="<?= $post_new->title ?>" class="thumb">
                            <img src="<?= $post_new->getImage() ?>"
                                 alt="<?= $post_new->title ?> ">
                        </a>
                        <a href="<?= $post_new->getUrl() ?>"
                           title="<?= $post_new->title ?>" class="title">
                            <h2><?= $post_new->meta_title ?> </h2>
                        </a>
                        <div class="fix-intro-index">
                            <p>
                                <?= $post_new->meta_description ?>
                            </p>
                        </div>


                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="col-md-3">
            <div class="tabs">

                <div class="tab-content">
                    <div class="text-center fix-title-widget-top ">
                        <h2><a href="">KINH NGHIỆM HAY</a>
                        </h2>
                    </div>
                    <div class="tab-pane share_tab active" role="tabpanel" aria-labelledby="share-tab" id="share_tab"
                         style="height: 487px;">
                        <div class="scrollbar" id="style-1">
                            <div class="force-overflow">
                                <?php if ($posts_view_index):?>
                                    <?php foreach ($posts_view_index as $posts_view):?>
                                        <article class="story--text" >
                                            <div class="meta">
                                                <img src="<?=$posts_view->getImage()?>" alt="">
                                            </div>
                                            <a href="<?=$posts_view->getUrl()?>"
                                               title="<?=$posts_view->title?>" class="story--text__title"><?=$posts_view->title?></a>
                                        </article>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </div>
                            <div class="slimScrollBar"
                                 style="background: rgb(0, 0, 0); width: 6px; position: absolute; top: 200px; opacity: 0.2; display: none; border-radius: 10px; z-index: 99; right: 1px; height: 470.81px;"></div>
                            <div class="slimScrollRail"
                                 style="width: 6px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 10px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <section>
            <div class="ct-media">
                <nav class="navbar navbar-default fix-menu-media">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#nav-media" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand fix-navbar-brand" href="#">Media</a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="nav-media">

                            <ul class="nav navbar-nav fix-size-color-media">
                                <li class="dropdown threadbar_list_media"><a href="/video">Video</a></li>
                                <br class="visible-xs">
                                <?php if ($categories_video && !empty($categories_video)): ?>
                                    <?php foreach ($categories_video as $n => $item): ?>
                                        <li class=dropdown>
                                            <?= Html::a($item->title, $item->getUrl(), [
//
                                            ]) ?>
                                        </li>
                                        <br class="visible-xs">
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </div>
            <div class="col-md-12 color-media">
                <div class="swiper-container swiper-container-home-top hidden-xs">
                    <?php if ($posts_video): ?>
                        <div class="swiper-wrapper">

                            <?php foreach ($posts_video as $ps_video): ?>
                                <div class="swiper-slide">
                                    <a href="<?= $ps_video->getUrl() ?>">
                                        <button type="button" data-toggle="modal" data-target="#video-"
                                                data-src=" ?>"
                                                class="img-wrap anim fix-player-top">
                                            <img src="<?= $ps_video->getImage() ?>" alt="<?= $ps_video->title ?>">
                                        </button>
                                    </a>
                                    <div class="title-name">
                                        <a href="<?= $ps_video->getUrl() ?>"><?= $ps_video->title ?></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    <?php endif; ?>
                    <!--                     Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!--                     Add Arrows -->
                    <div class="swiper-button-next swiper-button-next-top"></div>
                    <div class="swiper-button-prev swiper-button-prev-top"></div>
                </div>
                <div class="swiper-container swiper-container-home-top-moble visible-xs">
                    <?php if ($posts_video): ?>
                        <div class="swiper-wrapper">

                            <?php foreach ($posts_video as $ps_video): ?>
                                <div class="swiper-slide">
                                    <a href="<?= $ps_video->getUrl() ?>">
                                        <button type="button" data-toggle="modal" data-target="#video-"
                                                data-src=" ?>"
                                                class="img-wrap anim fix-player-top">
                                            <img src="<?= $ps_video->getImage() ?>" alt="<?= $ps_video->title ?>">
                                        </button>
                                    </a>
                                    <div class="title-name">
                                        <a href="<?= $ps_video->getUrl() ?>"><?= $ps_video->title ?></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    <?php endif; ?>
                    <!--                     Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!--                     Add Arrows -->
                    <div class="swiper-button-next swiper-button-next-top"></div>
                    <div class="swiper-button-prev swiper-button-prev-top"></div>
                </div>
            </div>

        </section>
    </div>
</div>
<div class="container">
    <div class="row">
        <section>
            <div class="col-md-6">
                <div class="cc-left">

                    <h2 class="tinnong"><span class="txt">tin nóng</span></h2>
                    <ul class="list-ccl">
                        <?php if ($posts_hot_news): ?>
                            <?php foreach ($posts_hot_news as $phn): ?>
                                <li class="ccl-item">
                                    <a href="<?= $phn->getUrl() ?>"
                                       title="<?= $phn->title ?>" class="item_thumb">
                                        <img src="<?= $phn->getImage() ?>" alt="<?= $phn->title ?>">
                                    </a>
                                    <div class="item_info">
                                        <a class="item_cat">
                                            <?= $phn->select_category_id() ?>
                                        </a>
                                        <a href="<?= $phn->getUrl() ?>"
                                           title="<?= $phn->title ?>" class="item_title">
                                            <?= $phn->title ?>
                                        </a>
                                        <p class="fix_news_des"><?= $phn->meta_description ?></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>

                </div>

            </div>
            <div class="col-md-6">
                <div class="cc-right">

                    <?php
                    if ($home_posts_block_id && count($home_posts_block_id) > 1):
                        foreach ($home_posts_block_id as $block_id):
                            if ($postsCategories && !empty($postsCategories)):
                                ?>
                                <div class="ccr-group">
                                    <?php foreach ($postsCategories as $n => $posts_category):
                                        if ($posts_category->id == $block_id) :
                                            ?>
                                            <nav class="navbar navbar-default fix-menu-cate">
                                                <div class="container-fluid">
                                                    <!-- Brand and toggle get grouped for better mobile display -->
                                                    <div class="navbar-header">
                                                        <button type="button" class="navbar-toggle collapsed"
                                                                data-toggle="collapse"
                                                                data-target="#category-posts-<?php echo $n + 1 ?>"
                                                                aria-expanded="false">
                                                            <span class="sr-only">Toggle navigation</span>
                                                            <span class="icon-bar"></span>
                                                            <span class="icon-bar"></span>
                                                            <span class="icon-bar"></span>
                                                        </button>
                                                        <a class="navbar-brand fix-navbar-brand-title"
                                                           href="<?= $posts_category->getUrl() ?>"
                                                           title="<?= $posts_category->title ?>"><?= $posts_category->title ?></a>
                                                    </div>

                                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                                    <div class="collapse navbar-collapse"
                                                         id="category-posts-<?php echo $n + 1 ?>">
                                                        <?php if ($categories_menu):
                                                            $menu = $categories_menu->getCategoryRecursive($posts_category->id, 0, 2)
                                                            ?>
                                                            <ul class="nav navbar-nav fix-font-color-cate">

                                                                <?php foreach ($menu as $mn): ?>
                                                                    <li class=dropdown>
                                                                        <?= Html::a($mn->title, $mn->getUrl(), [
//
                                                                        ]) ?>
                                                                    </li>
                                                                    <br class="visible-xs">
                                                                <?php endforeach; ?>

                                                            </ul>
                                                        <?php endif; ?>
                                                        <a class="load-cat hidden-xs"
                                                           href="<?= $posts_category->getUrl() ?>">Xem tất cả</a>
                                                    </div><!-- /.navbar-collapse -->
                                                </div><!-- /.container-fluid -->
                                            </nav>
                                            <div class="ccr-box">

                                                <?php
                                                if ($posts_category->posts_hot) {
                                                    foreach ($posts_category->posts_hot as $posts_hot):?>
                                                        <div class="box_news">
                                                            <a href="<?= $posts_hot->getUrl() ?>"
                                                               title="<?= $posts_hot->title ?>"
                                                               class="news_img">
                                                                <img src="<?= $posts_hot->getImage() ?>"
                                                                     alt="<?= $posts_hot->title ?>">
                                                            </a>
                                                            <div class="news_info">
                                                                <a href="<?= $posts_hot->getUrl() ?>"
                                                                   title="<?= $posts_hot->title ?>"
                                                                   class="news_title">
                                                                    <h3><?= $posts_hot->title ?></h3>
                                                                </a>
                                                                <p class="news_des">
                                                                    <?= $posts_hot->meta_description ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    <?php endforeach;

                                                } ?>
                                                <ul class="ccr-list">
                                                    <div class="row">

                                                        <?php
                                                        if ($posts_category->posts_title) {
                                                            foreach ($posts_category->posts_title as $posts):?>
                                                                <div class="col-md-6">
                                                                    <li class="ccr-item">
                                                                        <h4>
                                                                            <a href="<?= $posts->getUrl() ?>"
                                                                               title="<?= $posts->title ?>">
                                                                                <?= $posts->title ?>
                                                                            </a>
                                                                        </h4>
                                                                    </li>
                                                                </div>
                                                            <?php endforeach;

                                                        } ?>

                                                    </div>

                                                </ul>
                                            </div>
                                        <?php
                                        endif;
                                    endforeach; ?>
                                </div>
                            <?php endif;
                        endforeach;
                    endif;
                    ?>

                </div>

            </div>
        </section>

    </div>
</div>
<div class=container>
    <div class=row>
        <section class=col-md-12>

            <?php
            if ($home_list_block_id && count($home_list_block_id) > 1):
                foreach ($home_list_block_id as $block_id):
                    if ($categories && !empty($categories)): ?>
                        <div class="row main-topic">
                            <?php foreach ($categories as $category):
                                if ($category->id == $block_id) :
                                    ?>
                                    <section class="homepage-row-product">
                                        <div class="homepage-row-product-title text-center">
                                            <h2><?= Html::a($category->title, $category->getUrl(), ['title' => $category->title]) ?></h2>
                                        </div>
                                        <div class="">
                                            <?php if ($category->children) {
                                                echo $this->import('_category_children', ['models' => $category->children]);
                                            } ?>
                                        </div>
                                    </section>
                                <?php
                                endif;
                            endforeach; ?>

                        </div>
                    <?php endif;
                endforeach;
            endif;
            ?>
        </section>
    </div>
    <?php if ($newsItems && !empty($newsItems)): ?>
        <hr>
        <div class="row hottopic-section">
            <?php foreach ($newsItems as $news): ?>
                <div class="col-xs-6 col-sm-4 col-md-4">
                    <div class="hot-box" itemscope itemtype="http://schema.org/NewsArticle">
                        <a href="<?= $news->getUrl() ?>" title="<?= Html::decode($news->title) ?>">
                            <div class="img-wrap">
                                <?= Html::img($news->getImage(), ['alt' => $news->title]) ?>
                            </div>
                        </a>
                        <div class="hot-caption text-justify">
                            <h3 itemprop=name>
                                <?= Html::a($news->title, $news->getUrl()) ?>
                            </h3>
                            <p><?= $news->intro && ($intro = strip_tags($news->intro)) !== null ?
                                StringHelper::truncateWords($intro, 60) : null ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
</div>
<div class=container>

    <?php if ($testimonials && !empty($testimonials)): ?>
        <div class=container>
            <div class=row>

            </div>
        </div>
    <?php endif; ?>
    <div class=row>
        <section class=col-md-12>
            <?= NewsKingNghiemHay::register($this) ?>
        </section>
    </div>
</div>

<section>
    <div class="container">
        <div class="row">
            <?php for ($i = 1; $i <= 3; $i++): ?>
                <div class="col-md-4 col-lg-4 col-xs-4">
                    <button type="button" data-toggle="modal" data-target="#video-<?= $i ?>"
                            data-src="<?php echo $settings['home_video_link_' . $i]; ?>"
                            class="img-wrap anim player">
                        <img src="<?php echo SettingHelper::getSettingImage($settings['home_video_thumb_' . $i]); ?>"
                             alt="">
                    </button>
                    <div class="modal fade video-modal" id="video-<?= $i ?>" tabindex="-1" role="dialog"
                         aria-labelledby="video-<?= $i ?>">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                #Video <?= $i ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<div class="container">
    <?php if ($partners && !empty($partners)): ?>
        <div class=row>
            <section class=col-md-12>
                <div class=row>
                    <div class="homepage-row-product-title text-center">
                        <h2><a>BÁO CHÍ NÓI GÌ VỀ CHÚNG TÔI</a>
                            <hr class="underline-title">
                        </h2>
                    </div>
                </div>
                <div class="swiper-container swiper-partner-container hidden-xs">
                    <div class="swiper-wrapper">
                        <?php foreach ($partners as $partner): ?>
                            <div class="swiper-slide">
                                <div class="text-center">
                                    <a rel="nofollow" href="<?= $partner->getUrl() ?>" target=_blank
                                       title="<?= Html::decode($partner->title) ?>">
                                        <?= Html::img($partner->getImage(), ['alt' => $partner->title, 'style' => ['height' => '80px']]) ?>
                                    </a>
                                </div>

                            </div>
                        <?php endforeach; ?>

                    </div>
                    <div class="swiper-partner-container"></div>
                </div>
                <div class="swiper-container swiper-partner-container-mobile visible-xs">
                    <div class="swiper-wrapper">
                        <?php foreach ($partners as $partner): ?>
                            <div class="swiper-slide">
                                <div class="text-center">
                                    <a rel="nofollow" href="<?= $partner->getUrl() ?>" target=_blank
                                       title="<?= Html::decode($partner->title) ?>">
                                        <?= Html::img($partner->getImage(), ['alt' => $partner->title, 'style' => ['width' => '80%']]) ?>
                                    </a>
                                </div>

                            </div>
                        <?php endforeach; ?>

                    </div>
                    <div class="swiper-partner-container"></div>
                </div>
            </section>
        </div>
    <?php endif ?>
</div>
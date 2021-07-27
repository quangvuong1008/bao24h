<?php

use App\Helpers\Html;
use App\Helpers\Widgets\BreadcrumbsWidget;
use App\Helpers\Widgets\PostNewRightBoxWidget;
use App\Helpers\Widgets\PostsVatLieuXayDung;
use App\Helpers\Widgets\NewsRightBoxWidget;
use App\Helpers\Widgets\ContactShortCodeWidget;
use App\Helpers\StringHelper;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\CategoryModel $model
 * @var \App\Models\ObjectContentModel[] $contents
 * @var \App\Models\CategoryModel[] $models
 * @var \CodeIgniter\Pager\Pager $pager
 */

$this->title = Html::decode($model->title);
$this->meta_image_url = $meta_image_url;
?>

<div class="main-wrap">
    <div class="container">
        <div class="row hidden-xs">
            <div class="col-md-12">
                <?= BreadcrumbsWidget::register($this, [
                    'links' => $model_top->breadcrumbs($model_top->getPrimaryKey())
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 well well-topic">
                <article itemscope="" itemtype="http://schema.org/NewsArticle">
                    <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage"
                          itemid="https://google.com/article">
                    <meta itemprop="datePublished" content="<?= date('d/m/Y H:i:s A', $model_top->created_at) ?>">
                    <meta itemprop="dateModified" content="<?= date('d/m/Y H:i:s A', $model_top->updated_at) ?>">
                    <header>
                        <h1 itemprop="headline"><?= Html::decode($model_top->title) ?></h1>
                        <time id="createDate" datetime="<?= date('d/m/Y H:i:s A', $model_top->created_at) ?>">
                            <i class="glyphicon glyphicon-time"></i> <?= date('d/m/Y', $model_top->created_at) ?>
                        </time>
                    </header>
                    <div class="pull-right "
                         style="margin-left: 10px"><?php echo ($vote->avg_rate ?: 0) . '/5 (' . ($vote->total ?: 0) . ' votes)' ?></div>
                    <div class="pull-right div_cate_vote" data-object_id="<?= $model->id ?>"
                         data-rate-init="<?= $vote->avg_rate ?: 0 ?>"
                         data-url-post="<?= base_url() . '/category/insert_votes_rate_category' ?>"
                    ></div>
                    <div class="fb-like" data-href="<?= $model_top->getUrl() ?>" data-width="" data-layout="button_count"
                         data-action="like" data-size="small"></div>
                    <div class="fb-share-button" data-href="<?= $model_top->getUrl() ?>" data-layout="button_count"
                         data-size="small">
                        <a target="_blank"
                           href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                           class="fb-xfbml-parse-ignore">Chia sẻ</a></div>

                    <?php if ($category && !empty($category)): ?>
                        <div class="row">
                            <?php foreach ($category as $ct): ?>
                                <div class="col-xs-6 col-md-6">
                                    <a href="<?= $ct->getUrl() ?>" class="thumbnail"
                                       title="<?= Html::decode($ct->title) ?>">
                                        <div class="img-wrap">
                                            <?= Html::img($ct->getImage(), ['alt' => $ct->title]) ?>
                                        </div>
                                        <div class="caption" style="height: 70px;text-align: center"><span style="line-height: 35px"><?= Html::decode($ct->title) ?></span></div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else:?>
                        <?php  if ($post_detail_top && !empty($post_detail_top)): ?>
                            <div class="row">
                                <?php foreach ($post_detail_top as $mt): ?>
                                    <div class="col-xs-6 col-md-6">
                                        <a href="<?= $mt->getUrl() ?>" class="thumbnail"
                                           title="<?= Html::decode($mt->title) ?>">
                                            <div class="img-wrap">
                                                <?= Html::img($mt->getImage(), ['alt' => $mt->title]) ?>
                                            </div>
                                            <div class="caption" style="height: 70px;text-align: center"><span style="line-height: 35px"><?= Html::decode($mt->title) ?></span></div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="text-center"><?= $pager->links() ?></div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div id="content">
                        <?php if (($contents = $model->getContents()) && !empty($contents)): ?>
                            <div id="table-content-wrap" class="content-table ">
                                <div id="title">
                                    <b>Danh mục</b>
                                    <a class="btn btn-tb-content btn-sm">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </div>
                                <ul id="table-content">
                                    <?php foreach ($contents as $link): ?>
                                        <li>
                                            <?= Html::a($link->title, "#{$link->slug}", [
                                                'title' => $link->title
                                            ]) ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="content-intro content-intro-table">
                        <?= Html::decode($model->intro) ?>
                    </div>
                    <?php if (!empty($contents)): ?>
                        <div class="content-wrap">
                            <?php foreach ($contents as $content): ?>
                                <h2 id="<?= $content->slug ?>">
                                    <span style="font-size:12pt;color:brown">
                                        <strong style="font-size:12pt">
                                            <?= Html::decode($content->title) ?>
                                        </strong>
                                    </span>
                                </h2>
                                <div class="content-article content-article-table">
                                    <?php $contact_short_code =  ContactShortCodeWidget::register($this,[]) ?>
                                    <?= Html::decode(str_replace('[[contact_short_code]]',$contact_short_code,$content->content)) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>

                </article>
            </div>
            <div class="col-md-4 hidden-xs">
                <?= PostNewRightBoxWidget::register($this); ?>
                <?= PostsVatLieuXayDung::register($this); ?>
                <?= NewsRightBoxWidget::register($this); ?>
            </div>
        </div>
    </div>
</div>
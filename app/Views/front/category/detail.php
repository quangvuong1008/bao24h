<?php

use App\Helpers\Html;
use App\Helpers\Widgets\BreadcrumbsWidget;
use App\Helpers\Widgets\PostNewRightBoxWidget;
use App\Helpers\Widgets\PostsVatLieuXayDung;
use App\Helpers\Widgets\NewsRightBoxWidget;
use App\Helpers\Widgets\PostBaoBi;
use App\Helpers\Widgets\ContactShortCodeWidget;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\CategoryModel $model
 * @var \App\Models\ObjectContentModel[] $contents
 * @var \App\Models\CategoryModel[] $models
 * @var \CodeIgniter\Pager\Pager $pager
 */

$this->title = Html::decode($model->meta_title);
$this->meta_image_url = $meta_image_url;
?>
<div class="main-wrap">
    <div class="container">
        <div class="row hidden-xs">
            <div class="col-md-12">
                <?= BreadcrumbsWidget::register($this, [
                    'links' => $category->breadcrumbs($category->getPrimaryKey())
                ], ['label' => $model->title,
                    'url' => $model->getUrl()]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 well well-topic">
                <article itemscope="" itemtype="http://schema.org/NewsArticle">
                    <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage"
                          itemid="https://google.com/article">
                    <meta itemprop="datePublished" content="<?= date('d/m/Y H:i:s A', $model->created_at) ?>">
                    <meta itemprop="dateModified" content="<?= date('d/m/Y H:i:s A', $model->updated_at) ?>">
                    <header>
                        <h1 itemprop="headline"><?= Html::decode($model->title) ?></h1>
                        <time id="createDate" datetime="<?= date('d/m/Y H:i:s A', $model->created_at) ?>">
                            <i class="glyphicon glyphicon-time"></i> <?= date('d/m/Y', $model->created_at) ?>
                        </time>
                    </header>
                    <div class="pull-right " style="margin-left: 10px"><?php echo ($vote->avg_rate?:0) .'/5 (' . ($vote->total?:0) . ' votes)' ?></div>
                    <div class="pull-right div_cate_vote" data-object_id="<?= $model->id?>"
                         data-rate-init="<?= $vote->avg_rate?:0 ?>"
                         data-url-post ="<?= base_url() . '/category/insert_votes_rate_category' ?>"
                    ></div>
                    <div class="fb-like" data-href="<?= $model->getUrl() ?>" data-width="" data-layout="button_count" data-action="like" data-size="small" ></div>
                    <div class="fb-share-button" data-href="<?= $model->getUrl() ?>" data-layout="button_count" data-size="small">
                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>


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
                <?= PostBaoBi::register($this); ?>
                <?= NewsRightBoxWidget::register($this); ?>
            </div>
        </div>
    </div>
</div>
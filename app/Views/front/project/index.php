<?php

use App\Helpers\Html;
use App\Helpers\Widgets\NewProductWidget;
use App\Helpers\Widgets\BreadcrumbsWidget;
use App\Helpers\Widgets\NewsRightBoxWidget;


/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\ProjectCategoryModel $model
 * @var \App\Models\ProjectModel[] $projects
 * @var \App\Models\ProjectCategoryModel[] $categories
 */
$this->title = Html::decode($model->title)?Html::decode($model->title): $title;
$this->meta_image_url = $meta_image_url;
?>
<div class="main-wrap">
    <div class="container">
        <div class="row hidden-xs">
            <div class="col-md-12">
                <?= BreadcrumbsWidget::register($this, [
                    'links' => ['Mẫu nhà đẹp']
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 well well-topic">
                <article itemscope="" itemtype="http://schema.org/NewsArticle" class="hidden">
                    <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage"
                          itemid="https://google.com/article">
                    <meta itemprop="datePublished" content="<?= date('d/m/Y H:i:s A', $model->created_at) ?>">
                    <meta itemprop="dateModified" content="<?= date('d/m/Y H:i:s A', $model->updated_at) ?>">
                    <header><h1 itemprop="headline"><?= Html::decode($model->title) ?></h1></header>
                    <div id="content"></div>
                </article>

                <?php if ($categories && !empty($categories)): ?>
                    <div class="row">
                        <div class="col-md-12"><h3>Danh mục</h3></div>
                    </div>
                    <div class="row">
                        <?php foreach ($categories as $category): ?>
                            <div class="col-xs-6 col-md-4">
                                <a href="<?= $category->getUrl() ?>" class="thumbnail product-box"
                                   title="<?= Html::decode($model->title) ?>">
                                    <span class="img-wrap">
                                        <?= Html::img($category->getImage(), ['alt' => $category->title]) ?>
                                    </span>
                                    <div class="caption"><p><?= Html::decode($category->title) ?></p></div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (1==0 && $projects && !empty($projects)): ?>
                    <div class="row">
                        <?php foreach ($projects as $project): ?>
                            <div class="col-xs-6 col-md-6">
                                <a href="<?= $project->getUrl() ?>" class="thumbnail"
                                   title="<?= Html::decode($project->title) ?>">
                                    <span class="img-wrap">
                                        <?= Html::img($project->getImage(), ['alt' => $project->title]) ?>
                                    </span>
                                    <div class="caption"><p><?= Html::decode($project->title) ?></p></div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <?php if(1==0) : ?>
                    <div class="empty-block">
                        <img src="/images/no-content.jpg" alt="No content"/>
                        <h4>Không có dự án nào thuộc danh mục này</h4>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>


            </div>
            <div class="col-md-4 hidden-xs">
                <?= NewsRightBoxWidget::register($this); ?>

            </div>
        </div>
    </div>
</div>
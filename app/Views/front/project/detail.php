<?php

use App\Helpers\Html;

use App\Helpers\Widgets\ContactWidget;
use App\Helpers\Widgets\NewProductWidget;
use App\Helpers\Widgets\BreadcrumbsWidget;
use App\Helpers\Widgets\NewsRightBoxWidget;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\ProjectCategoryModel $category
 * @var \App\Models\ProjectModel $model
 * @var \App\Models\ObjectContentModel[] $contents
 */

$this->title = Html::decode($model->title);
?>
<div class="main-wrap">
    <div class="container">
        <div class="row hidden-xs">
            <div class="col-md-12">
                <?= BreadcrumbsWidget::register($this, [
                    'links' => [
                        ['label' => 'Mẫu nhà đẹp', 'url' => route_to('project')],
                        ['label' => $category->title, 'url' => $category->getUrl()],
                        $model->title
                    ]
                ]) ?>
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
                        <time id="createDate" datetime="9/25/2019 9:16:40 AM" pubdate="">
                            <i class="glyphicon glyphicon-time"></i> <?= date('d/m/Y', $model->created_at) ?>
                        </time>
                    </header>
                    <div id="content">
                        <?php if (($contents = $model->getContents()) && !empty($contents)): ?>
                            <div id="table-content-wrap" class="content-table closed">
                                <div id="title">
                                    <b>Danh mục</b>
                                    <a class="btn btn-tb-content btn-sm">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </div>
                                <ul id="table-content">
                                    <?php foreach ($contents as $content): ?>
                                        <li>
                                            <?= Html::a($content->title, "#{$content->slug}", [
                                                'title' => $content->title
                                            ]) ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="content-intro"><?= Html::decode($model->intro) ?></div>
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
                                <div class="content-article">
                                    <?= Html::decode($content->content) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif ?>
                </article>
            </div>
            <div class="col-md-4 hidden-xs">
                <?= ContactWidget::register($this) ?>

                <?= NewsRightBoxWidget::register($this); ?>
            </div>
        </div>
    </div>
</div>
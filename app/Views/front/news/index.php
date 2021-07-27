<?php

use App\Helpers\Html;

use App\Helpers\Widgets\BreadcrumbsWidget;
use App\Helpers\Widgets\PostNewRightBoxWidget;
use App\Helpers\Widgets\NewProjectWidget;
use App\Helpers\Widgets\NewsDoanhNghiepRightBoxWidget;
use App\Helpers\Widgets\NewsNhaDatRightBoxWidget;
use App\Helpers\Widgets\NewsBiQuyetRightBoxWidget;
/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\NewsModel[] $models
 * @var \CodeIgniter\Pager\Pager $pager
 */
$this->title = $title;
$this->meta_image_url = $meta_image_url;
?>
<div class="main-wrap">
    <div class="container">
        <div class="row hidden-xs">
            <div class="col-md-12">
                <?= BreadcrumbsWidget::register($this, [
                    'links' => [['label' => 'Kinh nghiệm hay', 'url' => route_to('news')]]
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 well well-topic">
                <article itemscope="" itemtype="http://schema.org/NewsArticle">
                    <meta itemscope="" itemprop="mainEntityOfPage" itemtype="https://schema.org/WebPage"
                          itemid="https://google.com/article">
                    <meta itemprop="datePublished" content="9/24/2017 11:45:07 PM">
                    <meta itemprop="dateModified" content="8/17/2019 2:22:51 PM">
                    <header><h1 itemprop="headline">Kinh Nghiệm Hay</h1></header>
                    <?php if (!$models || empty($models)): ?>

                    <?php else: ?>
                        <div class="row">
                            <?php foreach ($models as $model): ?>
                                <div class="col-xs-6 col-md-6">
                                    <a href="<?= $model->getUrl() ?>" class="thumbnail product-box"
                                       title="<?= Html::decode($model->title) ?>">
                                        <div class="img-wrap">
                                            <?= Html::img($model->getImage(), ['alt' => $model->title]) ?>
                                        </div>
                                        <div class="caption"><span><?= Html::decode($model->title) ?></span></div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="text-center">
                        <?= $pager->links() ?>
                    </div>
                </article>
            </div>
            <div class="col-md-4 hidden-xs">
                <?= PostNewRightBoxWidget::register($this); ?>
            </div>
        </div>
    </div>
</div>
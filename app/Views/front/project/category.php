<?php

use App\Helpers\Html;
use App\Helpers\Widgets\NewProductWidget;
use App\Helpers\Widgets\NewsRightBoxWidget;
use App\Helpers\Widgets\ProjectCategoryWidget;
use App\Helpers\Widgets\BreadcrumbsWidget;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\ProjectCategoryModel $model
 * @var \App\Models\ProjectModel[] $projects
 * @var \CodeIgniter\Pager\Pager $pager
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
                    <header><h1 itemprop="headline"><?= Html::decode($model->title) ?></h1></header>
                    <div id="content"></div>
                </article>
                <?php if ($projects && !empty($projects)): ?>
                    <div class="row">
                        <?php foreach ($projects as $project): ?>
                            <div class="col-xs-6 col-md-6">
                                <a href="<?= $project->getUrl() ?>" class="thumbnail"
                                   title="<?= Html::decode($project->title) ?>">
                                    <div class="img-wrap">
                                        <?= Html::img($project->getImage(), ['alt' => $project->title]) ?>
                                    </div>
                                    <div class="caption"><p><?= Html::decode($project->title) ?></p></div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="text-center"><?= $pager->links() ?></div>
                <?php else: ?>
                    <div class="empty-block">
                        <img src="/images/no-content.jpg" alt="No content"/>
                        <h4>Không có dự án nào thuộc danh mục này</h4>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-4 hidden-xs">
                <?= NewsRightBoxWidget::register($this); ?>

                <?= ProjectCategoryWidget::register($this); ?>
            </div>
        </div>
    </div>
</div>
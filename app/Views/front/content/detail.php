<?php

use App\Helpers\Html;
use App\Helpers\Widgets\BreadcrumbsWidget;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\ContentModel $model
 */
$this->title = Html::decode($model->title);
?>
<div class="main-wrap">
    <div class="container">
        <div class="row hidden-xs">
            <div class="col-md-12">
                <?= BreadcrumbsWidget::register($this, [
                    'links' => [['label' => $model->title, 'url' => base_url($model->slug)]]
                ]) ?>
            </div>
        </div>
        <section class="row">
            <div class="col-md-12">
                <div class="fb-like" data-href="<?= base_url($model->slug) ?>" data-width="" data-layout="button_count" data-action="like" data-size="small" ></div>
                <div class="fb-share-button" data-href="<?= base_url($model->slug) ?>" data-layout="button_count" data-size="small">
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>

                <div class="well well-topic">
                    <?php if (empty($model->intro) && empty($model->content)): ?>
                        <div class="empty-block">
                            <img src="/images/no-content.jpg" alt="No content"/>
                            <h4>Nội dung đang được cập nhật</h4>
                        </div>
                    <?php else: ?>
                        <div class="content-intro">
                            <?= Html::decode($model->intro) ?>
                        </div>
                        <div class="content-article">
                            <?= Html::decode($model->content) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</div>

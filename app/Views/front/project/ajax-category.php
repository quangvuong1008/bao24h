<?php

use App\Helpers\Html;

/**
 * @var \App\Models\ProjectModel[] $models
 */
?>
<div>
    <?php if (!$models || empty($models)) : ?>
        <div class="empty-block">
            <img src="/images/no-content.jpg" alt="No content"/>
            <h4>Không có dự án nào thuộc danh mục này</h4>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($models as $model): ?>
                <div class="col-md-4 col-xs-6">
                    <a href="<?= $model->getUrl() ?>" class="hover14" title="<?= Html::decode($model->title) ?>">
                        <figure class="img-wrap square">
                            <?= Html::img($model->getImage(), ['alt' => $model->title]) ?>
                        </figure>
                        <div class="caption">
                            <div class="caption-text">
                                <h3><?= Html::decode($model->title) ?></h3>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

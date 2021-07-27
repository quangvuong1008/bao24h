<?php

use App\Helpers\Html;
use App\Helpers\StringHelper;

/**
 * @var \App\Models\ProductModel[] $models
 */
?>
<aside class="panel panel-inverse hidden-xs">
    <div class=panel-heading><h4>Công Trình Mới Thực Hiện</h4></div>
    <div class=panel-body>
        <?php if ($models && !empty($models)): ?>
            <ul class="media-list">
                <?php foreach ($models as $model): ?>
                    <li class="media">
                        <div class="media-left">
                            <a href="<?= $model->getUrl() ?>" title="<?= Html::decode($model->title) ?>">
                                <div class="img-wrap" style="width: 64px;">
                                    <?= Html::img($model->getImage(), ['alt' => $model->title]) ?>
                                </div>
                            </a>
                        </div>
                        <div class=media-body>
                            <h4 class=media-heading>
                                <?= Html::a($model->title, $model->getUrl(), ['title' => $model->title]) ?>
                            </h4>
                            <?= ($intro = $model->intro) !== null && !empty($intro) ? Html::tag('p',
                                StringHelper::truncateWords(strip_tags($intro), 14)) : null ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="empty-block">
                <img src="/images/no-content.jpg" alt="No content"/>
                <h4>Không có nội dung</h4>
            </div>
        <?php endif; ?>
    </div>
</aside>
<?php

use App\Helpers\Html;

/**
 * @var \App\Models\ProjectCategoryModel[] $categories
 */
?>
<aside class="panel panel-inverse hidden-xs">
    <div class="panel-heading text-center"><h3>Tin Tức</h3><hr class="underline-title"></div>
    <div class="panel-body">
        <div class="row">
            <?php foreach ($models as $model): ?>
                <div class="col-xs-12 col-md-12">
                    <a href="<?= $model->getUrl() ?>" class="thumbnail product-box"
                       title="<?= Html::decode($model->title) ?>">
                        <div class="img-wrap">
                            <?= Html::img($model->getImage(), ['alt' => $model->title]) ?>
                        </div>
                        <div class="caption" style="height: 50px"><span><?= Html::decode($model->title) ?></span></div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</aside>

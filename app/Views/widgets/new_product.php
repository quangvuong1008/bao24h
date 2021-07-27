<?php

use App\Helpers\Html;
use App\Helpers\StringHelper;

/**
 * @var \App\Models\ProductModel[] $models
 */
?>
<aside class="panel panel-inverse hidden-xs">
    <div class=panel-heading><h4>SẢN PHẨM MỚI</h4></div>
    <div class=panel-body>
        <?php if ($models && !empty($models)): ?>
            <div class="swiper-container swiper-main-container">
                <div class=swiper-wrapper>
                    <?php foreach ($models as $model): ?>
                        <div class=swiper-slide>
                            <div class="product-block text-center" style="height:378px">
                                <a href="<?= $model->getUrl() ?>" title="<?= Html::decode($model->title) ?>">
                                    <div class="img-wrap">
                                        <?= Html::img($model->getImage(), ['alt' => $model->title]) ?>
                                    </div>
                                    <h3 style="font-size:16px"><?= Html::decode($model->title) ?></h3>
                                    <h4 class=product-price>
                                        <div class=price><?= $model->price ? StringHelper::formatPrice(
                                                $model->price, 'VNĐ'
                                            ) : 'Liên hệ' ?></div>
                                    </h4>
                                </a></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class=swiper-pagination style="bottom:16px"></div>
            </div>
        <?php else: ?>
            <div class="empty-block">
                <img src="/images/no-content.jpg" alt="No content"/>
                <h4>Không có nội dung</h4>
            </div>
        <?php endif; ?>
    </div>
</aside>
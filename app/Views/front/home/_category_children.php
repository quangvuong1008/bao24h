<?php

use App\Helpers\Html;

/**
 * @var \App\Models\CategoryModel[] $models
 */
?>
<div class="swiper-wrapper no-js">
    <?php foreach ($models as $model) {
        echo Html::a(
            Html::tag(
                'div',
                Html::tag(
                    'div',
                    Html::tag('div', Html::img(
                        $model->getImage(),
                        ['alt' => $model->title, 'itemprop' => 'image']
                    ), ['class' => 'img-wrap']) . Html::tag('div', null, ['class' => 'shortContent']),
                    ['class' => 'product-img']
                ) . Html::tag('div', Html::tag('h3', $model->title), ['class' => 'caption text-center']),
                [
                    'class' => 'thumbnail product-box swiper-slide',
                    'itemscope' => true,
                    'itemtype' => 'http://schema.org/NewsArticle'
                ]
            ),
            $model->getUrl(),
            ['title' => $model->title]
        );
    } ?>
</div>
<div class=swiper-pagination></div>
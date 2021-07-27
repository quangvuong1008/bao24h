<?php

use App\Helpers\Html;
use App\Helpers\SettingHelper;

/**
 * @var \App\Models\NewsModel[] $models
 */
?>
<div class="row">
    <section class="col-md-12">
        <div class="row main-topic">
            <section class="homepage-row-product">
                <div class="homepage-row-product-title text-center">
                    <h2>
                        <a href="/kinh-nghiem-hay/" title="Kinh Nghiệm Hay ">Kinh Nghiệm Hay</a>
                    </h2>
                </div>
                <div class="col-md-8" style="margin-bottom:40px">
                    <img src="<?php echo SettingHelper::getSettingImage($home_banner_3); ?>" class="img-responsive">
                </div>
                <div class="col-md-4">
                    <?php foreach ($models as $news): ?>
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <?= Html::a($news->title, $news->getUrl(), ['title' => $news->title]) ?>
                                </h4>
                                <p><?=  date('d/m/Y H:i:s A', $news->created_at) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </section>
</div>

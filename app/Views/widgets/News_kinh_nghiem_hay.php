<?php

use App\Helpers\Html;

/**
 * @var \App\Models\ProjectCategoryModel[] $categories
 */
?>
<div class="homepage-row-product-title text-center">
    <h2>
        <a href="/kinh-nghiem-hay/" title="Kinh Nghiệm Hay ">Kinh Nghiệm Hay</a>
        <hr class="underline-title">
    </h2>
</div>
<div class="col-md-12 ">
    <div class="row">
        <?php if ($models): ?>
            <?php foreach ($models as $model): ?>
                <div class="col-md-5ths col-xs-6 fix-new-posts">
                    <a href="<?=$model->getUrl()?>">
                        <button type="button" data-toggle="modal" data-target="#video-"
                                data-src=" "
                                class="img-wrap anim fix-player-top">
                            <img src="<?=$model->getImage()?>" alt="<?=$model->title?>">
                        </button>
                    </a>
                    <div class="title-name" >
                        <a href="<?=$model->getUrl()?>"><?=$model->meta_description()?></a>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>


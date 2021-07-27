<?php

use App\Helpers\Html;
use App\Helpers\StringHelper;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\RouterUrlModel[] $models
 * @var \CodeIgniter\Pager\Pager $pager
 */
$this->title = 'Tìm kiếm';
?>
<div class="container">
    <?php if ($models && !empty($models)): ?>
        <div class="row">
            <?php foreach ($models as $model): ?>
                <div class="col-xs-12 col-md-3">
                    <a href="<?= $model->getUrl() ?>" class="product-box">
                        <div class="img-wrap">
                            <?= Html::img($model->getImage(), ['alt' => $model->original_title]) ?>
                        </div>
                        <p><?= Html::decode($model->original_title) ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center"><?= $pager->links() ?></div>
    <?php endif; ?>
    <?php if ($user_product && !empty($user_product)): ?>
        <div class="row">
            <?php foreach ($user_product as $user_prd): ?>
                <div class="col-xs-12 col-md-3">
                    <a href="<?= StringHelper::get_url_user_product($user_prd->title, $user_prd->id)?>" class="product-box">
                        <div class="img-wrap">
                            <?= Html::img( $user_prd->select_img_user_product(), ['alt' => $user_prd->title]) ?>
                        </div>
                        <p><?= Html::decode($user_prd->title) ?></p>
                        <div class="price">
                            <?=$user_prd->price ?>
                        </div>
                        <div class="extraInfo">


                            <div class="location">
                                <i class="fa--xf fas fa-map-marker-alt" aria-hidden="true"></i>
                                <?php echo $user_prd->select_province_user_product()?>
                            </div>


                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center"><?= $pagers->links() ?></div>
    <?php endif; ?>

</div>

<section class=col-md-12>
    <div class=tabProduct>
        <div class=row>
            <div class="homepage-row-product-title text-center">
                <h2>
                    <a href="/bi-quyet-lam-dep" title="Bí quyết làm đẹp">Bí quyết làm đẹp</a>
                </h2>
            </div>
        </div>
        <div>
            <div class="hidden-xs">
                <?php use App\Helpers\Html; ?>

                <div class="row">
                    <?php foreach ($models as $model):
                        ?>
                        <div class="col-md-3 col-xs-6 " style="margin-bottom: 10px">
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


            </div>

            <div class="visible-xs">

                <div class="row">
                    <?php foreach ($models as $category): ?>
                        <div class="col-xs-6 col-md-4">
                            <a href="<?= $category->getUrl() ?>" class="thumbnail product-box"
                               title="<?= Html::decode($category->title) ?>">
                                    <span class="img-wrap">
                                        <?= Html::img($category->getImage(), ['alt' => $category->title]) ?>
                                    </span>
                                <div class="caption" style="text-align: center; height: 70px"><span style="line-height: 35px"><?= Html::decode($category->title) ?></span></div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
</section>

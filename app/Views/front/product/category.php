 <?php

use App\Helpers\Html;
use App\Helpers\StringHelper;
use App\Helpers\Widgets\NewsWidget;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\ProductCategoryModel[] $categories
 * @var \App\Models\ProductModel[] $products
 */
$this->title = 'Danh mục sản phẩm';
?>
<div class="main-wrap">
    <div class="container">
        <section>
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center"><h2 class="title"><b>DANH MỤC SẢN PHẨM</b></h2></div>
                </div>
                <?php if ($categories && !empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <div class="col-md-2">
                            <div class="productCategory-block">
                                <a href="<?= $category->getUrl() ?>" title="<?= Html::decode($category->title) ?>">
                                    <div class="img-wrap">
                                        <?= Html::img($category->getImage(), ['alt' => $category->title]) ?>
                                    </div>
                                    <h3><?= Html::decode($category->title) ?></h3>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
        <img src="/images/shopbanner.png" class="img-responsive">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title text-center"><h4 class="title"><b>SẢN PHẨM MỚI</b></h4></div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <?php if ($products && !empty($products)): ?>
                                <?php foreach ($products as $product): ?>
                                    <div class="col-md-3">
                                        <div class="product-block text-center">
                                            <a href="<?= $product->getUrl() ?>"
                                               title="<?= Html::decode($product->title) ?>">
                                                <div class="img-wrap">
                                                    <?= Html::img($product->getImage(), ['alt' => $product->title]) ?>
                                                </div>
                                                <h3><?= Html::decode($product->title) ?></h3>
                                                <h4 class="product-price">
                                                    <div class="price"><?= $product->price ? StringHelper::formatPrice(
                                                            $product->price, 'VNĐ') : 'Liên hệ' ?></div>
                                                </h4>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="empty-block">
                                    <img src="/images/no-content.jpg" alt="No content"/>
                                    <h4>Không có dữ liệu</h4>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= NewsWidget::register($this) ?>
    </div>
</div>
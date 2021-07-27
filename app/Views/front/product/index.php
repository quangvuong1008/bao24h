<?php

use App\Helpers\Html;
use App\Helpers\StringHelper;
use App\Helpers\Widgets\BreadcrumbsWidget;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\ProductCategoryModel $model
 * @var \App\Models\ProductModel[] $products
 * @var \CodeIgniter\Pager\Pager $pager
 */
$this->title = Html::decode($model->title);

?>
<div class="main-wrap">
    <div class="container">
        <div class="row hidden-xs">
            <div class="col-md-12">
                <!--                <ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">-->
                <!--                    <li><a href="/" title="Trang Chủ">Trang Chủ</a></li>-->
                <!--                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem"><a-->
                <!--                                href="/cua-hang/" title="Cửa hàng" itemscope="" itemtype="http://schema.org/Thing"-->
                <!--                                itemprop="item"><span itemprop="name">Cửa hàng</span></a></li>-->
                <!--                    <li class="active"><a href="/cua-hang/tu-bep/" title="Tủ Bếp"><span>Tủ Bếp</span></a></li>-->
                <!--                </ol>-->
                <?= BreadcrumbsWidget::register($this, [
                    'links' => $model->breadcrumbs($model->getPrimaryKey())
                ]) ?>

            </div>
        </div>
        <?php

        if ($description) {
            ?>
            <div class="row ">
                <div class="col-md-12  ">
                    <div class="text-center heading-description">
                        <h1 ><?= $description ?></h1>
                    </div>

                </div>
            </div>
            <?php
        }
        ?>
        <div class="homepage-row-product-title text-center">
            <h2>
                <?= Html::a($model->title,$model->getUrl(),['title' => $model->title]) ?>
            </h2>
        </div>
        <?php if ($products && !empty($products)): ?>
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-3">
                        <div class="product-block ">
                            <?php
                            $title = $product->title;
                            $title_remove_tag = strip_tags($title);
                            $title = StringHelper::cut_string_by_length($title_remove_tag, '80');

                            $title_address = $product->address;
                            $title_remove_tag = strip_tags($title_address);
                            $title_address = StringHelper::cut_string_by_length($title_remove_tag, '20');
                            ?>
                            <a href="<?= StringHelper::get_url_user_product($product->title,$product->id) ?>" title="<?= $title_remove_tag ;?>">
                                <div class="img-wrap">
                                    <img src="<?php echo $product->select_img_user_product(); ?>"
                                         alt="<?= $title_remove_tag ;?>">
                                </div>
                                <div ><span>Mã BĐS: <span class="fix-left"><?php echo date('d/m/Y', $product->start_date); ?></span></span>
                                    <hr class="hr-bottom"></div>
                                <div class="box-flx">
                                    <h4 class="waper-title"><?= $title ?></h4>
                                    <div class="flx">
                                        <div class="fix-right">
                                            <span>Địa chỉ : <span class="fix-left"><?= $title_address ?></span></span><br/>
                                            <span>Giá :<span class="fix-left"><?=$product->price ?></span></span>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="text-center"><?= $pager->links('default', 'default_cms') ?></div>

        <?php else: ?>
            <div class="empty-block">
                <img src="/images/no-content.jpg" alt="No content"/>
                <h4>Không có sản phẩm nào thuộc danh mục này</h4>
            </div>
        <?php endif; ?>

    </div>
</div>
<?php

use App\Helpers\Html;
use App\Helpers\StringHelper;
use App\Helpers\Widgets\BreadcrumbsWidget;
use App\Helpers\Widgets\ProductRightBoxDetail;
use App\Helpers\Widgets\UserProductRightBoxWidget;
use App\Helpers\Widgets\NewsRightBoxWidget;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\ProductCategoryModel $category
 * @var \App\Models\ProductModel $model
 * @var \App\Models\ProductModel[] $products
 */
$this->title = Html::decode($model->title);
?>
<div class="main-wrap">
    <div class="container">
        <div class="row hidden-xs">
            <div class="col-md-12">
                <?= BreadcrumbsWidget::register($this, [
                    'links' => $category->breadcrumbs($category->getPrimaryKey())
                ], ['label' => $model->title,
                    'url' => $model->getUrl()]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div>
                    <article>
                        <section class="row">
                            <figure class=col-md-6>
                                <?php if (($gallery = $model->getGallery()) !== null && !empty($gallery)): ?>
                                    <div class="scrollable gallery-wrap">
                                        <ul class="singer-carousel no-js">
                                            <?php foreach ($gallery as $image): ?>
                                                <li data-thumb="<?= $image->url ?>"
                                                    data-src="<?= $image->url ?>">
                                                    <div class="img-wrap">
                                                        <?= Html::img($image->url, [
                                                            'alt' => $image->title ?: $model->title,
                                                        ]) ?>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </figure>
                            <div class="col-md-6">
                                <a href="#content" class="btn btn-primary btn-custom-primary">Xem nội dung bài đăng</a>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h1 class="product-page-title" itemprop="name">
                                            <b><?= Html::decode($model->title) ?></b>
                                        </h1>
                                    </div>
                                </div>
                                <h3>
                                    <div class="color-user-product-vip"> vị
                                        trí: <?php echo $model->select_province_user_product(); ?></div>
                                </h3>
                                <h4 class="product-price">
                                    <div class="color-user-product-vip">Giá
                                        : <?= $model->price; ?>
                                    </div>
                                </h4>
                                <p><strong>Thông tin liên hệ </strong></p>
                                <p>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="/images/icon-nguoidung.png" alt="">
                                    </div>
                                    <div class="col-sm-8">
                                        <span>Tên người bán : <span
                                                    class="fix-left"><?= $model->user_name ?></span></span><br/>
                                        <span>Điện thoại : <span
                                                    class="fix-left"><?= $model->user_phone ?></span> </span><br/>
                                        <span>Email : <span class="fix-left"><?= $model->user_email ?></span></span>
                                        <br/>
                                        <span>Địa chỉ : <span class="fix-left"><?= $model->user_address ?></span></span>
                                        <br/>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="row">
                            <div class="col-md-8">
                                <div>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#mota" aria-controls="mota" role="tab"
                                               data-toggle="tab">Nội dung bài đăng</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="mota">
                                            <div class="content-detail-user-product">
                                                <p><?php echo Html::decode($model->description) ?></p>
                                            </div>
                                            <!--                                            <article class="content-detail-user-product" id="content">-->
                                            <!--</article>-->
                                            <div class="content-article content-article-table " id="content">
                                                <?php echo Html::decode($model->content) ?>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="div-table">
                                                    <div class="div-table-row">
                                                        <div class="div-table-cell table1">
                                                            <div class="div-hold ">
                                                                <div class="header">Đặc điểm tin đăng</div>
                                                                <div class="table-detail" id="product-other-detail">
                                                                    <div class="row">
                                                                        <div class="left">
                                                                            Loại tin rao
                                                                        </div>
                                                                        <div class="right">
                                                                            <?= $model->select_sold_type_user_product() ?>
                                                                        </div>
                                                                        <div style="clear: both">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="left">
                                                                            Địa chỉ
                                                                        </div>
                                                                        <div class="right">
                                                                            <?= $model->address ?>
                                                                        </div>
                                                                        <div style="clear: both">
                                                                        </div>
                                                                    </div>
                                                                    <div id="LeftMainContent__productDetail_interior"
                                                                         class="row">
                                                                        <div class="left">
                                                                            Tên dự án
                                                                        </div>
                                                                        <div class="right">
                                                                            <?= $model->project ?>
                                                                        </div>
                                                                        <div style="clear: both">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="project">
                                                                    <div class="header"
                                                                         style="margin-top: 15px; line-height: 29px;">
                                                                        Thông tin thêm
                                                                        <div class="clear"></div>
                                                                    </div>
                                                                    <div class="table-detail">
                                                                        <div class="row">
                                                                            <div class="left">Loại hình đăng tin</div>
                                                                            <div class="right">
                                                                                <?= $model->product_type ?>
                                                                            </div>
                                                                            <div style="clear: both">
                                                                            </div>
                                                                        </div>
                                                                        <div id="LeftMainContent__productDetail_projectOwner"
                                                                             class="row">
                                                                            <div class="left">Ngày đăng tin</div>
                                                                            <div class="right">
                                                                                <?php echo date('d/m/Y', $model->start_date); ?>
                                                                            </div>
                                                                            <div style="clear: both">
                                                                            </div>
                                                                        </div>
                                                                        <div id="LeftMainContent__productDetail_projectSize"
                                                                             class="row">
                                                                            <div class="left">Ngày hết hạn</div>
                                                                            <div class="right">
                                                                                <?php echo date('d/m/Y', $model->end_date); ?>
                                                                            </div>
                                                                            <div style="clear: both">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="div-table-cell" style="width: 15px;"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>


                                </div>
                                <div class="tagpanel">
                                    <?php $cut_keyword = explode(',', $model->keyword) ?>
                                    <span>Tìm kiếm theo từ khóa :</span>
                                    <?php foreach ($cut_keyword as $cut_kw) {?>
                                    <a href="<?= StringHelper::get_url_user_product_keyword($cut_kw) ?>">
                                        <?php
                                            echo $cut_kw .',';
                                        ?></a>
                                    <?php }?>
                                </div>
                                <div class="n2h">
                                    <span class="t_nlh">Lưu ý</span><!-- End .t_nlh -->
                                    <div class="luu-y-color">
                                        Quý khách đang xem nội dung tin rao "
                                        <a href="<?= StringHelper::get_url_user_product($model->title, $model->id) ?>"><strong><?= $model->title?></strong></a>"
                                        . Mọi thông tin liên quan tới tin rao này là do người đăng tin đăng tải và chịu trách nhiệm. Chúng tôi luôn cố gắng để có chất lượng thông tin tốt nhất. Chúng tôi khhông chịu trách nhiệm nào về bất kỳ tổn thất, hay tranh chấp liên quan đến việc quý khách tham khảo thông tin trên website. Nếu quý khách phát hiện có sai sót hay vấn đề gì
                                        <a href="/lien-he" title=" Thông báo tin lỗi, nội dung xấu" target="_blank"> xin hãy thông báo cho chúng tôi</a>.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 hidden-xs">
                                <?= NewsRightBoxWidget::register($this); ?>
                            </div>
                        </section>
                    </article>
                </div>
                <?php if ($products && !empty($products)): ?>
                    <section>
                        <div class="row">
                            <div class="col-md-12 text-center"><h2 class="title-box2nd"><b>Tin liên quan khác</b></h2>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($products as $product): ?>
                                <div class="col-md-3">
                                    <div class="product-block ">
                                        <a href="<?= StringHelper::get_url_user_product($product->title, $product->id) ?>"
                                           title="<?= $title_remove_tag ?>">
                                            <div class="img-wrap">
                                                <img src="<?php echo $product->select_img_user_product(); ?>"
                                                     alt="<?= $title_remove_tag; ?>">
                                            </div>
                                            <div><span>Mã BĐS: <span
                                                            class="fix-left"><?php echo date('d/m/Y', $product->start_date); ?></span></span>
                                                <hr class="hr-bottom">
                                            </div>
                                            <div class="box-flx">
                                                <h4 class="waper-title"><?= $product->title ?></h4>
                                                <div class="flx">
                                                    <div class="fix-right">
                                                        <span>Địa chỉ : <span
                                                                    class="fix-left"><?= $product->address ?></span></span><br/>
                                                        <span>Giá :<span class="fix-left"><?= $product->price ?></span></span>
                                                    </div>

                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </section>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
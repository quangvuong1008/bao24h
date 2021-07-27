<?php

use App\Helpers\Html;
use App\Helpers\ArrayHelper;
use App\Helpers\SettingHelper;
use App\Helpers\SessionHelper;
use App\Helpers\Widgets\LeftUserPostWidget;

/**
 * @var \App\Models\FormRequestModel $model
 * @var array $message
 */
?>
<div class="container">

    <div class="row">
        <div class="col-md-3">
            <?= LeftUserPostWidget::register($this); ?>
        </div>
        <div class="col-md-9 nopadding-lft">
            <div class="profile-content module-user">
                <h1 class="title star"><span>Đăng tin rao vặt</span></h1>
                <div class="module-search postting">
                    <!-- FORM -->
                    <form action="<?php
                    if (!$model) {
                        echo base_url() . '/UserPostManage/insert_data_user_product';
                    } else {
                        echo base_url() . '/UserPostManage/update_data_user_product/' . $model->id;
                    }
                    ?>" method="POST"
                          class="form-horizontal" id="frmReal" role="form" enctype="multipart/form-data">
                        <div class="form-block clearfix">
                            <div class="title-block"><span>Lịch đăng tin</span></div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="title">Loại tin:</label>
                                </div>
                                <div class="col-sm-4">
                                    <?php if (is_object($user_packet)): ?>
                                        <?php foreach ($user_packet as $cal):
                                            ?>
                                            <input type="text" name="product_type" id="product_type"
                                                   class="form-control " readonly
                                                   numberonly="2" value="<?php echo $cal ?>">
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <input type="text" name="product_type" id="product_type" class="form-control "
                                               readonly
                                               numberonly="2" value="<?php echo $product_type; ?>">
                                    <?php endif; ?>
                                </div>
                                <small><strong>(Tin thường : 10 điểm/Tin đăng)</strong></small>
                            </div>
                            <div class="col-sm-6 nopadding-lft">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="title">Ngày bắt đầu <span class="mandatory">(*)</span>:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class='input-group date' id='start_date'>
                                            <input type='text' name="start_date" required
                                                   value="<?php if ($model && $model->start_date) {
                                                       echo date('d/m/Y', $model->start_date);
                                                   } ?>"
                                                   class="form-control"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 no-padding">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="title">Ngày kết thúc <span class="mandatory">(*)</span>:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class='input-group date' id='end_date'>

                                            <input type='text' name="end_date" class="form-control" required
                                                   value="<?php if ($model && $model->end_date) {
                                                       echo date('d/m/Y', $model->end_date);
                                                   } ?>"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-block clearfix">
                            <div class="title-block"><span>Thông tin cơ bản</span></div>
                            <div class="col-sm-6 nopadding-lft">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="title">Hình thức <span class="mandatory">(*)</span>:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="selectpicker form-control" name="sold_type"
                                                onchange="process_sold_type()" data-live-search="true" id="sold_type"
                                                required>
                                            <option value="">chọn hình thức</option>
                                            <?php
                                            if ($category_product) {
                                                foreach ($category_product as $category_prd) { ?>
                                                    <option value="<?= $category_prd->id ?>"
                                                        <?php if ($category_prd->id == $model->sold_type) {
                                                            echo 'selected';
                                                        } ?>>
                                                        <?= $category_prd->title ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                        <div class="errorMessage"></div>
                                    </div>
                                </div>
                                <!-- item -->
                                <!-- End Title -->
                            </div>
                            <div class="col-sm-6 no-padding">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="title">Danh mục<span class="mandatory">(*)</span>:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="selectpicker form-control" name="product_category_id"
                                                id="product_category_id" data-live-search="true" required>
                                            <option value="">chọn danh mục</option>
                                            <?php if ($category_product_parent) {
                                                foreach ($category_product_parent as $cate_prd_pr) { ?>
                                                    <option value="<?= $cate_prd_pr->id ?>"
                                                        <?php
                                                        if ($cate_prd_pr->id == $model->product_category_id) {
                                                            echo ' selected';
                                                        }

                                                        ?>>
                                                        <?= $cate_prd_pr->title ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                        <div class="errorMessage"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6 nopadding-lft">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="title">Tỉnh/Thành phố <span class="mandatory">(*)</span>:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="selectpicker form-control" name="province" id="province"
                                                onchange="process_district()" data-live-search="true">
                                            <option value="">Nhập tỉnh thành phố</option>

                                            <?php if ($provinces) {
                                                foreach ($provinces as $province) { ?>
                                                    <option value="<?= $province->id ?>"
                                                        <?php
                                                        if ($province->id == $select_province_id) {
                                                            echo ' selected';
                                                        }

                                                        ?>>
                                                        <?= $province->_name ?></option>
                                                <?php }
                                            } ?>

                                        </select>

                                        <div class="errorMessage"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6 no-padding">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="title">Quận/huyện <span class="mandatory">(*)</span>:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="selectpicker form-control" name="district" id="district"
                                                onchange="process_wards_and_street()" data-live-search="true ">

                                            <option data-tokens="ketchup mustard" value="">Nhập quận huyện</option>

                                            <?php if ($districts) {
                                                foreach ($districts as $district) { ?>
                                                    <option value="<?= $district->id ?>"
                                                        <?php
                                                        if ($district->id == $select_district_id) {
                                                            echo ' selected';
                                                        }

                                                        ?>>
                                                        <?= $district->_name ?></option>
                                                <?php }
                                            } ?>


                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-6 nopadding-lft">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="title">Giá :</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <?php if ($model) {
                                            $value = $model->price;
                                        } ?>
                                        <input type="text" name="price" id="price" class="form-control"
                                               numberonly="2" value="<?php echo $value ?>">
                                        <div class="errorMessage"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 no-padding">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="title">Đơn vị :</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="selectpicker form-control" name="unit" id="unit">
                                            <option data-tokens="mustard" value="vnd">VNĐ</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- End Title -->
                            </div>
                            <div class="form-group clear">
                                <div class="col-sm-2">
                                    <label for="title">Địa chỉ <span class="mandatory">(*)</span></label>
                                </div>
                                <div class="col-sm-10">
                                    <?php if ($model) {
                                        $value = $model->address;
                                    } ?>
                                    <input type="text" name="address" id="address" class="form-control"
                                           value="<?php echo $value ?>" required>
                                </div>
                            </div>
                        </div>
                        <!-- Thông tin khác -->
                        <div class="form-block clearfix">
                            <div class="title-block"><span>Mô tả chi tiết</span></div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="title">Tiêu đề <span class="mandatory">(*)</span></label>
                                </div>
                                <div class="col-sm-10">
                                    <span id="spanLuuY">(Nhập tối đa 65 ký tự , nhiều hơn sẽ bị mất chữ !)</span>
                                    <?php if ($model) {
                                        $value = $model->title;
                                    } ?>
                                    <input type="text" value="<?php echo $value ?>" name="title" maxlength="65"
                                           class="form-control " required>
                                    <div class="errorMessage"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="title">Tóm tắt <span class="mandatory">(*)</span></label>
                                </div>
                                <div class="col-sm-10">
                                    <span id="spanLuuY">(Nội dung tóm tắt không quá 350 ký tự , nhập quá sẽ bị mất chữ !)</span>
                                    <?php if ($model) {
                                        $value = $model->description;
                                    } ?>
                                    <textarea name="description" rows="5" cols="50" maxlength="350"
                                              class="form-control" required ><?php echo $value ?> </textarea>
                                    <div class="errorMessage"></div>
                                </div>
                            </div>
                            <!-- End Title -->
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="title">Nội dung <span class="mandatory">(*)</span></label>
                                </div>
                                <div class="col-sm-10">
                                    <span id="spanLuuY">(Nội dung giới thiệu quý khách vui lòng không nhập quá 2000 từ , nhập quá sẽ bị mất chữ !)</span>
                                    <?php if ($model) {
                                        $value = $model->content;
                                    } ?>
                                    <textarea name="content" id="mytextarea" rows="5" cols="50" maxlength="1000"
                                              class="form-control"><?php echo $value ?> </textarea>
                                    <div class="errorMessage"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="title">Từ khóa <span class="mandatory">(*)</span></label>
                                </div>
                                <div class="col-sm-10">
                                    <span id="spanLuuY">(vui lòng nhập từ khóa cho bài viết muốn hiển thị khách hàng tìm kiếm, tối đa 5 cụm từ !)</span>
                                    <?php if ($model) {
                                        $value = $model->keyword;
                                    } ?>
                                    <input type="text" value="<?php echo $value ?>" name="keyword" id="keyword"
                                           class="form-control " required>
                                    <div class="errorMessage"></div>
                                </div>
                            </div>
                            <!-- End nội dung -->
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="title">Cập nhật hình ảnh <span class="mandatory">(*)</span></label>
                                </div>
                                <div class="col-sm-10">
                                    <span id="spanLuuY">(Mỗi ảnh dung lượng không quá 1MB và mặc định hình đầu tiên là ảnh đại diện , mỗi bài đăng chỉ được nhập tối đa 5 ảnh !)</span>
                                    <input type="file" <?php if (isset($model_user_medias) && sizeof($model_user_medias) == 5) echo 'disabled' ?>
                                           name="user_media[]" value="" multiple <?php if (!$model_user_medias) {
                                        echo 'required';
                                    }else{
                                        echo '';
                                    }
                                    ?>>
                                    <div class="row user_prod_mg_top">
                                        <div class="col-sm-12">
                                            <?php if ($model_user_medias) { ?>
                                                <?php foreach ($model_user_medias as $model_user_media) { ?>
                                                    <div class="col-sm-3 div_img_upload_<?= $model_user_media->id ?>">
                                                        <div class="user_prd_image ">
                                                            <img src="<?php if ($model_user_media->user_product_id == $model->id) {
                                                                echo $model_user_media->url;
                                                            } ?>" alt="" class="img-thumbnail fix-width">
                                                        </div>
                                                        <a href="#"
                                                           onclick="delete_user_upload_img(<?= $model_user_media->id ?>)"
                                                           class="btn_delete_image"
                                                           data-url-post="<?= base_url() . '/UserPostManage/delete_image_user_upload' ?>">X</a>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-block">
                            <div class="title-block"><span>Thông tin liên hệ</span></div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="title">Tên hiển thị<span class="mandatory">(*)</span></label>
                                </div>
                                <div class="col-sm-10">
                                    <?php if ($model) {
                                        $value = $model->user_name;
                                    } ?>
                                    <input type="text" name="user_name" id="user_name" class="form-control"
                                           value="<?php echo $value ?>">
                                </div>
                            </div>
                            <!-- End Title -->
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="title">Địa chỉ</label>
                                </div>
                                <div class="col-sm-10">
                                    <?php if ($model) {
                                        $value = $model->user_address;
                                    } ?>
                                    <input type="text" name="user_address" id="user_address" class="form-control"
                                           value="<?php echo $value ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="title">Điện thoại<span class="mandatory">(*)</span></label>
                                </div>
                                <div class="col-sm-10">
                                    <?php if ($model) {
                                        $value = $model->user_phone;
                                    } ?>
                                    <input type="text" name="user_phone" id="user_phone" class="form-control"
                                           value="<?php echo $value ?>">
                                </div>
                            </div>
                            <!-- End Title -->
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <label for="title">E-mail <span class="mandatory">(*)</span></label>
                                </div>
                                <div class="col-sm-10">
                                    <?php if ($model) {
                                        $value = $model->user_email;
                                    } ?>
                                    <input type="email" name="user_email" id="user_email" class="form-control required"
                                           value="<?php echo $value ?>">
                                </div>
                            </div>


                            <!-- End Title -->
                        </div>
                        <input type="hidden" name="token" value="5433209a0a848e39eae7a7be30f9412f">
                        <!-- Thông tin liên hệ -->
                        <div class="form-group">
                            <div class="col-sm-2">
                                <label for="title"></label>
                            </div>

                            <button type="submit" class="btn btn-primary btn-blue"
                                    id="btn-posting">Đăng tin
                            </button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>



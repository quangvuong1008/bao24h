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
    <?php
    $message = SessionHelper::getInstance()->getFlash('REGISTER');
    if (!empty($message) && isset($message['type'])) {
        switch ($message['type']) {
            case 'FRONT_ERROR_CHANGE':
                echo Html::tag('div',
                    ArrayHelper::getValue($message, 'message', 'Kiểm tra lại thông tin nhập vào'),
                    ['class' => 'alert alert-danger']
                );
                break;
            case 'FRONT_SUCCESS_CHANGE':
                echo Html::tag('div',
                    ArrayHelper::getValue($message, 'message', 'Đăng ký thành công'),
                    ['class' => 'alert alert-success']
                );
                break;
        }
    } ?>
    <div class="row">
        <div class="col-md-3">
            <?= LeftUserPostWidget::register($this); ?>
        </div>
        <div class="col-md-9 nopadding-lft">
            <div class="profile-content module-user">
                <h1 class="title star"><span>THAY ĐỔI THÔNG TIN CÁ NHÂN</span></h1>
                <div class="module-search">
                    <div class="module-search postting">
                        <!-- FORM -->
                        <form action="<?= base_url().'/UserPostManage/update_change_user_information'?>" method="POST" class="form-horizontal" id="frmReal" role="form">
                            <?php if ($models) {?>
                            <div class="form-block clearfix">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="title">Tên hiển thị <span class="mandatory">(*)</span></label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?=$models->full_name ?>" name="full_name" id="full_name" class="form-control" >
                                        <div class="errorMessage"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="title">Tên đăng nhập :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" disabled="disabled" value="" name="username" id="username" class="form-control" placeholder="<?= $models->username ?>">
                                        <div class="errorMessage"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="title">E-mail <span class="mandatory">(*) :</span></label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" disabled="disabled" value="" name="email" id="email" class="form-control" placeholder="<?= $models->email ?>">
                                        <div class="errorMessage"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="title">Điện thoại <span class="mandatory">(*) :</span></label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?=$models->phone ?>" name="phone" id="phone" class="form-control" >
                                        <div class="errorMessage"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="title">Địa chỉ :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" value="<?=$models->address ?>" name="address" id="address" class="form-control" >
                                        <div class="errorMessage"></div>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <input type="hidden" name="token" value="2f32f9bfa81dbdd88c3e3ca4fe2aaa37">
                            <!-- Thông tin liên hệ -->
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <label for="title"></label>
                                </div>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary btn-blue" id="btn-posting">Lưu thay đổi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


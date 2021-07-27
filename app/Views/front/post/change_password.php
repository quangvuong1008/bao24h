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
            case 'FRONT_ERROR_CHANGE_PASSWORD':
                echo Html::tag('div',
                    ArrayHelper::getValue($message, 'message', 'Kiểm tra lại thông tin nhập vào'),
                    ['class' => 'alert alert-danger']
                );
                break;
            case 'FRONT_SUCCESS_CHANGE_PASSWORD':
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
                <h1 class="title star"><span>THAY ĐỔI MẬT KHẨU</span></h1>
                <div class="module-search">
                    <div class="module-search postting">
                        <!-- FORM -->
                        <form action="<?= base_url().'/UserPostManage/update_change_password'?>" method="POST" class="form-horizontal" id="frmReal" role="form">
                            <div class="form-block clearfix">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="title">Mật khẩu cũ <span class="mandatory">(*)</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="password" value="" name="old_password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="title">Mật khẩu mới <span class="mandatory">(*)</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="password" value="" name="password" class="form-control" required>
                                    </div>
                                </div>
                                <input type="hidden" name="token" value="3c334d9000e2e393196f8c9831384cef">
                            </div>
                            <div class="form-block noborder">
                                <!-- Action Form -->
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="title"></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <button type="submit" class="btn btn-primary btn-blue" id="btn-posting">Lưu thay đổi</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


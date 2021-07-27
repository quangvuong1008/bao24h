<?php

use App\Helpers\Html;
use App\Helpers\ArrayHelper;
use App\Helpers\SessionHelper;
use App\Helpers\SettingHelper;

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
            case 'FRONT_ERROR':
                echo Html::tag('div',
                    ArrayHelper::getValue($message, 'message', 'Kiểm tra lại thông tin nhập vào'),
                    ['class' => 'alert alert-danger']
                );
                break;
            case 'FRONT_SUCCESS':
                echo Html::tag('div',
                    ArrayHelper::getValue($message, 'message', 'Đăng ký thành công'),
                    ['class' => 'alert alert-success']
                );
                break;
        }
    } ?>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        <span><i class="far fa-edit"></i>Đăng ký tài khoản</span>
                    </div>
                </div>
                <div class="panel-body ">
                    <form action="<?= base_url().'/Users/add_register'?>" id="form" method="post" class="data-form-register"  >
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" id="full_name" type="text" name="full_name" placeholder="Họ tên" required >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" id="username" type="text" name="username" placeholder="Tên đăng nhập" required >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" id="password" type="password" name="password" placeholder="Mật khẩu" required >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" id="email" type="email" name="email" placeholder="Email" required >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" id="address" type="text" name="address" placeholder="Địa chỉ" required >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" id="phone" type="text" name="phone" placeholder="Điện thoại" required >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control" id="avatar" type="file" name="avatar" placeholder="avatar" >
                                </div>
                            </div>
                        </div>
                        <div class="g-recaptcha" data-sitekey="6Lc0hskUAAAAAMmUCydmMLuiApwcbMyQpygWkHei"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit"  class="btn btn-default">Đăng ký</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="panel-footer">
                    <div class="text-center">
                        <p>chưa phải là thành viên ? <a href="/users-login">Đăng nhập</a></p>
                        <p><a href="">Quên mật khẩu</a></p>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="login-content">
                <a href=""><img src="/images/register.png" class="img-responsive" alt=""></a>

            </div>
        </div>
    </div>
</div>


<?php

use App\Helpers\Html;
use App\Helpers\ArrayHelper;
use App\Helpers\SettingHelper;
use App\Helpers\SessionHelper;

/**
 * @var \App\Models\FormRequestModel $model
 * @var array $message
 */
$this->title = $title ;
?>
<div class="container">
    <?php
    $message = SessionHelper::getInstance()->getFlash('REGISTER');
    if (!empty($message) && isset($message['type'])) {
        switch ($message['type']) {
            case 'FRONT_ERROR_LOGIN':
                echo Html::tag('div',
                    ArrayHelper::getValue($message, 'message', 'Tài khoản mật khẩu không đúng hoặc chưa được xác nhận'),
                    ['class' => 'alert alert-danger']
                );
                break;
            case 'FRONT_SUCCESS_LOGIN':
                echo Html::tag('div',
                    ArrayHelper::getValue($message, 'message', 'Đăng nhập thành công'),
                    ['class' => 'alert alert-success']
                );
                break;
        }
    } ?>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                       <span><i class="fas fa-sign-in-alt"></i> Đăng nhập</span>
                    </div>
                </div>
                <div class="panel-body ">
                    <form action="<?= base_url().'/Users/user_login'?>" method="post">
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
                                <button type="submit"  class="btn btn-default-default">Đăng nhập</button>
                            </div>
                        </div>
                    </div>

                    </form>
                </div>
                <div class="panel-footer">
                    <div class="text-center">
                        <p>chưa phải là thành viên ? <a href="/users-register">Đăng ký tài khoản</a></p>
                        <p><a href="">Quên mật khẩu</a></p>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-8">
            <div class="login-content">
                <a href=""><img src="/images/signin.png" class="img-responsive" alt=""></a>

            </div>
        </div>
    </div>
</div>


<?php

use App\Helpers\Html;

/** @var \App\Libraries\BaseView $this */
/** @var bool $requestInit */
/** @var \App\Models\Forms\AdminLoginModel $model */
/** @var \CodeIgniter\Validation\Validation $validator */

$this->title = 'Đăng nhập vào hệ thống';
$asset = \App\Helpers\Assets\MaterialDashboard::getAsset();
?>
<div class="row">
    <div class="col-lg-4 col-md-4 offset-lg-4">
        <div class="login-wrap">
            <div class="card">
                <div class="card-header card-header-success text-center">
                    <h4 class="card-title"><?= $this->title ?></h4>
                    <p class="card-category">Nhập thông tin đăng nhập</p>
                </div>
                <div class="card-body">
                    <?php if ($requestInit): ?>
                        <div class="text-center">
                            <img src="<?= $asset->createUrl('img/new_logo.png') ?>" alt="">
                            <p>Khởi tạo tài khoản quản trị viên trước</p>
                            <a href="<?= route_to('admin_initialize') ?>"
                               class="btn btn-info btn-round">Bắt đầu</a>
                        </div>
                    <?php else: ?>
                        <form action="<?= route_to('admin_auth_login') ?>" method="post">
                            <div class="form-group">
                                <label class="bmd-label-floating">Tên đăng nhập</label>
                                <?= Html::textInput('account_name', $model->account_name, [
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'autofocus' => !$model->account_name
                                ]) ?>
                            </div>
                            <div class="form-group">
                                <label class="bmd-label-floating">Mật khẩu</label>
                                <?= Html::passwordInput('account_password', null, [
                                    'class' => 'form-control',
                                    'autocomplete' => 'off',
                                    'autofocus' => !!$model->account_name
                                ]) ?>
                            </div>

                            <?php if ($validator): ?>
                            <div class="alert alert-danger">
                                <ul style="margin: 0; padding-left: 16px;">
                                    <?php foreach ($validator->getErrors() as $error): ?>
                                    <li><?= Html::decode($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endif; ?>

                            <div class="text-center">
                                <button class="btn btn-success btn-round" type="submit">Đăng nhập</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
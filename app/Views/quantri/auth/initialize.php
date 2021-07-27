<?php

use App\Helpers\Html;

/** @var \App\Libraries\BaseView $this */
/** @var \App\Models\AdministratorModel $model */
/** @var \CodeIgniter\Validation\Validation $validator */

$this->title = 'Khởi tạo tài khoản quản trị hệ thống';
?>
<div class="row">
    <div class="col-lg-4 col-md-4 offset-lg-4">
        <div class="login-wrap">
            <div class="card">
                <div class="card-header card-header-danger text-center">
                    <h4 class="card-title"><?= $this->title ?></h4>
                    <p class="card-category">Nhập thông tin đăng nhập</p>
                </div>
                <div class="card-body table-responsive">
                    <form action="<?= route_to('admin_initialize') ?>" method="post">
                        <div class="form-group">
                            <label class="bmd-label-floating">Họ và tên</label>
                            <input type="text" name="full_name" autocomplete="off" class="form-control" autofocus
                                   value="">
                        </div>
                        <div class="form-group">
                            <label class="bmd-label-floating">Tên đăng nhập</label>
                            <input type="text" name="account_name" autocomplete="off" class="form-control"
                                   value="">
                        </div>
                        <div class="form-group">
                            <label class="bmd-label-floating">Mật khẩu</label>
                            <input type="password" name="password" autocomplete="off" class="form-control"
                                   value="">
                        </div>

                        <div class="form-check">
                            <?= Html::hiddenInput('login_after_init', 0) ?>
                            <label class="form-check-label">
                                <?= Html::checkbox('login_after_init', $model->login_after_init == 1, [
                                    'value' => 1, 'class' => 'form-check-input'
                                ]) ?> Đăng nhập sau khi khởi tạo
                                <span class="form-check-sign"><span class="check"></span></span>
                            </label>
                        </div>

                        <div class="form-group text-center">
                            <button class="btn btn-danger btn-round" type="submit">Khởi tạo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
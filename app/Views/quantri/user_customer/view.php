<?php

use App\Helpers\Html;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\FormRequestModel $model
 * @var \CodeIgniter\Validation\Validation $validator
 */
$this->title = 'Đổi mật khẩu người dùng ';
?>
<div class="row">
    <div class="col-lg-6 col-md-6 offset-lg-3 offset-md-3">
        <div class="card">
            <div class="card-header card-header-info flex-align">
                <div>
                    <h4 class="card-title"><?= $this->title ?></h4>
                </div>
                <a href="<?= route_to('admin_user_customer') ?>" class="btn btn-round">Huỷ</a>
            </div>
            <div class="card-body">
                <form action="<?= route_to('admin_user_customer_view', $model->getPrimaryKey()) ?>" method="post"
                      enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="bmd-label-floating">Họ tên</label>
                        <input type="text" name="full_name" autocomplete="off" value="<?php echo $model->full_name?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label class="bmd-label-floating">Tên đăng nhập </label>
                        <input type="text" name="username" autocomplete="off" value="<?php echo $model->username?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label class="bmd-label-floating">Mật khẩu</label>
                        <input type="password" name="password" autocomplete="off" class="form-control" required>
                    </div>
                    <div class="card-bottom-actions">
                        <div class="flex-row" id="add-holder"></div>
                        <button class="btn btn-info btn-round"  type="submit">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
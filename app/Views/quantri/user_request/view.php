<?php

use App\Helpers\Html;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\FormRequestModel $model
 * @var \CodeIgniter\Validation\Validation $validator
 */
$this->title = 'Chi tiết yêu cầu gọi lại';
?>
<div class="row">
    <div class="col-lg-6 col-md-6 offset-lg-3 offset-md-3">
        <div class="card">
            <div class="card-header card-header-info flex-align">
                <div>
                    <h4 class="card-title"><?= $this->title ?></h4>
                </div>
                <a href="<?= route_to('admin_user_request') ?>" class="btn btn-round">Huỷ</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th class="row-actions">Họ tên</th>
                        <td><?= Html::decode($model->full_name) ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Email</th>
                        <td><?= Html::a($model->email, "mailto:{$model->email}") ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Số điện thoại</th>
                        <td><?= Html::decode($model->phone) ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Tình trạng</th>
                        <td>
                            <strong class="<?= $model->is_done == 1 ? 'text-success' : 'text-danger' ?>">
                                <?= $model->is_done == 1 ? 'Đã xử lý' : 'Chưa xử lý' ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <th class="row-actions">Đường dẫn...</th>
                        <td><?= Html::a($model->ref_url, $model->ref_url, ['target' => '_blank']) ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Yêu cầu</th>
                        <td><?= Html::decode($model->request) ?></td>
                    </tr>
                    </tbody>
                </table>
                <div class="text-right">
                    <?= !$model->is_done ? Html::a('Cập nhật đã xử lý',
                        route_to('admin_user_request_update', $model->getPrimaryKey()),
                        [
                            'class' => 'btn btn-success btn-round',
                            'data-prompt' => 'Xác nhận đánh dấu yêu cầu này là đã xử lý?',
                            'data-method' => 'post'
                        ]
                    ) : null ?>
                </div>
            </div>
        </div>
    </div>
</div>
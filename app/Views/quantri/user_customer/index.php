<?php

use App\Helpers\Html;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\FormCartOrderModel[] $models
 * @var \CodeIgniter\Pager\Pager $pager
 */

$this->title = 'Quản lý Danh sách Người Dùng';
?>
<div class="card">
    <div class="card-header card-header-info flex-align">
        <div>
            <h4 class="card-title"><?= $this->title ?></h4>
            <p class="card-category">...</p>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>TT</th>
                <th>Họ tên</th>
                <th>Tên đăng nhập</th>
                <th>email</th>
                <th>số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Ngày đăng ký</th>
                <th>khóa</th>
                <th class="row-actions">Trạng thái</th>
                <th class="row-actions text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!$models || empty($models)): ?>
                <tr>
                    <td colspan="100">
                        <div class="empty-block">
                            <img src="/images/no-content.jpg" alt="No content"/>
                            <h4>Không có nội dung</h4>
                        </div>
                    </td>
                </tr>
            <?php else: ?>
                <?php
                foreach ($models as $model): ?>
                    <tr>
                        <td class="row-actions text-center"><?= $model->id ?></td>
                        <td><?= Html::decode($model->full_name) ?></td>
                        <td><?= Html::decode($model->username) ?></td>
                        <td><?= Html::a($model->email,"mailto:{$model->email}") ?></td>
                        <td><?= Html::decode($model->phone) ?></td>
                        <td><?= Html::decode($model->address) ?></td>
                        <td> <?php echo date('d/m/Y', $model->created_at); ?> </td>
                        <td class="text-center row-actions">
                            <?= Html::tag('i',
                                $model->is_lock == 0 ? 'lock_open' : 'lock',
                                ['class' => [
                                    'material-icons inline-icon',
                                    $model->is_lock == 0 ? 'text-success' : 'text-danger'
                                ]]
                            ) ?>
                        </td>
                        <td class="text-center row-actions">
                            <?= Html::tag('i',
                                $model->active == 0 ? 'announcement' : 'playlist_add_check',
                                ['class' => [
                                    'material-icons inline-icon',
                                    $model->active == 0 ? 'text-danger' : 'text-success'
                                ]]
                            ) ?>
                        </td>
                        <td class="row-actions">
                            <a href="<?= route_to('admin_user_customer_view', $model->getPrimaryKey()) ?>"
                               class="btn btn-warning btn-just-icon" title="đổi mật khẩu">
                                <i class="material-icons ">vpn_key</i>
                            </a>
                            <a href="<?= route_to('admin_user_customer_update', $model->getPrimaryKey()) ?>"
                               class="btn btn-info btn-just-icon" title="Sửa thông tin người dùng">
                                <i class="material-icons">edit</i>
                            </a>
                            <a href="<?= route_to('admin_user_customer_delete', $model->getPrimaryKey()) ?>"
                               class="btn btn-danger btn-just-icon" data-method="post"
                               data-prompt="Bạn có chắc sẽ xoá đi mục này?" title="Xóa">
                                <i class="material-icons">delete</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif ?>
            </tbody>
        </table>
        <?= $pager->links('default', 'default_cms') ?>
    </div>
</div>

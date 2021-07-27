<?php

use App\Helpers\Html;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\FormCartOrderModel[] $models
 * @var \CodeIgniter\Pager\Pager $pager
 */

$this->title = 'Quản lý Danh sách Đơn hàng';
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
                <th>Email</th>
                <th>Số điên thoại</th>
                <th>Thời gian</th>
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
                <?php foreach ($models as $model): ?>
                    <tr>
                        <td class="row-actions text-center"><?= $model->id ?></td>
                        <td><?= Html::decode($model->full_name) ?></td>
                        <td><?= Html::a($model->email, "mailto:{$model->email}") ?></td>
                        <td><?= Html::decode($model->phone) ?></td>
                        <td><?= $model->created_at ?></td>
                        <td class="text-center row-actions">
                            <?= Html::tag('i',
                                $model->is_done == 0 ? 'announcement' : 'playlist_add_check',
                                ['class' => [
                                    'material-icons inline-icon',
                                    $model->is_done == 0 ? 'text-danger' : 'text-success'
                                ]]
                            ) ?>
                        </td>
                        <td class="row-actions">
                            <a href="<?= route_to('admin_cart_view', $model->getPrimaryKey()) ?>"
                               class="btn btn-warning btn-just-icon">
                                <i class="material-icons">remove_red_eye</i>
                            </a>
                            <a href="<?= route_to('admin_cart_delete', $model->getPrimaryKey()) ?>"
                               class="btn btn-danger btn-just-icon" data-method="post"
                               data-prompt="Bạn có chắc sẽ xoá đi mục này?">
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

<?php

use App\Helpers\Html;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\AdministratorModel[] $models
 * @var \CodeIgniter\Pager\Pager $pager
 */

$this->title = 'Quản lý Quản trị viên';
?>
<div class="card">
    <div class="card-header card-header-info flex-align">
        <div>
            <h4 class="card-title"><?= $this->title ?></h4>
            <p class="card-category">...</p>
        </div>
        <a href="<?= route_to('administrator_create') ?>" class="btn btn-warning btn-round">Thêm mới</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>TT</th>
                <th>Họ tên</th>
                <th>Tên đăng nhập</th>
                <th class="row-actions">Admin</th>
                <th class="row-actions">Khoá</th>
                <th class="row-actions">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!$models || empty($models)): ?>
                <tr>
                    <td colspan="100">
                        <div class="empty-block">
                            <img src="/images/no-content.jpg" alt="No content"/>
                            <h4>Không có nội dung</h4>
                            <a class="btn btn-info btn-round"
                               href="<?= route_to('administrator_create') ?>">Thêm</a>
                        </div>
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($models as $model): ?>
                    <tr>
                        <td><?= $model->id ?></td>
                        <td><?= Html::decode($model->full_name) ?></td>
                        <td><?= Html::decode($model->account_name) ?></td>
                        <td class="text-center row-actions">
                            <?= Html::tag('i',
                                $model->type == $model::TYPE_ADMIN ? 'check_box' : 'check_box_outlined_blank',
                                ['class' => 'material-icons inline-icon text-primary']
                            ) ?>
                        </td>
                        <td class="text-center row-actions">
                            <?= Html::tag('i',
                                $model->is_lock == 0 ? 'lock_open' : 'lock',
                                ['class' => [
                                    'material-icons inline-icon',
                                    $model->is_lock == 0 ? 'text-success' : 'text-danger'
                                ]]
                            ) ?>
                        </td>
                        <td class="row-actions">
                            <a href="<?= route_to('administrator_update', $model->getPrimaryKey()) ?>"
                               class="btn btn-info btn-just-icon">
                                <i class="material-icons">edit</i>
                            </a>
                            <a href="<?= route_to('administrator_delete', $model->getPrimaryKey()) ?>"
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
    </div>
</div>

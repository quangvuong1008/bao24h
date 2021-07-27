<?php

use App\Helpers\Html;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\ProjectModel[] $models
 * @var \CodeIgniter\Pager\Pager $pager
 */

$this->title = 'Quản lý Slider trang chủ';
?>
<div class="card">
    <div class="card-header card-header-info flex-align">
        <div>
            <h4 class="card-title"><?= $this->title ?></h4>
            <p class="card-category">...</p>
        </div>
        <a href="<?= route_to('admin_slider_create') ?>" class="btn btn-warning btn-round">Thêm mới</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>TT</th>
                <th>Tiêu đề</th>
                <th>Đường dẫn</th>
                <th>Khoá</th>
                <th>Actions</th>
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
                               href="<?= route_to('admin_slider_create') ?>">Thêm</a>
                        </div>
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($models as $model): ?>
                    <tr>
                        <td class="row-actions text-center"><?= $model->id ?></td>
                        <td><?= Html::decode($model->title) ?></td>
                        <td><?= $model->url ?></td>
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
                            <a href="<?= route_to('admin_slider_update', $model->getPrimaryKey()) ?>"
                               class="btn btn-info btn-just-icon">
                                <i class="material-icons">edit</i>
                            </a>
                            <a href="<?= route_to('admin_slider_delete', $model->getPrimaryKey()) ?>"
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

<?php

use App\Helpers\Html;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\NewsModel[] $models
 * @var \CodeIgniter\Pager\Pager $pager
 */

$this->title = 'Quản lý bài viết';
?>
<div class="card">
    <div class="card-header card-header-info flex-align">
        <div>
            <h4 class="card-title"><?= $this->title ?></h4>
            <p class="card-category">...</p>
        </div>
        <a href="<?= route_to('admin_posts_create') ?>" class="btn btn-warning btn-round">Thêm mới</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>TT</th>
                <th>Tiêu đề</th>
                <th>Slug</th>
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
                               href="<?= route_to('admin_posts_create') ?>">Thêm</a>
                        </div>
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($models as $model): ?>
                    <tr>
                        <td class="row-actions text-center"><?= $model->id ?></td>
                        <td><?= Html::decode($model->title) ?></td>
                        <td><?= Html::decode($model->slug) ?></td>
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
                            <!-- Button trigger modal -->
                            <?= Html::a('<i class="material-icons" style="color: aliceblue">style</i>', '#', [
                                'class' => ['btn', 'btn-warning', 'btn-just-icon'],
                                'title' => 'Meta tags',
                                'onclick' => 'show_up_meta_post(\''.base_url().'\','. $model->getPrimaryKey().')'
                            ]) ?>

                            <?= Html::a('<i class="material-icons">edit</i>', ['admin_posts_update', $model->getPrimaryKey()], [
                                'class' => ['btn', 'btn-info', 'btn-just-icon'],
                                'title' => 'Sửa'
                            ]) ?>
                            <a href="<?= route_to('admin_posts_delete', $model->getPrimaryKey()) ?>"
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

<div id="div_modal_meta_data">

</div>






<?php
/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\CategoryModel $model
 * @var \CodeIgniter\Validation\Validation $validator
 */
$this->title = 'Cập nhật bài viết';
?>
<div class="card">
    <div class="card-header card-header-info flex-align">
        <div>
            <h4 class="card-title"><?= $this->title ?></h4>
        </div>
        <a href="<?= route_to('admin_posts') ?>" data-method="get"
           data-prompt="Những thay đổi đều chưa được lưu. Bạn có muốn tiếp tục?" class="btn btn-round">Huỷ</a>
        <a href="<?= route_to('admin_posts_delete', $model->getPrimaryKey()) ?>" data-method="post"
           data-prompt="Bạn có chắc sẽ xoá đi mục này?" class="btn btn-danger btn-round">Xoá</a>
    </div>
    <div class="card-body">
        <form action="<?= route_to('admin_posts_update', $model->getPrimaryKey()) ?>" method="post"
              enctype="multipart/form-data">

            <?= $this->import('_form', ['model' => $model, 'validator' => $validator]) ?>

            <div class="card-bottom-actions">
                <div class="flex-row" id="add-holder"></div>
                <button class="btn btn-info btn-round" type="submit">Cập nhật</button>
            </div>
        </form>
    </div>
</div>
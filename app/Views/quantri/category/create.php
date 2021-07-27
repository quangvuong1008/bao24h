<?php
/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\CategoryModel $model
 * @var \CodeIgniter\Validation\Validation $validator
 */
$this->title = 'Tạo mới danh mục';
?>
<div class="card">
    <div class="card-header card-header-success flex-align">
        <div>
            <h4 class="card-title"><?= $this->title ?></h4>
        </div>
        <a href="<?= route_to('admin_category') ?>" class="btn btn-round">Huỷ</a>
    </div>
    <div class="card-body">
        <form action="<?= route_to('admin_category_create') ?>" method="post" enctype="multipart/form-data">

            <?= $this->import('_form', ['model' => $model, 'validator' => $validator]) ?>

            <div class="card-bottom-actions">
                <div class="flex-row" id="add-holder"></div>
                <a class="btn btn-outline-light btn-round" data-method="get"
                   data-prompt="Những thay đổi đều chưa được lưu. Bạn có muốn tiếp tục?"
                   href="<?= route_to('admin_project_category') ?>">Huỷ
                </a>
                <button class="btn btn-success btn-round" type="submit">Thêm mới</button>
            </div>
        </form>
    </div>
</div>
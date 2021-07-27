<?php
/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\TestimonialModel $model
 * @var \CodeIgniter\Validation\Validation $validator
 */
$this->title = 'Tạo mới Đối tác viết bài';
?>
<div class="card">
    <div class="card-header card-header-success flex-align">
        <div>
            <h4 class="card-title"><?= $this->title ?></h4>
        </div>
        <a href="<?= route_to('admin_partner') ?>" class="btn btn-round">Huỷ</a>
    </div>
    <div class="card-body">
        <form action="<?= route_to('admin_partner_create') ?>" method="post"
              enctype="multipart/form-data">

            <?= $this->import('_form', ['model' => $model, 'validator' => $validator]) ?>

            <div class="card-bottom-actions">
                <div class="flex-row" id="add-holder"></div>
                <button class="btn btn-success btn-round" type="submit">Thêm mới</button>
            </div>
        </form>
    </div>
</div>
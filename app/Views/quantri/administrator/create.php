<?php
use App\Helpers\Html;
/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\ProjectCategoryModel $model
 * @var \CodeIgniter\Validation\Validation $validator
 */
$this->title = 'Tạo mới Quản trị viên';
?>
<div class="row">
    <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4">
        <div class="card">
            <div class="card-header card-header-success flex-align">
                <div>
                    <h4 class="card-title"><?= $this->title ?></h4>
                </div>
                <a href="<?= route_to('administrator') ?>" class="btn btn-round">Huỷ</a>
            </div>
            <div class="card-body">
                <form action="<?= route_to('administrator_create') ?>" method="post"
                      enctype="multipart/form-data">

                    <?= $this->import('_form', ['model' => $model]) ?>

                    <?php if ($validator): ?>
                        <div class="alert alert-danger" style="margin-top: 32px;">
                            <ul style="margin: 0; padding-left: 16px;">
                                <?php foreach ($validator->getErrors() as $error): ?>
                                    <li><?= Html::decode($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="card-bottom-actions">
                        <div class="flex-row" id="add-holder"></div>
                        <button class="btn btn-success btn-round" type="submit">Thêm mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
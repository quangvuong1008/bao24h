<?php
use App\Helpers\Html;
/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\ProjectModel $model
 * @var \CodeIgniter\Validation\Validation $validator
 */
$this->title = 'Cập nhật gói tin';
?>
<div class="row">
    <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4">
        <div class="card">
            <div class="card-header card-header-info flex-align">
                <div>
                    <h4 class="card-title"><?= $this->title ?></h4>
                </div>
                <a href="<?= route_to('admin_packet') ?>" data-method="get"
                   data-prompt="Những thay đổi đều chưa được lưu. Bạn có muốn tiếp tục?" class="btn btn-round">Huỷ</a>
                <a href="<?= route_to('admin_packet_delete', $model->getPrimaryKey()) ?>" data-method="post"
                   data-prompt="Bạn có chắc sẽ xoá đi mục này?" class="btn btn-danger btn-round">Xoá</a>
            </div>
            <div class="card-body">
                <form action="<?= route_to('admin_packet_update', $model->getPrimaryKey()) ?>" method="post"
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
                        <button class="btn btn-info btn-round"  type="submit">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
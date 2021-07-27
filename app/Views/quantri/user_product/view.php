<?php

use App\Helpers\Html;
use App\Helpers\StringHelper;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\FormRequestModel $model
 * @var \CodeIgniter\Validation\Validation $validator
 */
$this->title = 'Chi tiết Bài đăng';
?>
<div class="row">
    <div class="col-lg-6 col-md-6 offset-lg-3 offset-md-3">
        <div class="card">
            <div class="card-header card-header-info flex-align">
                <div>
                    <h4 class="card-title"><?= $this->title ?></h4>
                </div>
                <a href="<?= route_to('admin_user_product') ?>" class="btn btn-round">Huỷ</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                    <?php
                    $title = $model->title;
                    $title_remove_tag = strip_tags($title);
                    $title_cut = StringHelper::cut_string_by_length($title_remove_tag, '65');

                    $content = $model->content;
                    $content_remove_tag = strip_tags($content);
                    $content_cut = StringHelper::cut_string_by_length($content_remove_tag, '350');
                    ?>
                    <tr>
                        <th class="row-actions">Họ tên</th>
                        <td><?= Html::decode($model->select_user_id()); ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Loại tin</th>
                        <td><?= Html::decode($model->product_type) ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Loại bài đăng</th>
                        <td><?php echo $model->select_sold_type_user_product()?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Địa chỉ</th>
                        <td><?= Html::decode($model->address) ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Tiêu đề</th>
                        <td><?= Html::decode($title_cut) ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Giá</th>
                        <td><?= Html::decode($model->price) ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">nội dung</th>
                        <td><?= Html::decode($content_cut) ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Hình ảnh</th>
                        <td><img src="<?= Html::decode($model->select_img_user_product()); ?>" class="img-thumbnail" alt=""></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Tình trạng</th>
                        <td>
                            <strong class="<?= $model->status == 1 ? 'text-success' : 'text-danger' ?>">
                                <?= $model->status == 1 ? 'Hoạt động' : 'Không hoạt động' ?>
                            </strong>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <form action="<?= route_to('admin_user_product_update', $model->getPrimaryKey()) ?>" method="POST">
                    <div class="form-check">
                        <?= Html::hiddenInput('is_lock', 0) ?>
                        <label class="form-check-label">
                            <?= Html::checkbox('is_lock', $model->is_lock == 1, [
                                'value' => 1, 'class' => 'form-check-input'
                            ]) ?> Khoá
                            <span class="form-check-sign"><span class="check"></span></span>
                        </label>
                    </div>
                    <div class="card-bottom-actions">
                        <div class="flex-row" id="add-holder"></div>
                        <button class="btn btn-info btn-round"  type="submit">Cập nhật</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
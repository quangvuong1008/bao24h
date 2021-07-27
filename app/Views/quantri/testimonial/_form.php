<?php

use App\Helpers\Html;

/**
 * @var \App\Models\TestimonialModel $model
 * @var \CodeIgniter\Validation\Validation $validator
 */
?>
<div class="row">
    <div class="col-md-8 col-lg-8">
        <div class="form-group">
            <label class="bmd-label-floating">Họ tên khách hàng</label>
            <input type="text" name="full_name" autocomplete="off" class="form-control" autofocus
                   value="<?= $model->full_name ?>">
        </div>
        <div class="form-group">
            <label class="bmd-label-floating">Đường dẫn</label>
            <input type="text" name="url" autocomplete="off" class="form-control"
                   value="<?= $model->url ?>">
        </div>
        <div class="form-intro">
            <label class="bmd-label no-margin">Nhận xét</label>
            <textarea name="intro" autocomplete="off" class="form-control"><?= $model->intro ?></textarea>
        </div>
    </div>
    <div class="col-lg-4 col-lg-4">
        <?php if ($validator): ?>
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 16px;">
                    <?php foreach ($validator->getErrors() as $error): ?>
                        <li><?= Html::decode($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div>
            <label class="bmd-label-floating">Ảnh đại diện</label>
            <div class="uploaded-image-wrap">
                <div class="image-preview thumbnail">
                    <?= img($model->getImage()) ?>
                </div>
                <input type="file" name="image" class="form-control">
            </div>
        </div>

        <div class="form-check">
            <?= Html::hiddenInput('is_lock', 0) ?>
            <label class="form-check-label">
                <?= Html::checkbox('is_lock', $model->is_lock == 1, [
                    'value' => 1, 'class' => 'form-check-input'
                ]) ?> Khoá
                <span class="form-check-sign"><span class="check"></span></span>
            </label>
        </div>
    </div>
</div>

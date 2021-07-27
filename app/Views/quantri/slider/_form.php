<?php
use App\Helpers\Html;
/**
 * @var \App\Models\SliderModel $model
 * @var \CodeIgniter\Validation\Validation $validator
 */
?>
<div class="row">
    <div class="col-md-4 col-lg-4">
        <div class="form-group">
            <label class="bmd-label-floating">Tiêu đề</label>
            <input type="text" name="title" autocomplete="off" class="form-control" autofocus
                   value="<?= $model->title ?>">
        </div>
        <div class="form-group">
            <label class="bmd-label-floating">Đường dẫn</label>
            <input type="text" name="url" autocomplete="off" class="form-control"
                   value="<?= $model->url ?>">
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
        <?php if ($validator): ?>
            <div class="alert alert-danger" style="margin-top: 32px;">
                <ul style="margin: 0; padding-left: 16px;">
                    <?php foreach ($validator->getErrors() as $error): ?>
                        <li><?= Html::decode($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

    </div>
    <div class="col-lg-8 col-lg-8">
        <div>
            <label class="bmd-label-floating">Ảnh đại diện</label>
            <div class="uploaded-image-wrap">
                <div class="image-preview thumbnail">
                    <?= img($model->getImage()) ?>
                </div>
                <input type="file" name="image" class="form-control">
            </div>
        </div>
    </div>
</div>

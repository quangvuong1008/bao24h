<?php

use App\Helpers\Html;

/**
 * @var \App\Models\ProductModel $model
 * @var \CodeIgniter\Validation\Validation $validator
 */
?>
<div class="row">
    <div class="col-md-8 col-lg-8">
        <div class="form-group">
            <label class="bmd-label-floating">Tiêu đề</label>
            <input type="text" name="title" autocomplete="off" class="form-control" autofocus
                   value="<?= $model->title ?>">
        </div>
        <div class="form-group">
            <label class="bmd-label-floating">Slug</label>
            <input type="text" name="slug" autocomplete="off" class="form-control"
                   placeholder="Để trống nếu muốn tự động thêm vào..."
                   value="<?= $model->slug ?>">
        </div>
        <div class="form-intro">
            <label class="bmd-label no-margin">Giới thiệu</label>
            <textarea name="intro" autocomplete="off" class="form-control content-js"
                      id="category-intro"><?= $model->intro ?></textarea>
        </div>

        <div class="form-intro">
            <label class="bmd-label no-margin">Nội dung</label>
            <textarea name="content" autocomplete="off" class="form-control content-js" data-height="560"
                      id="category-content"><?= $model->content ?></textarea>
        </div>


        <label class="bmd-label no-margin">Thư viện ảnh</label>
        <?php if (($gallery = $model->getGallery()) !== null && !empty($gallery)): ?>
            <div class="row">
                <?php foreach ($gallery as $item): ?>
                    <div class="col-lg-4">
                        <div class="thumbnail">
                            <?= Html::img($item->getImage(), ['alt' => $item->title ?: $model->title]) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?= Html::fileInput('gallery[]', null, [
            'class' => 'form-control', 'multiple' => 'true', 'accept' => 'image/*'
        ]) ?>
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

        <div class="form-group">
            <label class="bmd-label-floating">Danh mục</label>
            <?= Html::hiddenInput('category_id', $model->category_id ?: 0) ?>
            <?= Html::dropDownList('category_id', $model->category_id, $model->getCategoryOptions(), [
                'class' => 'form-control',
            ]) ?>
        </div>

        <div class="form-group">
            <label class="bmd-label-floating">Giá bán</label>
            <?= Html::hiddenInput('price', 0) ?>
            <input type="number" name="price" autocomplete="off" class="form-control" value="<?= $model->price ?>">
        </div>

        <div class="form-group">
            <label class="bmd-label-floating">Giảm giá</label>
            <?= Html::hiddenInput('discount', 0) ?>
            <input type="number" name="discount" autocomplete="off" class="form-control"
                   value="<?= $model->discount ?>">
        </div>

        <div class="form-group">
            <label class="bmd-label-floating">Chất liệu</label>
            <input type="text" name="material" autocomplete="off" class="form-control"
                   value="<?= $model->material ?>">
        </div>

        <div class="form-group">
            <label class="bmd-label-floating">Bảo hành</label>
            <input type="text" name="guarantee" autocomplete="off" class="form-control"
                   value="<?= $model->guarantee ?>">
        </div>

        <div class="form-group">
            <label class="bmd-label-floating">Thêm mô tả...</label>
            <?= Html::textarea('short_intro', $model->short_intro, ['class' => 'form-control', 'rows' => 5]) ?>
        </div>

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

<?php

use App\Helpers\Html;

/**
 * @var \App\Models\AdministratorModel $model
 */
?>
<div class="form-group">
    <label class="bmd-label-floating">Họ và tên</label>
    <?= Html::textInput('full_name', $model->full_name, [
        'autocomplete' => 'off',
        'class' => 'form-control',
        'autofocus' => true,
    ]) ?>
</div>
<div class="form-group">
    <label class="bmd-label-floating">Tên đăng nhập</label>
    <?= Html::textInput('account_name', $model->account_name, [
        'autocomplete' => 'off',
        'class' => 'form-control'
    ]) ?>
</div>
<div class="form-group">
    <label class="bmd-label-floating">Mật khẩu</label>
    <input type="password" name="password" autocomplete="off" class="form-control">
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
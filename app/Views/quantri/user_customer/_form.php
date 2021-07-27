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
    <?= Html::textInput('username', $model->username, [
        'autocomplete' => 'off',
        'class' => 'form-control',
        'disabled' => 'disabled'
    ]) ?>
</div>
<div class="form-group">
    <label class="bmd-label-floating">email</label>
    <?= Html::textInput('email', $model->email, [
        'autocomplete' => 'off',
        'class' => 'form-control',
        'disabled' => 'disabled'
    ]) ?>
</div>
<div class="form-group">
    <label class="bmd-label-floating">Điện thoại</label>
    <?= Html::textInput('phone', $model->phone, [
        'autocomplete' => 'off',
        'class' => 'form-control'
    ]) ?>
</div>
<div class="form-group">
    <label class="bmd-label-floating">Địa chỉ</label>
    <input type="text" name="address" autocomplete="off" value="<?= $model->address ?>" class="form-control">
</div>
<div class="form-group">
    <label class="bmd-label-floating">Gói Tin</label>
    <select class="selectpicker form-control" name="packet">
        <option value="">Chọn gói tin</option>
        <?php
        if ($packet) {
            foreach ($packet as $pk) {


                ?>
                <option value="<?= $pk->id ?>"
                    <?php

                    if ($pk->id == $get_packet->packet_id) {
                        echo ' selected';
                    }
                    ?>>  <?= $pk->name ?></option>
            <?php }
        }
        ?>
    </select>
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

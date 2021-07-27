<?php

use App\Helpers\Html;

/**
 * @var \App\Models\AdministratorModel $model
 */
?>
<div class="form-group">
    <label class="bmd-label-floating">Tên gói</label>
    <?= Html::textInput('name', $model->name, [
        'autocomplete' => 'off',
        'class' => 'form-control',
        'autofocus' => true,
    ]) ?>
</div>
<div class="form-group">
    <label class="bmd-label-floating">Số lượng tin</label>
    <?= Html::textInput('number_post', $model->number_post, [
        'autocomplete' => 'off',
        'class' => 'form-control',
    ]) ?>
</div>
<div class="form-group">
    <label class="bmd-label-floating">Phạm vi gói tin</label>
    <?= Html::textInput('range_type', $model->range_type, [
        'autocomplete' => 'off',
        'class' => 'form-control',
    ]) ?>
</div>
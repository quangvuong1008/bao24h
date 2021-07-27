<?php
use App\Helpers\Html;
/**
 * @var \App\Models\CategoryModel $model
 */
?>
<tr>
    <td class="row-actions text-center"><?= $model->id ?></td>
    <td><?=  Html::decode($model->title) ?></td>
    <td><?= $model->slug ?></td>
    <td class="text-center row-actions">
        <?= Html::tag('i',
            $model->is_lock == 0 ? 'lock_open' : 'lock',
            ['class' => [
                'material-icons inline-icon',
                $model->is_lock == 0 ? 'text-success' : 'text-danger'
            ]]
        ) ?>
    </td>
    <td class="row-actions">
        <a href="<?= $model->getUpdateUrl() ?>" class="btn btn-info btn-just-icon">
            <i class="material-icons">edit</i>
        </a>
        <a href="<?= route_to('admin_posts_delete', $model->getPrimaryKey()) ?>"
           class="btn btn-danger btn-just-icon" data-method="post" data-prompt="Bạn có chắc sẽ xoá đi mục này?">
            <i class="material-icons">delete</i>
        </a>
    </td>
</tr>

<?php

use App\Helpers\Html;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\CategoryModel[] $models
 * @var \CodeIgniter\Pager\Pager $pager
 */

$this->title = 'Danh mục Sản phẩm';
function renderChildren($models, \App\Libraries\BaseView $view): string
{
    $html = '';
    foreach ($models as $model) {
        $html .= $view->import('_item_row', ['model' => $model]) . "\n";
             if ($model->children) {
            $html .= renderChildren($model->children, $view);
        }
    }
    return $html;
}
?>
<div class="card">
    <div class="card-header card-header-info flex-align">
        <div>
            <h4 class="card-title"><?= $this->title ?></h4>
            <p class="card-category">...</p>
        </div>
        <a href="<?= route_to('admin_product_category_create') ?>"
           class="btn btn-warning btn-round">Thêm mới</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>TT</th>
                <th>Tiêu đề</th>
                <th>Slug</th>
                <th>Menu_order</th>
                <th>Khoá</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php if (!$models || empty($models)): ?>
                <tr>
                    <td colspan="100">
                        <div class="empty-block">
                            <img src="/images/no-content.jpg" alt="No content"/>
                            <h4>Không có nội dung</h4>
                            <a class="btn btn-info btn-round"
                               href="<?= route_to('admin_category_create') ?>">Thêm</a>
                        </div>
                    </td>
                </tr>
            <?php else: ?>
                <?= renderChildren($models, $this) ?>
            <?php endif ?>
            </tbody>
        </table>

    </div>
</div>

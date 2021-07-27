<?php

use App\Helpers\Html;
use App\Helpers\StringHelper;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\FormCartOrderModel $model
 * @var \App\Models\FormCartOrderItemModel[] $items
 * @var \CodeIgniter\Validation\Validation $validator
 * @var \CodeIgniter\Pager\Pager $pager
 */
$this->title = 'Chi tiết đơn hàng';
?>
<div class="card">
    <div class="card-header card-header-<?= $model->is_done ? 'success' : 'info' ?> flex-align">
        <div>
            <h4 class="card-title"><?= $this->title ?></h4>
        </div>
        <a href="<?= route_to('admin_cart') ?>" class="btn btn-round">Huỷ</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-5 col-md-5">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th class="row-actions">Họ tên</th>
                        <td><?= Html::decode($model->full_name) ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Email</th>
                        <td><?= Html::a($model->email, "mailto:{$model->email}") ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Số điện thoại</th>
                        <td><?= Html::decode($model->phone) ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Địa chỉ</th>
                        <td><?= Html::decode($model->address) ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Yêu cầu</th>
                        <td><?= Html::decode($model->note) ?></td>
                    </tr>
                    <tr>
                        <th class="row-actions">Tình trạng</th>
                        <td>
                            <strong class="<?= $model->is_done == 1 ? 'text-success' : 'text-danger' ?>">
                                <?= $model->is_done == 1 ? 'Đã xử lý' : 'Chưa xử lý' ?>
                            </strong>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-7 col-md-7">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>TT</th>
                        <th>Ảnh</th>
                        <th>Sản phẩm</th>
                        <th class="text-right">SL</th>
                        <th class="text-right row-actions">Đơn giá</th>
                        <th class="text-right row-actions">Thành tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $no => $item): ?>
                        <tr>
                            <td class="row-actions"><?= $no + 1 ?></td>
                            <td class="row-actions">
                                <?= Html::img($item->image, ['alt' => $item->title, 'width' => 80]) ?>
                            </td>
                            <td>
                                <p><strong><?= Html::decode($item->title) ?></strong></p>
                                <p>
                                    <?= Html::a('Xem sản phẩm', $item->url, ['target' => '_blank']) ?>
                                    |
                                    <?= Html::a(
                                        'Quản lý sản phẩm',
                                        route_to('admin_product_update', $item->product_id),
                                        ['target' => '_blank']
                                    ) ?>
                                </p>
                            </td>
                            <td class="text-right"><?= $item->quantity ?></td>
                            <td class="text-right"><?= StringHelper::formatPrice($item->price) ?></td>
                            <td class="text-right"><?= StringHelper::formatPrice($item->total) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <th colspan="3">Tổng cộng</th>
                        <th class="text-right"><?= $model->quantity ?></th>
                        <th class="text-right" colspan="2"><?= StringHelper::formatPrice($model->total) ?></th>
                    </tr>
                    </tbody>
                </table>
                <?= $pager->links('default', 'default_cms') ?>
                <div class="text-right">
                    <?= !$model->is_done ? Html::a('Cập nhật đã xử lý',
                        route_to('admin_cart_update', $model->getPrimaryKey()),
                        [
                            'class' => 'btn btn-success btn-round',
                            'data-prompt' => 'Xác nhận đánh dấu yêu cầu này là đã xử lý?',
                            'data-method' => 'post'
                        ]
                    ) : null ?>
                </div>
            </div>
        </div>
    </div>
</div>
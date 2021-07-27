<?php

use App\Helpers\Html;
use App\Helpers\StringHelper;

/**
 * @var array $cart
 * @var \App\Models\FormCartOrderModel $model
 */
?>
<div class="main-wrap">
    <div class="section">
        <div class="container">
            <form action="<?= route_to('cart_checkout') ?>" method="post">
                <div class="row">
                    <div class="col-md-7">
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Thông tin gửi hàng</h3>
                                <p><br>Hãy điền các thông tin dưới đây, chúng tôi sẽ liên hệ với bạn khi cần thiết.</p>
                            </div>
                            <div class="form-group">
                                <?= Html::input('text', 'full_name', $model->full_name, [
                                    'placeholder' => 'Họ tên',
                                    'required' => true,
                                    'class' => 'form-control'
                                ]) ?>
                            </div>
                            <div class="form-group">
                                <?= Html::input('email', 'email', $model->email, [
                                    'placeholder' => 'Địa chỉ email',
                                    'required' => true,
                                    'class' => 'form-control'
                                ]) ?>
                            </div>
                            <div class="form-group">
                                <?= Html::input('tel', 'phone', $model->phone, [
                                    'placeholder' => 'Số điện thoại',
                                    'required' => true,
                                    'class' => 'form-control'
                                ]) ?>
                            </div>
                            <div class="form-group">
                                <?= Html::input('text', 'address', $model->address, [
                                    'placeholder' => 'Địa chỉ',
                                    'required' => true,
                                    'class' => 'form-control'
                                ]) ?>
                            </div>
                            <div class="form-group">
                                <?= Html::textarea('note', $model->note, [
                                    'placeholder' => 'Ghi chú đơn hàng',
                                    'required' => true,
                                    'class' => 'form-control'
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center"><h3 class="title">Đơn hàng của bạn</h3></div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>Sản phẩm</strong></div>
                                <div><strong>Tổng tiền</strong></div>
                            </div>
                            <?php foreach ($cart['items'] as $item): ?>
                                <div class="order-products">
                                    <div class="order-col">
                                        <div><?= Html::decode($item['data']['title']) ?></div>
                                        <div><?= StringHelper::formatPrice($item['sum']) ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div class="order-col">
                                <div><strong>Tổng đơn hàng</strong></div>
                                <div><strong class="order-total"><?= StringHelper::formatPrice($cart['sum']) ?></strong>
                                </div>
                            </div>
                            <?= Html::submitButton('Xác nhận', [
                                'class' => 'btn btn-danger btn-custom-red order-submit'
                            ]) ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
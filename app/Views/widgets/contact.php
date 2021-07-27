<?php

use App\Helpers\Html;
use App\Helpers\ArrayHelper;
use App\Helpers\SettingHelper;

/**
 * @var \App\Models\FormRequestModel $model
 * @var array $message
 */
?>
<aside class="panel panel-inverse hidden-xs">
    <div class="panel-heading text-center"><h3>Yêu cầu hỗ trợ</h3></div>
    <div class="panel-body">
        <div class="phone-request">
            <form action="<?= route_to('home_register') ?>" method="post">
                <div class="img-wrap square">
                    <img src="<?php echo SettingHelper::getSettingImage($contact_box_banner); ?>">
                </div>
                <?php if (!empty($message) && isset($message['type'])) {
                    switch ($message['type']) {
                        case 'FRONT_ERROR':
                            echo Html::tag('div',
                                ArrayHelper::getValue($message, 'message', 'Kiểm tra lại thông tin nhập vào'),
                                ['class' => 'alert alert-danger']
                            );
                            break;
                        case 'FRONT_SUCCESS':
                            echo Html::tag('div',
                                ArrayHelper::getValue($message, 'message', 'Gửi yêu cầu thành công'),
                                ['class' => 'alert alert-success']
                            );
                            break;
                    }
                } ?>
                <div class=input-group>
                    <?= Html::input('text', 'full_name', $model->full_name, [
                        'placeholder' => 'Họ tên',
                        'required' => true,
                        'class' => 'form-control'
                    ]) ?>
                    <div class="form-inline" style="display:inline-flex;">
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
                    </div>
                    <?= Html::textarea('request', $model->request, [
                        'placeholder' => 'Yêu cầu',
                        'required' => true,
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <div class="g-recaptcha" data-sitekey="6Lc0hskUAAAAAMmUCydmMLuiApwcbMyQpygWkHei"></div>
                <button class="btn btn-default btn-color-default" type="submit">Gọi lại cho tôi!</button>

                <?= Html::hiddenInput('ref_url', current_url()) ?>
            </form>
        </div>
    </div>
</aside>
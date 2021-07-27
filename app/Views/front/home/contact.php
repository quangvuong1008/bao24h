<?php

use App\Helpers\Html;
use App\Helpers\ArrayHelper;
use App\Helpers\Widgets\BreadcrumbsWidget;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\FormRequestModel $model
 * @var array $message
 */
$this->title = 'Gửi yêu cầu liên hệ';
?>
<div class="main-wrap">
    <div class="container">
        <div class="row hidden-xs">
            <div class="col-md-12">
                <?= BreadcrumbsWidget::register($this, [
                    'links' => [['label'=>'Gửi yêu cầu liên hệ', 'url'=> base_url('lien-he')]]
                ]) ?>
            </div>
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
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <h3><strong>Thông tin liên hệ</strong></h3>
                <p><span style=font-size:12pt><strong><?= $settings['home_ten_doanh_nghiep'] ?></strong></span></p>
                <span style="font-size:12pt">
                    <strong>Hotline: <span style="color:#ff0000">
                            <a style=color:#ff0000 href="tel:<?= $settings['home_hot_line'] ?>"><?= $settings['home_hot_line'] ?></a></span>
                    </strong>
                    <strong>- Tel:</strong> <span style="color:#ff0000">
                        <strong><a style="color:#ff0000" href="tel:<?= $settings['home_goi_ngay'] ?>"><?= $settings['home_goi_ngay'] ?></a></strong>
                    </span>
                </span>
                </p>
                <p>
                <span style="font-size:12pt">
                    <strong>Email: </strong>
                    <span style=font-size:12pt><?= $settings['home_email'] ?></span>
                </span>
                </p>
                <p>
                <span style=font-size:11pt>
                    <strong>Địa chỉ: VP: </strong>
                    <em>
                        <a rel="noopener noreferrer" href="<?= $settings['home_link_map_dia_chi'] ?>" target="_blank"
                           title="google maps"><?= $settings['home_dia_chi'] ?></a>
                    </em>
                    <strong><br>Chí Nhánh:</strong>
                    <span style=font-size:11pt>
                        <a href="<?= $settings['home_link_map_chi_nhanh'] ?>"><?= $settings['home_chi_nhanh'] ?></a>
                        
                    </span>
                </span>
                </p>
            </div>
            <div class="col-md-6 col-lg-6">
                <form action="<?= route_to('home_register') ?>" method="post">
                    <div class="form-group">
                        <?= Html::input('text', 'full_name', $model->full_name, [
                            'placeholder' => 'Họ tên',
                            'required' => true,
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <?= Html::input('email', 'email', $model->email, [
                                    'placeholder' => 'Địa chỉ email',
                                    'required' => true,
                                    'class' => 'form-control'
                                ]) ?>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <?= Html::input('tel', 'phone', $model->phone, [
                                    'placeholder' => 'Số điện thoại',
                                    'required' => true,
                                    'class' => 'form-control'
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= Html::textarea('request', $model->request, [
                            'placeholder' => 'Yêu cầu',
                            'required' => true,
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6Lc0hskUAAAAAMmUCydmMLuiApwcbMyQpygWkHei"></div>
                    <div class="form-group">
                        <button class="btn btn-default btn-block btn-color-default" type="submit">Gửi yêu cầu liên hệ</button>
                    </div>
                    <?= Html::hiddenInput('ref_url', current_url()) ?>
                </form>
            </div>
        </div>

    </div>
    <div class="embed-responsive embed-responsive-wide" style="padding-top: 24%;">
        <?= $settings['home_embed_map_lien_he'] ?>
    </div>
</div>

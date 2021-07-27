<?php

use App\Helpers\Html;
use App\Helpers\ArrayHelper;
use App\Helpers\SettingHelper;
use App\Helpers\SessionHelper;
use App\Helpers\Widgets\LeftUserPostWidget;

/**
 * @var \App\Models\FormRequestModel $model
 * @var array $message
 */
?>
<div class="container">
    <?php
    $message = SessionHelper::getInstance()->getFlash('REGISTER');
    if (!empty($message) && isset($message['type'])) {
        switch ($message['type']) {
            case 'FRONT_ERROR_INDEX':
                echo Html::tag('div',
                    ArrayHelper::getValue($message, 'message', 'Kiểm tra lại thông tin nhập vào'),
                    ['class' => 'alert alert-danger']
                );
                break;
            case 'FRONT_SUCCESS_INDEX':
                echo Html::tag('div',
                    ArrayHelper::getValue($message, 'message', 'Đăng ký thành công'),
                    ['class' => 'alert alert-success']
                );
                break;
        }
    } ?>
    <div class="row">
        <div class="col-md-3">
            <?= LeftUserPostWidget::register($this); ?>
        </div>
        <div class="col-md-9 nopadding-lft">
            <div class="profile-content module-user">
                <h1 class="title star"><span>QUẢN LÝ TIN ĐĂNG</span></h1>
                <div class="module-search">
                    <form action="" method="GET" role="form">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="selectpicker form-control" data-live-search="true">
                                        <option data-tokens="ketchup mustard" value="tin_thuong">Tin thường</option>
                                        <option data-tokens="mustard" value="tin_vip">Tin vip</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="sr-only" for=""></label>
                                    <div class='input-group date' id='start_date'>
                                        <input type='text' class="form-control"/>
                                        <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="sr-only" for=""></label>
                                    <div class='input-group date' id='end_date'>
                                        <input type='text' class="form-control"/>
                                        <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="selectpicker form-control" data-live-search="true">
                                        <option data-tokens="ketchup mustard">Hot Dog</option>
                                        <option data-tokens="mustard">Burger</option>
                                        <option data-tokens="frosting">Sugar</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-blue">Tìm kiếm</button>
                    </form>
                </div>
                <!-- End module searhc -->
                <div class="module-search">
                    <span class="title">Tìm theo mã tin :</span>
                    <form action="" method="GET" class="form-inline" role="form">
                        <div class="form-group">
                            <label class="sr-only" for=""></label>
                            <input type="text" class="form-control" id="matin" placeholder="Nhập mã tin">
                        </div>
                        <button type="submit" class="btn btn-info btn-blue">Tìm kiếm</button>
                    </form>
                </div>
                <!-- End module searhc -->
                <div class="module-search" style="margin-bottom:0px;">
                    <table class="table table-bordered member-table-data">
                        <thead>
                        <tr>
                            <th style="width:12%;" class="text-center">Mã tin</th>
                            <th class="text-center">Tiêu Đề</th>
                            <th class="text-center" style="width: 10%;">Trạng thái</th>
                            <th class="text-center" style="width: 10%;">Ngày đăng</th>
                            <th class="text-center" style="width: 10%;">Hết hạn</th>
                            <th style="width: 10%;" class="text-center">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!$list_user_post || empty($list_user_post)): ?>
                            <tr>
                                <td colspan="100">
                                    <div class="empty-block">
                                        <img src="/images/no-content.jpg" alt="No content"/>
                                        <h4>Không có nội dung</h4>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                        <?php foreach ($list_user_post as $list_up) : ?>
                                <tr>
                                    <td class="text-center"><?= $list_up->id ?></td>
                                    <td class="text-center"><?= Html::decode($list_up->title) ?></td>
                                    <td class="text-center row-actions">
                                        <?= Html::tag('i',
                                            $list_up->status == 0 ? '<i class="fas fa-comment-alt"></i>' : '<i class="fas fa-tasks"></i>',
                                            ['class' => [
                                                'material-icons inline-icon',
                                                $list_up->status == 0 ? 'text-danger' : 'text-success'
                                            ]]
                                        ) ?>
                                    </td>
                                    <td class="text-center"><?php echo date('d/m/Y', $list_up->start_date); ?></td>
                                    <td class="text-center"><?php echo date('d/m/Y', $list_up->end_date); ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url().'/UserPostManage/updateUserPosts/'.$list_up->id ?>"
                                           class=" btn-just-icon" data-method="post"
                                           data-prompt="Bạn có chắc sẽ xoá đi mục này?">
                                            <i class="fas fa-edit edit_user_post" title="sửa"></i>
                                        </a>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        <?php endif ?>
                        </tbody>

                    </table>
                    <div class="text-center"><?= $pager->links('default', 'default_cms') ?></div>
                </div>
            </div>
        </div>
    </div>
</div>


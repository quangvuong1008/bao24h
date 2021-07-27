<?php

use App\Helpers\Html;

/**
 * @var array $nav
 */
?>
<footer>
    <div class=container>
        <div class=col-md-4>
            <h3 style="font-size: 14px"><strong>KẾT NỐI MẠNG XÃ HỘI</strong></h3>
            <div>
                <div class="fb-page" data-href="<?= $settings['home_link_facebook'] ?>" data-tabs="timeline" data-width="340" data-height="130"
                     data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="false">
                    <blockquote cite="<?= $settings['home_link_facebook'] ?>" class="fb-xfbml-parse-ignore">
                        <a href="<?= $settings['home_link_facebook'] ?>">Kênh Marketing</a></blockquote>
                </div>
            </div>
        </div>
        <div class=col-md-4>
            <h3 style="text-align:left;font-size: 14px;text-transform: uppercase;"><strong>Hỗ trợ khách hàng</strong></h3>
            <div style="padding-left: 0px">
            <?php foreach ($nav as $item): ?>
                <p style="text-align:left">
                    <?= Html::a($item['label'], base_url($item['url']), [
                        'title' => $item['title'],
                        'ref' => 'nofollow'
                    ]) ?>
                </p>
            <?php endforeach; ?>
            </div>
		<a href="//www.dmca.com/Protection/Status.aspx?ID=5768f13a-27ba-4c0b-857e-59a3fcada35e" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="https://images.dmca.com/Badges/_dmca_premi_badge_4.png?ID=5768f13a-27ba-4c0b-857e-59a3fcada35e"  alt="DMCA.com Protection Status" /></a>  <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
        </div>
        <div class=col-md-4>
            <h3 style="font-size: 14px;"><strong><?= $settings['home_ten_doanh_nghiep'] ?></strong></h3>
            <div style="padding-left: 0px;">
            <p>
                <span ><em><strong>Mã số thuế: </strong><?= $settings['home_ma_so_thue'] ?><strong> Ngày đăng ký: </strong><?= $settings['home_ngay_dang_ky_mst'] ?></em></span>
            </p>
            <p>
                <span >
                    <strong> Tel: <span style="color:#ff0000">
                            <a style=color:#ff0000 href="tel:<?= $settings['home_goi_ngay'] ?>"><?= $settings['home_goi_ngay'] ?></a></span>
                    </strong>
                    <strong>- Hotline:</strong> <span style="color:#ff0000">
                        <strong><a style="color:#ff0000" href="tel:<?= $settings['home_hot_line'] ?>"><?= $settings['home_hot_line'] ?></a></strong>
                    </span>
                </span>
            </p>
            <p>
                <span >
                    <strong>Email: </strong>
                    <span ><?= $settings['home_email'] ?></span>
                </span>
            </p>
            <p>
                <span >
                    <strong>Địa chỉ VP: </strong>
                    <em>
                        <a rel="noopener noreferrer" href="<?= $settings['home_link_map_dia_chi'] ?>" target="_blank"
                           ><?= $settings['home_dia_chi'] ?></a>
                    </em>
                    <strong><br>Chi Nhánh:</strong>
                    <span >
                        <a href="<?= $settings['home_link_map_chi_nhanh'] ?>"><?= $settings['home_chi_nhanh'] ?></a>
                        
                    </span>
                </span>
            </p>
            </div>
        </div>
    </div>
</footer>
<a href=# id=top>↑</a>
<a href="tel:<?= $settings['home_hot_line'] ?>" id="callButton" class="hidden-xs">
    <img src="/images/hot-line.png">
</a>
<ul id=mobile-bar class=visible-xs>

    <li style="background-color:white">
        <a href="tel:<?= $settings['home_zalo'] ?>" target="_blank">
            <img src=/images/za-lo.png width=36>
        </a>
    </li>
    <li style="background-color:white">
        <a href="<?= $settings['home_link_facebook'] ?>" target=_blank>
            <img src="/images/face-book.png?v1" width=36>
        </a>
    </li>
    <li style="background-color:white">
        <a data-toggle="modal" data-target="#contactModal">
            <img src="/images/lien-he.png" width=36>
        </a>
    </li>



    <li style="background-color:white">
        <a href="tel:<?= $settings['home_hot_line'] ?>" target="_blank">
            <img src="/images/hot-line.png?v=1" width=36>
        </a>
    </li>

</ul>

<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="contactFormAjax" action="<?= route_to('home_register') ?>" method="post">
        <div class="modal-content">
            <div class="modal-header hidden">
                <span>Gửi yêu cầu</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0px">

                    <div class="form-group" style="margin-bottom: 0px">
                        <?= Html::input('text', 'full_name', '', [
                            'placeholder' => 'Họ tên',
                            'required' => true,
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="form-group" style="margin-bottom: 0px">
                                <?= Html::input('email', 'email', '', [
                                    'placeholder' => 'Địa chỉ email',
                                    'required' => false,
                                    'class' => 'form-control hidden'
                                ]) ?>

                    </div>
                    <div class="form-group" style="margin-bottom: 0px">
                        <?= Html::input('tel', 'phone', '', [
                            'placeholder' => 'Số điện thoại',
                            'required' => true,
                            'class' => 'form-control'
                        ]) ?>
                    </div>
                    <div class="form-group" style="margin-bottom: 0px">
                        <?= Html::textarea('request', '', [
                            'placeholder' => 'Yêu cầu',
                            'required' => true,
                            'class' => 'form-control',
                        ]) ?>
                    </div>
                    <?= Html::hiddenInput('ref_url', current_url()) ?>
               
            </div>
            <div class="g-recaptcha" data-sitekey="6Lc0hskUAAAAAMmUCydmMLuiApwcbMyQpygWkHei"></div>
            <div class="modal-footer" >
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button  class="btn btn-primary"  type="submit" >Gửi yêu cầu</button>
            </div>
        </div>
        </form>

    </div>
</div>

<div class="modal fade" id="contactConfirmModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span>Gửi yêu cầu</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <?= Html::label('Gửi yêu cầu thành công') ?>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>

    </div>
</div>
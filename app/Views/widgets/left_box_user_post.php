<?php

use App\Helpers\Html;

/**
 * @var \App\Models\ProjectCategoryModel[] $categories
 */
?>
<div class="panel panel-info">
    <div class="panel-heading">
        <div class="panel-title text-center">
            <span> Trang cá nhân </span>
        </div>
    </div>
    <div class="profile-usertitle">
        <div class="profile-usermenu profile-usermenu-padding">
            <div class="information_account">
                <?php if ($models) ?>
                     <div class="display-name"><span class="label-infor">Tài khoản</span> : <?= $models->username ?></div>
                <?php ?>
            </div>
        </div>
        <div class="profile-usermenu">
            <h4>Quản lý tin rao </h4>
            <ul class="nav nav-membership">
                <li>
                    <a rel="nofollow" href="/user-posts"><i class="fa fa-caret-right"></i> Đăng tin rao bán/cho thuê</a>
                </li>
                <li><a rel="nofollow" href="/user-posts-manage"><i class="fa fa-caret-right"></i> Quản lý tin rao
                        bán/cho thuê</a>
                </li>
            </ul>
        </div>
        <div class="profile-usermenu">
            <h4>Quản lý tài khoản</h4>
            <ul class="nav nav-membership">
                <li>
                    <a rel="nofollow" href="/change-user-information"><i class="fa fa-caret-right"></i> Thay đổi thông
                        tin cá
                        nhân</a>
                </li>
                <li>
                    <a rel="nofollow" href="/change-password"><i class="fa fa-caret-right"></i> Thay đổi mật khẩu</a>
                </li>
            </ul>
        </div>

        <input type="hidden" id="handuser" value="22415801622">
    </div>
    <div class="panel-footer">
        <div class="text-center full-left">
            <p><a href="/users-logout"><i class="fas fa-sign-in-alt"></i> Đăng xuất</a></p>
        </div>
    </div>

</div>

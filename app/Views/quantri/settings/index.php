<?php

use App\Helpers\SettingHelper;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\CategoryModel $model
 * @var \CodeIgniter\Validation\Validation $validator
 */
$this->title = 'Cấu hình chung';
?>
<div class="card">
    <div class="card-header card-header-info flex-align">
        <div>
            <h4 class="card-title"><?= $this->title ?></h4>
        </div>
        <a href="<?= route_to('admin_settings') ?>" data-method="get"
           data-prompt="Những thay đổi đều chưa được lưu. Bạn có muốn tiếp tục?" class="btn btn-round">Huỷ</a>
    </div>
    <div class="card-body">
        <form action="<?= route_to('admin_settings_update') ?>" method="post"
              enctype="multipart/form-data">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                       aria-controls="nav-home" aria-selected="true">Trang chủ</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                       aria-controls="nav-profile" aria-selected="false">Banner</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                       aria-controls="nav-contact" aria-selected="false">Video</a>
                    <a class="nav-item nav-link" id="nav-send-email-tab" data-toggle="tab" href="#nav-send-email"
                       role="tab" aria-controls="nav-send-email" aria-selected="false">Send Email</a>
                </div>
            </nav>
            <div class="row">

                <div class="col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="nav-tabContent">

                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                     aria-labelledby="nav-home-tab">
                                    <h6 class="card-subtitle mb-2 text-muted">Cấu hình trang chủ</h6>
                                    <a class="btn btn-primary" id="nav-generate-site-map" style="cursor: pointer" href="<?= route_to('get_all_link') ?>" role="tab" aria-selected="false">Generate sitemap</a>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Meta Title</label>
                                        <input type="text" name="home_meta_title" autocomplete="off"
                                               class="form-control" autofocus
                                               value="<?= $model['home_meta_title'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Meta Keywords</label>
                                        <input type="text" name="home_meta_keywords" autocomplete="off"
                                               class="form-control"
                                               value="<?= $model['home_meta_keywords'] ?>">
                                    </div>
                                    <div class="form-intro">
                                        <label class="bmd-label no-margin">Meta Description</label>
                                        <textarea name="home_meta_description" autocomplete="off" class="form-control "
                                                  rows="4"
                                                  id="home_meta_description"><?= $model['home_meta_description'] ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Id thông tin góc nhìn</label>
                                                <input type="text" name="home_corner_view_id" autocomplete="off"
                                                       class="form-control" autofocus
                                                       value="<?= $model['home_corner_view_id'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Id khối menu media</label>
                                                <input type="text" name="home_video_id" autocomplete="off"
                                                       class="form-control" autofocus
                                                       value="<?= $model['home_video_id'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Id khối bài viết media</label>
                                                <input type="text" name="home_video_block_id" autocomplete="off"
                                                       class="form-control" autofocus
                                                       value="<?= $model['home_video_block_id'] ?>">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Id vật liệu xây dựng</label>
                                                <input type="text" name="home_vat_lieu" autocomplete="off"
                                                       class="form-control" autofocus
                                                       value="<?= $model['home_vat_lieu'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Id bao bì</label>
                                                <input type="text" name="home_bao_bi" autocomplete="off"
                                                       class="form-control" autofocus
                                                       value="<?= $model['home_bao_bi'] ?>">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating"> Id khối bài viết hiển thị
                                                    trang chủ</label>
                                                <input type="text" name="home_posts_block_id" autocomplete="off"
                                                       class="form-control" autofocus
                                                       value="<?= $model['home_posts_block_id'] ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Gọi Ngay</label>
                                                <input type="text" name="home_goi_ngay" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_goi_ngay'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Hot Line</label>
                                                <input type="text" name="home_hot_line" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_hot_line'] ?>">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Zalo</label>
                                                <input type="text" name="home_zalo" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_zalo'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Link Facebook</label>
                                                <input type="text" name="home_link_facebook" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_link_facebook'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Link Pinterest</label>
                                                <input type="text" name="home_link_pinterest" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_link_pinterest'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Link Youtube</label>
                                                <input type="text" name="home_link_youtube" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_link_youtube'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Link Twitter</label>
                                                <input type="text" name="home_link_twitter" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_link_twitter'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Tên doanh nghiệp</label>
                                                <input type="text" name="home_ten_doanh_nghiep" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_ten_doanh_nghiep'] ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Mã Số Thuế</label>
                                                <input type="text" name="home_ma_so_thue" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_ma_so_thue'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Ngày Đăng Ký MST</label>
                                                <input type="text" name="home_ngay_dang_ky_mst" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_ngay_dang_ky_mst'] ?>">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Email</label>
                                                <input type="text" name="home_email" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_email'] ?>">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Địa chỉ</label>
                                                <input type="text" name="home_dia_chi" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_dia_chi'] ?>">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Link Map Địa Chỉ</label>
                                                <input type="text" name="home_link_map_dia_chi" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_link_map_dia_chi'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Chi Nhánh</label>
                                                <input type="text" name="home_chi_nhanh" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_chi_nhanh'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Link Map Chi Nhánh</label>
                                                <input type="text" name="home_link_map_chi_nhanh" autocomplete="off"
                                                       class="form-control"
                                                       value="<?= $model['home_link_map_chi_nhanh'] ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-intro">
                                                <label class="bmd-label no-margin">Embed Map Liên Hệ</label>
                                                <textarea name="home_embed_map_lien_he" autocomplete="off"
                                                          class="form-control " rows="4"
                                                          id="home_embed_map_lien_he"><?= $model['home_embed_map_lien_he'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Logo</label>
                                                        <div class="uploaded-image-wrap">
                                                            <div class="image-preview thumbnail">
                                                                <?= img(SettingHelper::getSettingImageLogo($model['home_logo_link'])) ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div>
                                                        <input type="file" name="home_logo_link" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Favicon</label>
                                                        <div class="uploaded-image-wrap">
                                                            <div class="image-preview thumbnail">
                                                                <?= img(SettingHelper::getSettingImageFavicon($model['home_favicon_link'] . '?v=' . rand(1000, 9999))) ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <input type="file" name="home_favicon_link"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                     aria-labelledby="nav-profile-tab">
                                    <!-- banner 1 -->
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Home Banner 1 (1200x150)</label>
                                        <div class="uploaded-image-wrap">
                                            <div class="image-preview thumbnail">
                                                <?= img(SettingHelper::getSettingImage($model['home_banner_1'])) ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <input type="file" name="home_banner_1" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Home Banner Link 1</label>
                                        <input type="text" name="home_banner_link_1" autocomplete="off"
                                               class="form-control"
                                               value="<?= $model['home_banner_link_1'] ?>">
                                    </div>


                                    <!-- banner 2 -->
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Home Banner 2 (832x315)</label>
                                        <div class="uploaded-image-wrap">
                                            <div class="image-preview thumbnail">
                                                <?= img(SettingHelper::getSettingImage($model['home_banner_2'])) ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <input type="file" name="home_banner_2" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="bmd-label-floating">Home Banner 3 (832x315)</label>
                                        <div class="uploaded-image-wrap">
                                            <div class="image-preview thumbnail">
                                                <?= img(SettingHelper::getSettingImage($model['home_banner_3'])) ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <input type="file" name="home_banner_3" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="bmd-label-floating">Contact Box Banner (360x380)</label>
                                        <div class="uploaded-image-wrap">
                                            <div class="image-preview thumbnail">
                                                <?= img(SettingHelper::getSettingImage($model['contact_box_banner'])) ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <input type="file" name="contact_box_banner" class="form-control">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                     aria-labelledby="nav-contact-tab">
                                    <!--video master -->
                                    <div class="form-intro">
                                        <label class="bmd-label no-margin">Master Video (Youtube Embed)</label>
                                        <textarea name="home_master_video" autocomplete="off" class="form-control "
                                                  rows="4"
                                                  id="home_master_video"><?= $model['home_master_video'] ?></textarea>
                                    </div>

                                    <!-- video 1 -->
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Home Video Thumbnail 1 (293x200)</label>
                                        <div class="uploaded-image-wrap">
                                            <div class="image-preview thumbnail">
                                                <?= img(SettingHelper::getSettingImage($model['home_video_thumb_1'])) ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <input type="file" name="home_video_thumb_1" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Home Video Link 1 (Youtube Source)</label>
                                        <input type="text" name="home_video_link_1" autocomplete="off"
                                               class="form-control"
                                               value="<?= $model['home_video_link_1'] ?>">
                                    </div>

                                    <!-- video 2 -->
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Home Video Thumbnail 2 (293x200)</label>
                                        <div class="uploaded-image-wrap">
                                            <div class="image-preview thumbnail">
                                                <?= img(SettingHelper::getSettingImage($model['home_video_thumb_2'])) ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <input type="file" name="home_video_thumb_2" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Home Video Link 2 (Youtube Source)</label>
                                        <input type="text" name="home_video_link_2" autocomplete="off"
                                               class="form-control"
                                               value="<?= $model['home_video_link_2'] ?>">
                                    </div>

                                    <!-- video 3 -->
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Home Video Thumbnail 3 (293x200)</label>
                                        <div class="uploaded-image-wrap">
                                            <div class="image-preview thumbnail">
                                                <?= img(SettingHelper::getSettingImage($model['home_video_thumb_3'])) ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <input type="file" name="home_video_thumb_3" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Home Video Link 3 (Youtube Source)</label>
                                        <input type="text" name="home_video_link_3" autocomplete="off"
                                               class="form-control"
                                               value="<?= $model['home_video_link_3'] ?>">
                                    </div>


                                </div>

                                <div class="tab-pane fade" id="nav-send-email" role="tabpanel"
                                     aria-labelledby="nav-send-email-tab">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">SMTP Host</label>
                                        <input type="text" name="send_email_smtp_host" autocomplete="off"
                                               class="form-control"
                                               value="<?= $model['send_email_smtp_host'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">SMTP Port</label>
                                        <input type="text" name="send_email_smtp_port" autocomplete="off"
                                               class="form-control"
                                               value="<?= $model['send_email_smtp_port'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label class="bmd-label-floating">SMTP Username</label>
                                        <input type="text" name="send_email_smtp_username" autocomplete="off"
                                               class="form-control"
                                               value="<?= $model['send_email_smtp_username'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label class="bmd-label-floating">SMTP Password</label>
                                        <input type="text" name="send_email_smtp_password" autocomplete="off"
                                               class="form-control"
                                               value="<?= $model['send_email_smtp_password'] ?>">
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Home meta (800x354)</label>
                                        <div class="uploaded-image-wrap">
                                            <div class="image-preview thumbnail">
                                                <?= img(SettingHelper::getSettingImage($model['home_meta_link'])) ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <input type="file" name="home_meta_link" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">home_meta_width</label>
                                        <input type="text" name="home_meta_width" autocomplete="off"
                                               class="form-control"
                                               value="<?= $model['home_meta_width'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">home_meta_height</label>
                                        <input type="text" name="home_meta_height" autocomplete="off"
                                               class="form-control"
                                               value="<?= $model['home_meta_height'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-intro">
                                        <h6 class="card-subtitle mb-2 text-muted">Header script </h6>
                                        <textarea name="main_header_script" autocomplete="off" class="form-control "
                                                  rows="4"
                                                  id="main_header_script"><?= $model['main_header_script'] ?></textarea>
                                    </div>
                                    <div class="form-intro">
                                        <h6 class="card-subtitle mb-2 text-muted">Body script </h6>
                                        <textarea name="main_body_script" autocomplete="off" class="form-control "
                                                  rows="4"
                                                  id="main_body_script"><?= $model['main_body_script'] ?></textarea>
                                    </div>
                                    <div class="form-intro">
                                        <h6 class="card-subtitle mb-2 text-muted">footer script </h6>
                                        <textarea name="main_footer_script" autocomplete="off" class="form-control "
                                                  rows="4"
                                                  id="main_footer_script"><?= $model['main_footer_script'] ?></textarea>
                                    </div>
                                    <div class="form-intro">
                                        <h6 class="card-subtitle mb-2 text-muted">meta copyright, author </h6>
                                        <textarea name="main_copyright_author" autocomplete="off" class="form-control "
                                                  rows="4"
                                                  id="main_copyright_author"><?= $model['main_copyright_author'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Cấu hình dự án</h6>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Meta Title</label>
                                        <input type="text" name="project_meta_title" autocomplete="off"
                                               class="form-control" autofocus
                                               value="<?= $model['project_meta_title'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Meta Keywords</label>
                                        <input type="text" name="project_meta_keywords" autocomplete="off"
                                               class="form-control"
                                               value="<?= $model['project_meta_keywords'] ?>">
                                    </div>
                                    <div class="form-intro">
                                        <label class="bmd-label no-margin">Meta Description</label>
                                        <textarea name="project_meta_description" autocomplete="off"
                                                  class="form-control " rows="4"
                                        ><?= $model['project_meta_description'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Kinh nghiệm hay</h6>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Meta Title</label>
                                        <input type="text" name="news_meta_title" autocomplete="off"
                                               class="form-control" autofocus
                                               value="<?= $model['news_meta_title'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Meta Keywords</label>
                                        <input type="text" name="news_meta_keywords" autocomplete="off"
                                               class="form-control"
                                               value="<?= $model['news_meta_keywords'] ?>">
                                    </div>
                                    <div class="form-intro">
                                        <label class="bmd-label no-margin">Meta Description</label>
                                        <textarea name="news_meta_description" autocomplete="off" class="form-control "
                                                  rows="4"
                                        ><?= $model['news_meta_description'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-subtitle mb-2 text-muted">Đăng tin miễn phí</h6>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Meta Title</label>
                                        <input type="text" name="post_meta_title" autocomplete="off"
                                               class="form-control" autofocus
                                               value="<?= $model['post_meta_title'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Meta Keywords</label>
                                        <input type="text" name="post_meta_keywords" autocomplete="off"
                                               class="form-control"
                                               value="<?= $model['post_meta_keywords'] ?>">
                                    </div>
                                    <div class="form-intro">
                                        <label class="bmd-label no-margin">Meta Description</label>
                                        <textarea name="post_meta_description" autocomplete="off" class="form-control "
                                                  rows="4"
                                        ><?= $model['post_meta_description'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-bottom-actions">
                <div class="flex-row" id="add-holder"></div>
                <button class="btn btn-info btn-round" type="submit">Cập nhật</button>
            </div>
        </form>
    </div>
</div>
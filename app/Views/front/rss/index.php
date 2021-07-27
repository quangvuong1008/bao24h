<?php

use App\Helpers\Html;
use App\Helpers\StringHelper;
use App\Helpers\Widgets\NewsKingNghiemHay;
use App\Models\SettingsModel;
use App\Helpers\SettingHelper;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\SliderModel[] $sliders
 * @var \App\Models\ProjectCategoryModel[] $projectCategories
 * @var \App\Models\CategoryModel[] $categories
 * @var \App\Models\TestimonialModel[] $testimonials
 * @var \App\Models\PartnerModel[] $partners
 * @var \App\Models\NewsModel[] $newsItems
 */
$this->title = $title;
$this->meta_image_url = $meta_image_url;
$home_posts_block_id = explode(',', $settings['home_posts_block_id']);
?>
<article>
    <section class="section page-rss mt20">
        <div class="container">
            <h2 class="title-page">RSS</h2>
            <strong class="sub-title-page">Khái niệm RSS</strong>
            <p>RSS ( viết tắt từ Really Simple Syndication ) là một tiêu chuẩn định dạng tài liệu dựa trên XML nhằm giúp người sử dụng dễ dàng cập nhật và tra cứu thông tin một cách nhanh chóng và thuận tiện nhất bằng cách tóm lược thông tin vào trong một đoạn dữ liệu ngắn gọn, hợp chuẩn.</p>
            <p>Dữ liệu này được các chương trình đọc tin chuyên biệt ( gọi là News reader) phân tích và hiển thị trên máy tính của người sử dụng. Trên trình đọc tin này, người sử dụng có thể thấy những tin chính mới nhất, tiêu đề, tóm tắt và cả đường link để xem toàn bộ tin.</p>
            <strong class="sub-title-page">Kênh do Bao24h cung cấp</strong>
            <div class="wrap-list-rss">
                <ul class="list-rss">
                    <li><a href="/rss/tin-moi-nhat.rss" title="Trang chủ">Trang chủ <span class="icon-rss">RSS<svg class="ic ic-rss">
                                    <use xlink:href="#Rss">
                                    </use>
                                </svg></span></a></li>
                </ul>
                <ul class="list-rss">
                    <li><a href="/rss/tin-moi-nhat.rss" title="Sức khỏe">Sức khỏe<span class="icon-rss">RSS<svg class="ic ic-rss">
                                    <use xlink:href="#Rss"></use>
                                </svg></span></a></li>
                </ul>
            </div>
            <strong class="sub-title-page">Điều khoản sử dụng</strong>
            <p>Các nguồn kênh tin được cung cấp miễn phí cho các cá nhân và các tổ chức phi lợi nhuận. Chúng tôi yêu cầu bạn cung cấp rõ các thông tin cần thiết khi bạn sử dụng các nguồn kênh tin này từ Bao24h.</p>
            <p>Bao24h có quyền yêu cầu bạn ngừng cung cấp và phân tán thông tin dưới dạng này ở bất kỳ thời điểm nào và với bất kỳ lý do nào.</p>
        </div>
    </section>
</article>
<div class="d-none">
    <svg id="Rss" viewBox="0 0 32 32">
        <path d="M10 26.001c0 1.4-0.8 2.7-2 3.5-1.2 0.7-2.8 0.7-4 0s-2-2-2-3.5c0-1.5 0.8-2.7 2-3.5 1.2-0.7 2.8-0.7 4 0s2 2 2 3.5z"></path>
        <path d="M30 30.001h-5.4c0-12.4-10.2-22.6-22.6-22.6v-5.4c15.4 0 28 12.6 28 28z"></path>
        <path d="M20.6 30.001h-5.2c0-7.4-6-13.4-13.4-13.4v-5.2c10.2 0 18.6 8.4 18.6 18.6z"></path>
    </svg>
</div>
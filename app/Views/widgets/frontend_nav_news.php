<?php

use App\Helpers\Html;

/**
 * @var \App\Libraries\BaseView $this
 * @var \App\Models\CategoryModel[] $items
 * @var \App\Models\ProjectCategoryModel[] $projects
 */
?>
<header>
    <div class=container>
        <div class=row>
            <div class="col-xs-12 col-md-4 header-left">
                <div class="logo edit_potion_logo">
                    <a href="/" title="Về trang chủ">
                        <img src=<?php echo base_url('/images/' . $settings['home_logo_link']) ?> alt="rao chung "
                        class=img-responsive>
                    </a>
                </div>
            </div>
            <div class="col-xs-8 col-md-8 header-right text-right">
                <div class="search-bar hidden-xs">
                    <form action="<?= route_to('home_search') ?>" method=get>
                        <div id=custom-search-input>
                            <div class=input-group>
                                <input type=text name=query class="form-control input-sm"
                                       placeholder="Nhập từ khóa để tìm kiếm...">
                                <span class=input-group-btn>
                                    <button class="btn btn-info btn-lg" type=submit>
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="div_nav_button_head hidden-xs">
                    <a href="tel:<?= $settings['home_goi_ngay'] ?>">
                        <img class="img-nav-btn-hotline" src="/images/hotline.png">
                        <?= $settings['home_goi_ngay'] ?>

                    </a>
                    <a href="tel:<?= $settings['home_hot_line'] ?> ">
                        <img class="img-nav-btn-tel" src="/images/tel.png">
                        <?= $settings['home_hot_line'] ?>
                    </a>
                    <a href="<?= $settings['home_link_facebook'] ?>">
                        <img class="img-nav-btn-tel" src="/images/icon-facebook.png">
                    </a>
                    <a href="<?= $settings['home_link_pinterest'] ?>">
                        <img class="img-nav-btn-tel" src="/images/icon-pinterest.png">
                    </a>
                    <a href="<?= $settings['home_link_youtube'] ?>">
                        <img class="img-nav-btn-tel" src="/images/icon-youtube.png">
                    </a>
                    <a href="<?= $settings['home_link_twitter'] ?>">
                        <img class="img-nav-btn-tel" src="/images/icon-twitter.png">
                    </a>
                </div>
                <div class="hotline-head hidden" id="cart-badge">
                    <a href="<?= base_url('cart') ?>" class=ico-head>
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                        <span>0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-navbar visible-xs">
    <a href="/"><h3>Trang chủ</h3></a>
    <?php if ($items && !empty($items)) {
        foreach ($items as $item) {
            echo Html::a(Html::tag('h3', $item->title), $item->getUrl());
        }
    } ?>

    <?php if ($product_category && !empty($product_category)) {
        foreach ($product_category as $product_cate) {
            echo Html::a(Html::tag('h3', $product_cate->title), $product_cate->getUrl());
        }
    } ?>
    <!--    --><? //= Html::a(Html::tag('h3', 'Mẫu nhà đẹp'), base_url('mau-nha-dep')) ?>
    <!--    --><? //= Html::a(Html::tag('h3', 'Báo giá'), base_url('bao-gia')) ?>
    <?= Html::a(Html::tag('h3', 'Kinh nghiệm hay'), route_to('news')) ?>
    <?= Html::a(Html::tag('h3', 'Liên hệ'), base_url('lien-he')) ?>
    <?= Html::a(Html::tag('h3', 'Đăng tin miễn phí'), base_url('/user-posts-manage')) ?>
</div>
<div id="menu-sticky-wrapper" class="sticky-wrapper" style="height: 33px;">
    <div class="navbar" id="menu" style="">
        <div class="navbar_wrapper w1040">
            <a href="/" class="iconhome">
                <img src="/web_images/home.svg" alt="Báo tin tức">
            </a>
            <ul class="list-navbar">
                <li class="nav-item">
                    <a href="/thoi-su-472ct0.htm" title="Thời sự" id="menu_472">Thời sự</a>
                    <ul class="droplist-info">
                        <li>
                            <a title="Chính trị" href="/chinh-tri-321ct472.htm">
                                    <span class="txt">Chính trị
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Góc nhìn" href="/chinh-sach-moi-603ct472.htm">
                                    <span class="txt">Chính sách mới
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Chính phủ với người dân" href="/chinh-phu-voi-nguoi-dan-589ct472.htm">
                                    <span class="txt">Chính phủ với người dân
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Phản hồi" href="/phan-hoi-phan-bien-473ct472.htm">
                                    <span class="txt">Phản hồi - Phản biện
                                    </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/the-gioi-130ct0.htm" title="THẾ GIỚI" id="menu_130">THẾ GIỚI</a>
                    <ul class="droplist-info">
                        <li>
                            <a title="Phân tích-Nhận định" href="/phan-tich-nhan-dinh-525ct130.htm">
                                    <span class="txt">Phân tích-Nhận định
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Chuyện lạ thế giới" href="/chuyen-la-the-gioi-162ct130.htm">
                                    <span class="txt">Chuyện lạ thế giới
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Người Việt 4 phương" href="/nguoi-viet-4-phuong-478ct130.htm">
                                    <span class="txt">Người Việt 4 phương
                                    </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/kinh-te-128ct0.htm" title="KINH TẾ" id="menu_128">KINH TẾ</a>
                    <ul class="droplist-info">
                        <li>
                            <a title="Thị trường - Tài chính" href="/thi-truong-tai-chinh-587ct128.htm">
                                    <span class="txt">Thị trường - Tài chính
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Doanh nghiệp - Doanh nhân" href="/doanh-nghiep-doanh-nhan-145ct128.htm">
                                    <span class="txt">Doanh nghiệp - Doanh nhân
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Bất động sản" href="/bat-dong-san-144ct128.htm">
                                    <span class="txt">Bất động sản
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Tài chính – Ngân hàng" href="/tai-chinh-ngan-hang-606ct128.htm">
                                    <span class="txt">Tài chính – Ngân hàng
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Người tiêu dùng" href="/nguoi-tieu-dung-147ct128.htm">
                                    <span class="txt">Người tiêu dùng
                                    </span>
                            </a>
                        </li>
                    </ul>

                </li>
                <li class="nav-item">
                    <a href="/xa-hoi-129ct0.htm" title="XÃ HỘI" id="menu_129">XÃ HỘI</a>
                    <ul class="droplist-info">
                        <li>
                            <a title="Vấn đề quan tâm" href="/van-de-quan-tam-149ct129.htm">
                                    <span class="txt">Vấn đề quan tâm
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Phóng sự điều tra" href="/phong-su-dieu-tra-581ct129.htm">
                                    <span class="txt">Phóng sự- điều tra
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Người tốt - Việc tốt" href="/nguoi-tot-viec-tot-588ct129.htm">
                                    <span class="txt">Người tốt - Việc tốt
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Mạng xã hội" href="/mang-xa-hoi-604ct129.htm">
                                    <span class="txt">Mạng xã hội
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Chính sách BHXH-BHYT" href="/chinh-sach-bhxh-bhyt-591ct128.htm">
                                    <span class="txt">Chính sách BHXH-BHYT
                                    </span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/phap-luat-475ct0.htm" title="PHÁP LUẬT" id="menu_475">PHÁP LUẬT</a>
                    <ul class="droplist-info">
                        <li>
                            <a title="Văn bản mới" href="/van-ban-moi-577ct475.htm">
                                    <span class="txt">Văn bản mới
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="An ninh trật tự" href="/an-ninh-trat-tu-579ct475.htm">
                                    <span class="txt">An ninh trật tự
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Chống buôn lậu, hàng giả" href="/chong-buon-lau-hang-gia-590ct475.htm">
                                    <span class="txt">Chống buôn lậu - hàng giả
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Đơn thư bạn đọc" href="/hoi-dap-607ct475.htm">
                                    <span class="txt">Đơn thư bạn đọc
                                    </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/van-hoa-158ct0.htm" title="VĂN HÓA" id="menu_158">VĂN HÓA</a>
                    <ul class="droplist-info">
                        <li>
                            <a title="Đời sống văn hoá" href="/doi-song-van-hoa-272ct158.htm">
                                    <span class="txt">Đời sống văn hoá
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Giải trí" href="/giai-tri-sao-274ct158.htm">
                                    <span class="txt">Giải trí - Sao
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Du lịch" href="/du-lich-132ct158.htm">
                                    <span class="txt">Du lịch
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Sáng tác" href="/sang-tac-487ct158.htm">
                                    <span class="txt">Sáng tác
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Ẩm thực" href="/am-thuc-576ct158.htm">
                                    <span class="txt">Ẩm thực
                                    </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/giao-duc-135ct0.htm" title="GIÁO DỤC" id="menu_135">GIÁO DỤC</a>
                    <ul class="droplist-info">
                        <li>
                            <a title="Tuyển sinh" href="/tuyen-sinh-325ct135.htm">
                                    <span class="txt">Tuyển sinh
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Du học" href="/du-hoc-480ct135.htm">
                                    <span class="txt">Du học
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Tư vấn" href="/tu-van-605ct135.htm">
                                    <span class="txt">Tư vấn
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Bàn tròn giáo dục" href="/ban-tron-giao-duc-311ct135.htm">
                                    <span class="txt">Bàn tròn giáo dục
                                    </span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/the-thao-273ct0.htm" title="THỂ THAO" id="menu_273">THỂ THAO</a>
                    <ul class="droplist-info">
                        <li>
                            <a title="Du lịch" href="/bong-da-547ct273.htm">
                                    <span class="txt">Bóng đá
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Tennis" href="/tennis-549ct273.htm">
                                    <span class="txt">Tennis
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Thể thao 24h" href="/the-thao-24h-548ct273.htm">
                                    <span class="txt">Thể thao 24h
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Chuyện thể thao" href="/chuyen-the-thao-582ct273.htm">
                                    <span class="txt">Chuyện thể thao
                                    </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/ho-so-133ct0.htm" title="HỒ SƠ" id="menu_133">HỒ SƠ</a>
                    <ul class="droplist-info">
                        <li>
                            <a title="Giải mật" href="/giai-mat-541ct133.htm">
                                    <span class="txt">Giải mật
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Thế giới bí ẩn" href="/the-gioi-bi-an-561ct133.htm">
                                    <span class="txt">Thế giới bí ẩn
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Nhân vật - Sự kiện" href="/dau-an-su-kien-562ct133.htm">
                                    <span class="txt">Nhân vật - Sự kiện
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Vụ án nổi tiếng" href="/vu-an-noi-tieng-563ct133.htm">
                                    <span class="txt">Vụ án nổi tiếng
                                    </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/quan-su-514ct0.htm" title="QUÂN SỰ" id="menu_514">QUÂN SỰ</a>
                    <ul class="droplist-info">
                        <li>
                            <a title="Hồ sơ quân sự" href="/ho-so-quan-su-556ct514.htm">
                                    <span class="txt">Hồ sơ quân sự
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Tập trận - Diễn tập" href="/tap-tran-dien-tap-592ct514.htm">
                                    <span class="txt">Tập trận - Diễn tập
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Quốc phòng" href="/quoc-phong-593ct514.htm">
                                    <span class="txt">Quốc phòng
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Vũ khí khí tài" href="/vu-khi-khi-tai-557ct514.htm">
                                    <span class="txt">Vũ khí khí tài
                                    </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/khoa-hoc-cong-nghe-131ct0.htm" title="KHOA HỌC - CÔNG NGHỆ" id="menu_131">KHOA HỌC - CÔNG NGHỆ</a>
                    <ul class="droplist-info">
                        <li>
                            <a title="Ô tô xe máy" href="/o-to-xe-may-491ct131.htm">
                                    <span class="txt">Ô tô xe máy
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Điện tử - Viễn thông" href="/dien-tu-vien-thong-492ct131.htm">
                                    <span class="txt">Điện tử - Viễn thông
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Khoa học đời sống" href="/khoa-hoc-doi-song-515ct131.htm">
                                    <span class="txt">Khoa học đời sống
                                    </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/bien-dao-viet-nam-537ct0.htm" title="BIỂN ĐẢO" id="menu_538">BIỂN ĐẢO</a>
                    <ul class="droplist-info">
                        <li>
                            <a title="Bảo vệ chủ quyền" href="/bao-ve-chu-quyen-538ct537.htm">
                                    <span class="txt">Bảo vệ chủ quyền
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Kinh tế biển đảo" href="/kinh-te-bien-dao-574ct537.htm">
                                    <span class="txt">Kinh tế biển đảo
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Hỏi đáp Luật Cảnh sát biển" href="/hoi-dap-luat-canh-sat-bien-596ct537.htm">
                                    <span class="txt">Hỏi đáp Luật Cảnh sát biển
                                    </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/suc-khoe-564ct0.htm" title="Y tế" id="menu_564">Y tế</a>
                    <ul class="droplist-info">
                        <li>
                            <a title="Chính sách" href="/chinh-sach-609ct564.htm">
                                    <span class="txt">Chính sách
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Dịch bệnh" href="/dich-benh-610ct564.htm">
                                    <span class="txt">Dịch bệnh
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Bệnh viện – Bác sĩ" href="/benh-vien-bac-si-611ct564.htm">
                                    <span class="txt">Bệnh viện – Bác sĩ
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Giới tính" href="/gioi-tinh-566ct564.htm">
                                    <span class="txt">Giới tính
                                    </span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/dia-phuong-529ct0.htm" title="Địa phương" id="menu_529">Địa phương</a>
                    <ul class="droplist-info">
                        <li>
                            <a title="Hà Nội" href="/ha-noi-612ct529.htm">
                                    <span class="txt">Hà Nội
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="TP Hồ Chí Minh" href="/tp-ho-chi-minh-613ct529.htm">
                                    <span class="txt">TP Hồ Chí Minh
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Đà Nẵng" href="/da-nang-614ct529.htm">
                                    <span class="txt">Đà Nẵng
                                    </span>
                            </a>
                        </li>
                        <li>
                            <a title="Đà Nẵng" href="/tay-bac-tay-nguyen-tay-nam-bo-550ct529.htm">
                                    <span class="txt">Tây Bắc - Tây Nguyên - Tây Nam bộ
                                    </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/video.htm" title="VIDEO" id="menu_482">VIDEO</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="show-more-mn" rel="nofollow">
                        <svg id="baseline-more_vert-24px" xmlns="http://www.w3.org/2000/svg" width="16.661" height="16.661" viewBox="0 0 16.661 16.661">
                            <path id="Path_2016" data-name="Path 2016" d="M0,0H16.661V16.661H0Z" fill="none"></path>
                            <path id="Path_2017" data-name="Path 2017" d="M11.388,6.777A1.388,1.388,0,1,0,10,5.388,1.392,1.392,0,0,0,11.388,6.777Zm0,1.388a1.388,1.388,0,1,0,1.388,1.388A1.392,1.392,0,0,0,11.388,8.165Zm0,4.165a1.388,1.388,0,1,0,1.388,1.388A1.392,1.392,0,0,0,11.388,12.33Z" transform="translate(-3.058 -1.223)" fill="#363636"></path>
                        </svg>
                    </a>
                    <ul class="menu_list">
                        <li><a href="/goc-nhin-497ct0.htm" title="Góc nhìn">Góc nhìn</a></li>
                        <li><a href="/anh.htm" title="ẢNH">ẢNH</a></li>
                        <li><a href="/infographics.htm" title="INFOGRAPHICS">INFOGRAPHICS</a></li>
                        <li><a href="/emagazine.htm" title="MEGASTORY">MEGASTORY</a></li>
                        <li><a href="/ban-doc-583ct0.htm" title="Bạn đọc">BẠN ĐỌC</a></li>
                        <li><a href="/giai-ma-muon-mat-597ct0.htm" title="Giải mã muôn mặt">Giải mã muôn mặt</a></li>
                        <li><a href="/anh-360-617ct0.htm" title="Ảnh 360">Ảnh 360</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div></div>
<?php

use App\Helpers\Assets\AppAsset;
use App\Helpers\Widgets\FrontendNav;
use App\Helpers\Widgets\FrontFooter;

$view = \App\Libraries\BaseServices::renderer();

/**
 * @var \App\Libraries\BaseView $this
 * @var string $content
 */
AppAsset::register($view);

header('location:/');
die;
?>
<!DOCTYPE html>
<html lang=vi>
<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Kiên kết không tồn tại</title>
    <?php $view->head() ?>
</head>
<body>
<?= FrontendNav::register($view); ?>
<section>
    <div class="empty-block">
        <img src="/images/no-content.jpg" alt="No content"/>
        <h4>Liên kết không tồn tại</h4>
        <p>Rất tiết, liên kết bạn đang truy cập không tồn tại. Hãy về trang chủ hoặc sử dụng ô tìm kiếm.</p>
        <a href="<?= base_url('/') ?>" class="btn btn-info">Về trang chủ</a>
    </div>
</section>

<?= FrontFooter::register($view) ?>
</body>
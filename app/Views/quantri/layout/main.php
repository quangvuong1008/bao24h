<?php

use App\Helpers\Assets\AdminAsset;
use App\Helpers\Widgets\AdminAppBar;
use App\Helpers\Widgets\AdminNav;
use App\Helpers\SessionHelper;

/**
 * @var $this \App\Libraries\BaseView
 * @var string $title
 * @var string $content
 * @var \CodeIgniter\HTTP\Request $request
 */
AdminAsset::register($this);
?>
<!doctype html>
<html>
<head>
    <title><?= ($this->title ?: 'Trang chủ') . ' - Bộ quản trị nội dung Website - Panda CMS' ?></title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <?= csrf_field(csrf_header()) . "\n" ?>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <?php $this->head() ?>
</head>
<body>

<div class="wrapper ">
    <?= AdminNav::register($this, ['request' => $request]) ?>

    <div class="main-panel">

        <?= AdminAppBar::register($this) ?>

        <div class="content">
            <?= $content ?>
        </div>

    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="main-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">#content</div>
    </div>
</div>

<?php
if (SessionHelper::getInstance()->hasFlash('ALERT')) {
    $this->registerJsFile('notification/alert');
}
$this->registerAssets();
?>
</body>
</html>

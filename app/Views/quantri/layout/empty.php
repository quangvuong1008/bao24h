<?php

use App\Helpers\Assets\AdminAsset;
use App\Helpers\Assets\MaterialDashboard;
use App\Helpers\SessionHelper;

/**
 * @var $this \App\Libraries\BaseView
 * @var string $title
 * @var string $content
 */
AdminAsset::register($this);
$asset = MaterialDashboard::getAsset();
?>
<!doctype html>
<html>
<head>
    <title><?= $this->title ?></title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <?= csrf_field(csrf_header()) . "\n" ?>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <?php $this->head() ?>
</head>
<body class="off-canvas-sidebar">
<div class="wrapper wrapper-full-page">
    <div class="page-header page-cover" filter-color="black"
         style="background-image: url('<?= $asset->createUrl('img/cover.jpg') ?>');">
        <div class="container">
            <?= $content ?>
        </div>
    </div>
</div>
</body>

<?php
if (SessionHelper::getInstance()->hasFlash('ALERT')) {
    $this->registerJsFile('notification/alert');
}
$this->registerAssets();
?>
</body>
</html>

<?php

use App\Helpers\Assets\AppAsset;
use App\Helpers\Widgets\FrontendNav;
use App\Helpers\SessionHelper;
use App\Helpers\Html;
use App\Helpers\Widgets\FrontFooter;
use App\Helpers\Widgets\MetaTags;
use App\Models\SettingsModel;

/**
 * @var \App\Libraries\BaseView $this
 * @var string $content
 */
AppAsset::register($this);
MetaTags::register($this,[],$meta_info , $meta_posts);

$alert = SessionHelper::getInstance()->getFlash('GLOBAL');
$settings =  new SettingsModel();
$settings = $settings->findAll();
$setting_array = [];
if($settings){
    foreach ($settings as $setting){
        $setting_array[$setting->key] = $setting->value;
    }
}
?>
<!DOCTYPE html>
<html lang=vi>
<head>
    <meta charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title><?= $this->title ?></title>
    <meta property="og:image" itemprop="thumbnailUrl" content="<?php echo $this->meta_image_url ?>">
    <meta property="og:image:width" content="<?php echo $setting_array['home_meta_width']; ?>"/>
    <meta property="og:image:height" content="<?php echo $setting_array['home_meta_height']; ?>"/>
    <?php $this->head(); ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
    <?php echo $setting_array['main_header_script']; ?>

</head>
<body>
<?php echo $setting_array['main_body_script']; ?>
<?= FrontendNav::register($this); ?>
<?php
if ($alert && !empty($alert) && isset($alert['type']) && isset($alert['message'])) {
    echo Html::tag('div', $alert['message'], [
            'class' => ['alert', 'alert-' . strtolower($alert['type']), 'text-center']
        ]) . "\n";
}
?>
<section>
    <?= $content ?>
</section>

<?= FrontFooter::register($this) ?>

<?php $this->registerAssets() ?>
</body>
<?php echo $setting_array['main_footer_script'] ?>
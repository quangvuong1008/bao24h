<?php

use App\Helpers\Html;

/**
 * @var \App\Helpers\Assets\BaseAsset $asset
 * @var array $items
 * @var \CodeIgniter\HTTP\Request $request
 */
?>
<div class="sidebar" data-color="azure" data-background-color="black"
     data-image="<?= $asset->createUrl('img/sidebar-1.jpg') ?>">
    <div class="logo">
        <span class="simple-text logo-normal"><?= ADMIN_NAME ?></span>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <?php foreach ($items as $route => $props): ?>
                <?= Html::beginTag('li', ['class' => [
                    'nav-item',
                    $request->uri->getSegment(2) == $props['ns'] ? 'active' : null
                ]]) ?>
                <a class="nav-link" href="<?= route_to($route) ?>">
                    <i class="material-icons"><?= $props['icon'] ?></i>
                    <p><?= $props['label'] ?></p>
                </a>
                <?= Html::endTag('li') ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
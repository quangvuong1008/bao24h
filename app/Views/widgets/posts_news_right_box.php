<?php

use App\Helpers\Html;

/**
 * @var \App\Models\ProjectCategoryModel[] $categories
 */
?>
<aside class="panel panel-inverse hidden-xs">
    <div class="panel-heading text-center"><h3>Tin mới nhất</h3><hr class="underline-title"></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="lcb-left">
                    <?php if ($models): ?>

                        <ul class="list-newsest hidden-xs">
                            <?php foreach ($models as $md): ?>
                                <li class="item fix-items">
                                    <a href="<?= $md->getUrl() ?>"
                                       title="<?= $md->title ?>" class="thumb fix-thumb-posts">
                                        <img src="<?= $md->getImage() ?>"
                                             alt="<?= $md->title ?>" style="height: 110px;" >
                                    </a>
                                    <div class="item-info">
                                        <a href="<?= $md->getUrl() ?>"
                                           title="<?= $md->title ?>" class="title">
                                            <span><?= $md->title ?></span>
                                        </a>
                                        <div class="fix-cut-title">
                                            <p><?=$md->meta_title?></p>
                                        </div>

                                    </div>

                                </li>
                            <?php endforeach; ?>

                        </ul>
                        <ul class="list-newsest visible-xs">
                            <?php foreach ($models as $md): ?>
                                <li class="item">
                                    <a href="<?= $md->getUrl() ?>"
                                       title="<?= $md->title ?>" class="thumb">
                                        <img src="<?= $md->getImage() ?>"
                                             alt="<?= $md->title ?>" >
                                    </a>
                                    <div class="item-info">
                                        <a href="<?= $md->getUrl() ?>"
                                           title="<?= $md->title ?>" class="title">
                                            <span><?= $md->title ?></span>
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</aside>


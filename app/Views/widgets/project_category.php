<?php

use App\Helpers\Html;

/**
 * @var \App\Models\ProjectCategoryModel[] $categories
 */
?>
<aside class="panel panel-inverse hidden-xs">
    <div class="panel-heading"><h3>MẪU NHÀ ĐẸP</h3></div>
    <div class="panel-body">
        <div class="list-group">
            <?php foreach ($categories as $category) {
                echo Html::a($category->title, $category->getUrl(), [
                        'class' => 'list-group-item']) . "\n";
            } ?>
        </div>
    </div>
</aside>

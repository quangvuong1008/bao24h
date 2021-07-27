<?php

use App\Helpers\Html;
use App\Helpers\ArrayHelper;

/**
 * @var array $links
 */
?>
<ol class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
    <li><a href="/" title="Trang Chủ">Trang Chủ</a></li>
    <?php
    $array_breadcrumb = [];
    foreach ($links as $n => $item):
        if($n == 0) {
            $array_breadcrumb['itemscope'] = '';
            $array_breadcrumb['itemtype'] = 'http://schema.org/Thing';
            $array_breadcrumb['itemprop'] = 'item';
        }
        ?>

        <li <?php if($n ==0): ?>  itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" <?php endif; ?> >
            <?= is_array($item) && ($label = ArrayHelper::getValue($item, 'label')) !== null &&
            ($url = ArrayHelper::getValue($item, 'url')) !== null ?
                Html::a( $n ==0 ? '<span itemprop="name" >'.$label.'</span>': $label
                    , $url,$array_breadcrumb) : ArrayHelper::getValue($item, 'label', (string)$item) ?>
            <?php if($n==0): ?> <meta itemprop="position" content="1" /> <?php endif; ?>
        </li>
    <?php endforeach; ?>
    <?php
    if($add_data){
        $label = ArrayHelper::getValue($add_data, 'label');
        $url = ArrayHelper::getValue($add_data, 'url');
        ?>
        <li >
            <a href="<?php echo $url; ?>"   itemscope=""
               itemtype="http://schema.org/Thing"  itemprop="item"
            >
                <?php echo $label; ?>
            </a>
        </li>
        <?php
    }
    ?>
</ol>
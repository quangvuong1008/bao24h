<?php

namespace App\Helpers\Assets;


class BootstrapAsset extends BaseAsset
{
    public $vendor = 'twbs/bootstrap/dist';

    public $js = [
        'js/bootstrap.bundle.min.js'
    ];

    public $css = [
        'css/bootstrap.min.css',
    ];

    public $depends = [
        JqueryAsset::class
    ];
}
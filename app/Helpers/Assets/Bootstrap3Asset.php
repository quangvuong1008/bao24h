<?php

namespace App\Helpers\Assets;


class Bootstrap3Asset extends BaseAsset
{
    public $vendor = 'node_modules/bootstrap/dist';

    public $js = [
        'js/bootstrap.min.js'
    ];

    public $css = [
        'css/bootstrap.min.css'
    ];

    public $depends = [
        JqueryAsset::class
    ];
}
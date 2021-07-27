<?php

namespace App\Helpers\Assets;


class JqueryToastAsset extends BaseAsset
{
    public $vendor = 'node_modules/jquery-toast-plugin/dist';

    public $js = [
        'jquery.toast.min.js'
    ];

    public $css = [
        'jquery.toast.min.css'
    ];

    public $depends = [
        JqueryAsset::class
    ];
}
<?php

namespace App\Helpers\Assets;

class LightSliderAsset extends BaseAsset
{
    public $vendor = 'node_modules/lightslider/dist';

    public $css = [
        'css/lightslider.min.css'
    ];

    public $js = [
        'js/lightslider.min.js',
    ];

    public $depends = [
        JqueryAsset::class
    ];
}
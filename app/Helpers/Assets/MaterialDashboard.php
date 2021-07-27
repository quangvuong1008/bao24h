<?php

namespace App\Helpers\Assets;


class MaterialDashboard extends BaseAsset
{
    public $vendor = 'node_modules/material-dashboard/assets';

    public $css = [
        'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons',
        'css/material-dashboard.min.css'
    ];

    public $js = [
        'js/core/popper.min.js',
        'js/plugins/bootstrap-notify.js',
        'js/plugins/perfect-scrollbar.jquery.min.js',
        'js/core/bootstrap-material-design.min.js',
        'js/material-dashboard.min.js',
    ];

    public $depends = [
        BootstrapAsset::class
    ];
}
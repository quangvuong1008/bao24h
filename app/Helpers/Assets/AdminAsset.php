<?php

namespace App\Helpers\Assets;


class AdminAsset extends BaseAsset
{
    public $js = [
        ['https://unpkg.com/react@16/umd/react.development.js', 'crossorigin'],
        ['https://unpkg.com/react-dom@16/umd/react-dom.development.js', 'crossorigin'],
        'admin/js/jquery.form.min.js',
        'admin/js/main.js?0.1.3',
        'admin/js/admin_content.js?v=0.0.3'
    ];

    public $css = [
        'admin/css/main.css?v=0.1.3'
    ];

    public $depends = [
        MaterialDashboard::class,
        FroalaEditor::class
    ];
}
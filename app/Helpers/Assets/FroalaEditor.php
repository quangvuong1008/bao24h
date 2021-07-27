<?php

namespace App\Helpers\Assets;


class FroalaEditor extends BaseAsset
{
    public $vendor = 'froala/wysiwyg-editor';

    public $css = [
        'css/froala_editor.pkgd.min.css'
    ];

    public $js = [
        'js/froala_editor.pkgd.min.js',
        'js/plugins/image.min.js',
        'js/languages/vi.js'
    ];

    public $depends = [
        JqueryAsset::class
    ];
}
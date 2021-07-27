<?php

namespace App\Helpers\Widgets;

use App\Libraries\BaseView;

abstract class BaseWidget
{
    /**
     * @param BaseView $view Use when want to register assets
     * @param string $file
     * @param array $data
     * @param array $options
     * @return string
     */
    protected static function render(BaseView $view, string $file, array $data = [], array $options = [])
    {
        return $view->renderView("widgets/{$file}", $data, $options);
    }

    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    abstract public static function register(BaseView $view, array $data = []);
}
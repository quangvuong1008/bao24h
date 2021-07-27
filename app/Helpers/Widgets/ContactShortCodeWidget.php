<?php

namespace App\Helpers\Widgets;


use App\Libraries\BaseView;

class ContactShortCodeWidget extends BaseWidget
{
    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    public static function register(BaseView $view, array $data = [])
    {
        return static::render($view, 'contact_short_code', $data);
    }
}
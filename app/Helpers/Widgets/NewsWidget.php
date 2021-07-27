<?php

namespace App\Helpers\Widgets;


use App\Libraries\BaseView;
use App\Models\NewsModel;
use App\Models\SettingsModel;

class NewsWidget extends BaseWidget
{

    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    public static function register(BaseView $view, array $data = [])
    {

        $models = (new NewsModel())
            ->where('is_lock', 0)
            ->orderBy('updated_at', 'DESC')
            ->findAll(4);

        $setting_model  =(new SettingsModel());
        $home_banner_3 = $setting_model->get_setting('home_banner_3');
        if (!$models || empty($models)) return null;

        return static::render($view, 'news', [
            'models' => $models,
            'home_banner_3' =>  $home_banner_3->value
        ]);
    }
}
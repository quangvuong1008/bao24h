<?php

namespace App\Helpers\Widgets;


use App\Libraries\BaseView;
use App\Models\NewsModel;

class NewsRightBoxWidget extends BaseWidget
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
            ->findAll(5);

        if (!$models || empty($models)) return null;

        return static::render($view, 'right_box_news', [
            'models' => $models
        ]);
    }
}
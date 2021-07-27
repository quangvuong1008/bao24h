<?php

namespace App\Helpers\Widgets;


use App\Libraries\BaseView;
use App\Models\NewsModel;
use App\Models\PostsModel;
use App\Models\SettingsModel;

class PostNewRightBoxWidget extends BaseWidget
{

    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    public static function register(BaseView $view, array $data = [])
    {
        $model = (new PostsModel())
            ->where('is_lock', 0)
            ->orderBy('updated_at', 'DESC')
            ->findAll(10);

        return static::render($view, 'posts_news_right_box', [
            'models' => $model
        ]);
    }
}
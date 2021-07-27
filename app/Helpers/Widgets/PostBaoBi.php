<?php

namespace App\Helpers\Widgets;


use App\Libraries\BaseView;
use App\Models\CategoryModel;
use App\Models\NewsModel;
use App\Models\PostsModel;
use App\Models\SettingsModel;

class PostBaoBi extends BaseWidget
{

    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    public static function register(BaseView $view, array $data = [])
    {

        $settings =  new SettingsModel();
        $settings = $settings->findAll();
        $setting_array = [];
        if($settings){
            foreach ($settings as $setting){
                $setting_array[$setting->key] = $setting->value;
            }
        }
        $prd_cate_discount_id = $setting_array['home_bao_bi'];
        $model = (new CategoryModel())->find($prd_cate_discount_id);

        $all_child_cate_id =  (new CategoryModel())
            ->getCategoryIdRecursive($prd_cate_discount_id,0,3);

        $posts = (new PostsModel())
            ->whereIn('category_id', $all_child_cate_id)
            ->where('is_lock', 0)
            ->orderBy('updated_at', 'DESC')->findAll(5);
        $model->posts = $posts;

        return static::render($view, 'posts_bao_bi', [
            'models' => $posts
        ]);
    }
}
<?php

namespace App\Helpers\Widgets;

use App\Libraries\BaseView;
use App\Models\CategoryModel;
use App\Models\PostsModel;
use App\Models\ProductCategoryModel;
use App\Models\ProjectCategoryModel;
use App\Models\SettingsModel;

class FrontendNav extends BaseWidget
{
    private static $items;

    private static $projects;

    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    public static function register(BaseView $view, array $data = [])
    {
        $items = (new CategoryModel())
            ->addQuery('where', ['is_lock', 0])
            ->addQuery('orderBy', ['menu_order', 'asc'])
            ->addQuery('whereNotIn',['title',['Sự kiện']])
            ->addQuery('whereNotIn',['title',['Video']])
            ->getCategoryRecursive_menu(0, 0, 3);
        $product_category = (new ProductCategoryModel())
            ->addQuery('where', ['is_lock', 0])
            ->addQuery('orderBy', ['menu_order', 'asc'])
            ->getCategoryRecursive_menu(0, 0, 3);

        $projects = static::$projects ?: (static::$projects =
            (new ProjectCategoryModel())
                ->addQuery('where', ['is_lock', 0])
                ->getCategoryRecursive(0, 0, 1));

        $settings = new SettingsModel();
        $settings = $settings->findAll();
        $setting_array = [];
        if ($settings) {
            foreach ($settings as $setting) {
                $setting_array[$setting->key] = $setting->value;
            }
        }
        $category = (new PostsModel())
            ->where('is_lock', '0')
            ->orderBy('created_at', 'DESC')
            ->findAll(5);


        return static::render($view, 'frontend_nav', [
            'items' => $items,
            'projects' => $projects,
            'settings' => $setting_array,
            'product_category' => $product_category,
            'category' => $category
        ]);
    }
}
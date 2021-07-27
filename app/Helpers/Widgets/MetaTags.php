<?php

namespace App\Helpers\Widgets;


use App\Helpers\Html;
use App\Libraries\BaseView;
use App\Models\PostsModel;
use App\Models\RouterUrlModel;
use App\Models\SettingsModel;
use Config\Services;

class MetaTags extends BaseWidget
{

    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    public static function register(BaseView $view, array $data = [],$meta_posts = null, $modify_meta = null )
    {
        $request = Services::request();
        $slug = $request->uri->getSegment(1);

        $settings = new SettingsModel();
        $settings = $settings->findAll();
        $setting_array = [];
        if ($settings) {
            foreach ($settings as $setting) {
                $setting_array[$setting->key] = $setting->value;
            }
        }

        if ($meta_posts){
            $view->registerMetaTags('title', $meta_posts['meta_title']);
            $view->registerMetaTags('keywords', $meta_posts['meta_keywords']);
            $view->registerMetaTags('description', $meta_posts['meta_description']);
            return;
        }

        if ($modify_meta) {
            $view->registerMetaTags('title', $modify_meta['title']);
            $view->registerMetaTags('keywords', $modify_meta['keywords']);
            $view->registerMetaTags('description', $modify_meta['description']);
            return;
        }



        if ($slug && $slug !== ADMIN_PATH) {
            if (($config = RouterUrlModel::findBySlug($slug)) !== null) {
                $view->title = Html::decode($config->meta_title) ?: $view->title;

                if (($keyword = Html::decode($config->meta_keywords)) && !empty($keyword)) {
                    $view->registerMetaTags('keywords', $keyword);
                }

                if (($description = Html::decode($config->meta_description)) && !empty($description)) {
                    $view->registerMetaTags('description', $description);
                }

                $view->registerMetaTags('title', $view->title);
                $view->registerMetaTags('copyright', $setting_array['main_copyright_author']);
                $view->registerMetaTags('author', $setting_array['main_copyright_author']);
            } else {
                if ($slug = 'du-an-tieu-bieu') {
                    $view->registerMetaTags('title', $setting_array['project_meta_title']);
                    $view->registerMetaTags('keywords', $setting_array['project_meta_keywords']);
                    $view->registerMetaTags('description', $setting_array['project_meta_description']);
                }
                if ($slug = 'kinh-nghiem-hay') {
                    $view->registerMetaTags('title', $setting_array['news_meta_title']);
                    $view->registerMetaTags('keywords', $setting_array['news_meta_keywords']);
                    $view->registerMetaTags('description', $setting_array['news_meta_description']);
                }
                if ($slug = 'users-login') {
                    $view->registerMetaTags('title', $setting_array['post_meta_title']);
                    $view->registerMetaTags('keywords', $setting_array['post_meta_keywords']);
                    $view->registerMetaTags('description', $setting_array['post_meta_description']);
                }
            }
        } else {
            $view->registerMetaTags('title', $setting_array['home_meta_title']);
            $view->registerMetaTags('keywords', $setting_array['home_meta_keywords']);
            $view->registerMetaTags('description', $setting_array['home_meta_description']);
            $view->registerMetaTags('copyright', $setting_array['main_copyright_author']);
            $view->registerMetaTags('author', $setting_array['main_copyright_author']);
        }
        return null;
    }
}
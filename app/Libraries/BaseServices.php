<?php

namespace App\Libraries;


use CodeIgniter\Config\Services;

class BaseServices extends Services
{
    /**
     * {@inheritdoc}
     * @return BaseView
     */
    public static function renderer(string $viewPath = null, $config = null, bool $getShared = false)
    {
        if ($getShared) {
//            echo '<pre>'; print_r(static::$instances); die;
            return static::getSharedInstance('renderer', $viewPath, $config);
        }

        if (is_null($config)) {
            $config = new \Config\View();
        }

        if (is_null($viewPath)) {
            $paths = config('Paths');

            $viewPath = $paths->viewDirectory;
        }

        return new BaseView($config, $viewPath, static::locator(true), CI_DEBUG, static::logger(true));
    }
}
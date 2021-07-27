<?php

namespace App\Helpers\Assets;

use App\Libraries\BaseView;

class BaseAsset
{
    public $vendor = null;

    public $depends = [];

    protected $url = null;

    protected static $_instance = [];

    /**
     * @var array
     */
    public $js = [];

    /**
     * @var array
     */
    public $css = [];

    public function __construct()
    {
        // Auto load
        helper(['filesystem']);

        $this->copyVendor();
    }

    /**
     * Copy vendor
     */
    private function copyVendor()
    {
        if ($this->vendor && is_dir(($path = ROOTPATH . "vendor/{$this->vendor}"))) {
            $folderName = md5($path);
            $this->url = base_url("assets/{$folderName}");

            $destination = ROOTPATH . PUBLISH_FOLDER . '/assets/' . $folderName;

            if (!is_dir($destination)) {
                $this->recurseCopy($path, $destination);
            }
        }
    }

    /**
     * Copy folder
     *
     * @param $src
     * @param $dst
     */
    private function recurseCopy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurseCopy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    /**
     * @param BaseView $view
     */
    public static function register(BaseView $view)
    {
        $class = get_called_class();
        if (!in_array($class, $view->assets)) {
            $view->assets[] = $class;
        }
    }

    /**
     * Create Url
     *
     * @param $file
     * @return string
     */
    public function createUrl($file): string
    {
        if (is_array($file)) {
            [$file] = $file;
        }

        if (!$this->url || strpos($file, 'http') === 0) return $file;

        return "{$this->url}/{$file}";
    }

    /**
     * @return BaseAsset
     */
    public static function getAsset(): BaseAsset
    {
        $className = get_called_class();

        if (!in_array($className, static::$_instance)) {
            static::$_instance[$className] = new $className();
        }

        return static::$_instance[$className];
    }
}
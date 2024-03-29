<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace App\Helpers;

/**
 * Url provides a set of static methods for managing URLs.
 *
 * For more details and usage information on Url, see the [guide article on url helpers](guide:helper-url).
 *
 * @author Alexander Makarov <sam@rmcreative.ru>
 * @since 2.0
 */
class SettingHelper
{
    public function getSettingImage($image = ''): string
    {
        if (!$image || empty($image)) return '/images/empty.jpg';

        return base_url("uploads/content/{$image}");
    }
    public function getSettingImageLogo($image =''): string
    {
        if (!$image || empty($image)) return '/images/empty.jpg';

        return base_url("images/{$image}");
    }
    public function getSettingImageFavicon($image = ''):string
    {
        if (!$image || empty($image)) return '/images/empty.jpg';

        return base_url("/{$image}");
    }

}

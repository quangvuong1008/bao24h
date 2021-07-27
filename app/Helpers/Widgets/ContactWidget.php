<?php

namespace App\Helpers\Widgets;


use App\Helpers\SessionHelper;
use App\Libraries\BaseView;
use App\Models\FormRequestModel;
use App\Models\SettingsModel;

class ContactWidget extends BaseWidget
{
    const SESSION_ALERT_KEY = 'REGISTER';

    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    public static function register(BaseView $view, array $data = [])
    {
        $model = FormRequestModel::getInstance();

        $message = SessionHelper::getInstance()->getFlash(self::SESSION_ALERT_KEY);

        $setting_model  =(new SettingsModel());
        $contact_box_banner = $setting_model->get_setting('contact_box_banner');

        return static::render($view, 'contact', [
            'model' => $model,
            'message' => $message,
            'contact_box_banner' =>$contact_box_banner->value
        ]);
    }
}
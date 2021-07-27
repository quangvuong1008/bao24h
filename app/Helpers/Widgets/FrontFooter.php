<?php

namespace App\Helpers\Widgets;


use App\Libraries\BaseView;
use App\Models\SettingsModel;

class FrontFooter extends BaseWidget
{

    /**
     * @param BaseView $view
     * @param array $data
     * @return string
     */
    public static function register(BaseView $view, array $data = [])
    {
        $nav = [
            [
                'label' => 'Quy Trình Làm Việc',
                'url' => 'quy-trinh-lam-viec',
                'title' => 'quy trình thiết kế và thi công nội thất'
            ],
            [
                'label' => 'Bảo Hành - Đổi Trả',
                'url' => 'bao-hanh-doi-tra',
                'title' => 'chính sách bảo hành và đổi trả hàng'
            ],
            [
                'label' => 'Hình Thức Thanh Toán',
                'url' => 'hinh-thuc-thanh-toan',
                'title' => 'hình thức thanh toán tiền'
            ],
            [
                'label' => 'Vận Chuyển - Giao Nhận',
                'url' => 'van-chuyen-giao-nhan-lap-dat-hang',
                'title' => 'chính sách vận chuyển, giao nhận và lắp đặt'
            ],
            [
                'label' => 'Chính Sách Bảo Mật',
                'url' => 'chinh-sach-bao-mat',
                'title' => 'chính sách bảo mật thông tin'
            ],
        ];

        $settings =  new SettingsModel();
        $settings = $settings->findAll();
        $setting_array = [];
        if($settings){
            foreach ($settings as $setting){
                $setting_array[$setting->key] = $setting->value;
            }
        }
        return static::render($view, 'front_footer', [
            'nav' => $nav,
            'settings' => $setting_array
        ]);
    }
}
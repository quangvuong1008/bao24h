<?php

namespace App\Controllers;

use App\Helpers\Widgets\UsersRegisterWidget;
use App\Models\NewsModel;
use App\Models\SettingsModel;
use App\Models\UsersModel;
use http\Env\Request;
use App\Helpers\SessionHelper;
use DateTime;

class Users extends BaseController
{
    public function login()
    {
        $settings = new SettingsModel();
        $settings = $settings->findAll();
        $setting_array = [];
        if ($settings) {
            foreach ($settings as $setting) {
                $setting_array[$setting->key] = $setting->value;
            }
        }
        return $this->render('users/login', [
            'model' => '',
            'title' => $setting_array['post_meta_title'],
        ]);
    }

    public function register()
    {
        return $this->render('users/register', [
            'model' => ''
        ]);
    }

    public function add_register()
    {
        $data = $this->request->getPost();
        $full_name = $data['full_name'];
        $username = $data['username'];
        $password = md5($data['password']);
        $email = $data['email'];
        $address = $data['address'];
        $avatar = $data['avatar'];
        $phone = $data['phone'];
        $created_at = date_timestamp_get(new DateTime());
        $save = new UsersModel();
        $user_register = $save->select_register($username, $email);
        if ($user_register <= 0) {
            if ($save->insert_register($username, $password, $email, $address, $full_name, $avatar, $phone, $created_at)) {
                SessionHelper::getInstance()->setFlash('REGISTER', [
                    'type' => 'FRONT_SUCCESS',
                    'message' => 'Đăng ký thành công , vui lòng chờ admin xét duyệt để được đăng bài'
                ]);
            }
        } else {
            SessionHelper::getInstance()->setFlash('REGISTER', [
                'type' => 'FRONT_ERROR',
                'message' => 'Tên đăng nhập và email đã tồn tại'
            ]);
        }
        return $this->response->redirect(route_to('register'));
    }

    public function user_login()
    {
        $data = $this->request->getPost();
        $username = $data['username'];
        $password = md5($data['password']);
        $login = new UsersModel();
        $user = $login->select_login($username, $password);
        if ($user){
            $session = session();
            $session->set(SESSION_USER_ID_KEY, $user->id);
            SessionHelper::getInstance()->setFlash('REGISTER', [
                'type' => 'FRONT_SUCCESS_LOGIN',
                'message' => 'Đăng nhập thành công'
            ]);
        } else {
            SessionHelper::getInstance()->setFlash('REGISTER', [
                'type' => 'FRONT_ERROR_LOGIN',
                'message' => 'Đăng nhập thất bại'
            ]);
        }
        return $this->response->redirect(route_to('user_posts_manage'));
    }

    public function logout(){
        $logout_user = new UsersModel();
        $session = session();
        $session->remove(SESSION_USER_ID_KEY, $logout_user->id);
        return $this->response->redirect(route_to('home_index'));
    }
}
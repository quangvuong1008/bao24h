<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Helpers\ArrayHelper;
use App\Helpers\SessionHelper;
use App\Helpers\StringHelper;
use App\Models\AdministratorModel;
use App\Models\Forms\AdminLoginModel;

class Auth extends BaseController
{
    /**
     * @return string
     */
    public function login()
    {
        $this->layout = 'empty';

        if (AdminLoginModel::findIdentity() !== null) {
            SessionHelper::getInstance()->setFlash('ALERT', [
                'type' => 'info',
                'message' => 'Bạn đã đăng nhập'
            ]);
            return $this->response->redirect(route_to('admin_home'));
        }

        $model = new AdminLoginModel();

        if ($this->isPost() && $this->validate($model->getRules()) && $model->load($this->request)) {
            $account = $model->bindAdminAccount();
            if (!$account || !$account->login()) {
                $this->validator->setError('account_name', 'Không thể đăng nhập bằng tài khoản này');
            } else {
                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'success',
                    'message' => 'Đăng nhập thành công'
                ]);
                if (($query = $this->request->uri->getQuery()) !== null && !empty($query)) {
                    list(, $prev) = StringHelper::explode($query, '=');
                    return $this->response->redirect(urldecode($prev));
                }
                return $this->response->redirect(route_to('admin_home'));
            }
        }

        // Check first admin account to init
        $admin = (new AdministratorModel())->where('is_lock', 0)->first();

        return $this->render('login', [
            'requestInit' => $admin === null,
            'model' => $model,
            'validator' => $this->validator
        ]);
    }

    /**
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function initialize()
    {
        $this->layout = 'empty';

        $admin = (new AdministratorModel())->where('is_lock', 0)->first();
        if ($admin !== null) {
            return $this->response->redirect('admin_home');
        }

        /** @var AdministratorModel $model */
        $model = new AdministratorModel();

        if ($this->isPost() && $this->validate($model->getRules())) {
            try {
                $model = $model->loadAndSave($this->request, function ($request, $data) {
                    $data['is_lock'] = 0;
                    if (($pwd = ArrayHelper::getValue($data, 'password')) !== null) {
                        $data['password_hash'] = AdministratorModel::createPasswordHash($pwd);
                        unset($data['password']);
                    }
                    $data['type'] = AdministratorModel::TYPE_ADMIN;
                    return $data;
                });

                if ($model->login_after_init == 1 && $model->login()) {
                    SessionHelper::getInstance()->setFlash('ALERT', [
                        'type' => 'success',
                        'message' => 'Khởi tạo và Đăng nhập thành công'
                    ]);
                    return $this->response->redirect(route_to('admin_home'));
                }

                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'success',
                    'message' => 'Khởi tạo thành công.'
                ]);
                return $this->response->redirect(route_to('admin_login'));
            } catch (\Exception $ex) {
                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'danger',
                    'message' => $ex->getMessage()
                ]);
            }
        }

        return $this->render('initialize', [
            'model' => $model,
            'validator' => $this->validator
        ]);

    }

    /**
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function logout()
    {
        if (!$this->isPost() || ($admin = AdministratorModel::findIdentity()) === null) {
            return $this->renderError();
        }
        $admin->logout();
        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'success',
            'message' => 'Đăng xuất thành công'
        ]);
        return $this->response->redirect(route_to('admin_login') . '?prev=' . $this->request->getHeader('Referer')->getValue());
    }
}
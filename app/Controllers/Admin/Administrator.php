<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Helpers\ArrayHelper;
use App\Helpers\SessionHelper;
use App\Models\AdministratorModel;

class Administrator extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        $model = new AdministratorModel();

        return $this->render('index', [
            'models' => $model->paginate(),
            'pager' => $model->pager
        ]);
    }

    /**
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function create()
    {
        /** @var AdministratorModel $model */
        $model = new AdministratorModel();

        if ($this->isPost() && $this->validate($model->getRules())) {
            try {
                $model = $model->loadAndSave($this->request, function ($request, $data) {
                    if (($pwd = ArrayHelper::getValue($data, 'password')) !== null) {
                        $data['password_hash'] = AdministratorModel::createPasswordHash($pwd);
                        unset($data['password']);
                    }
                    $data['type'] = AdministratorModel::TYPE_ADMIN;
                    return $data;
                });

                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'success',
                    'message' => 'Tạo mới thành công'
                ]);
                return $this->response->redirect(route_to('administrator'));
            } catch (\Exception $ex) {
                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'danger',
                    'message' => $ex->getMessage()
                ]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'validator' => $this->validator
        ]);
    }

    /**
     * @param $id
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function update($id)
    {
        /** @var AdministratorModel $model */
        $model = (new AdministratorModel())->find($id);

        if (!$model) {
            return $this->renderError();
        }

        if ($this->isPost() && $this->validate($model->getRules('update'))) {
            try {
                $model = $model->loadAndSave($this->request, function ($request, $data) {

                    if (($pwd = ArrayHelper::getValue($data, 'password')) !== null) {
                        $data['password_hash'] = AdministratorModel::createPasswordHash($pwd);
                        unset($data['password']);
                    }
                    $data['type'] = AdministratorModel::TYPE_ADMIN;
                    return $data;
                });

                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'info',
                    'message' => 'Cập nhật thành công'
                ]);
                return $this->response->redirect(route_to('administrator'));
            } catch (\Exception $ex) {
                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'danger',
                    'message' => $ex->getMessage()
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'validator' => $this->validator
        ]);
    }


    /**
     * @param $id
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function delete($id)
    {
        /** @var AdministratorModel $model */
        if (!$this->isPost() || !($model = (new AdministratorModel())->find($id))) {
            return $this->renderError();
        }

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'warning',
            'message' => 'Xoá thành công'
        ]);
        $model->delete($model->getPrimaryKey());
        return $this->response->redirect(route_to('administrator'));
    }
}
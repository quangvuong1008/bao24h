<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Helpers\ArrayHelper;
use App\Helpers\SessionHelper;
use App\Models\AdministratorModel;
use App\Models\PacketModel;
use App\Models\UserPacketModel;
use App\Models\UsersModel;

class Packet extends BaseController
{

    public function index()
    {
        $model = new PacketModel();

        if (($keyword = $this->request->getGet('keyword')) !== null) {
            $model
                ->like('name', $keyword)
                ->orLike('number_post', $keyword)
                ->orLike('range_type', $keyword);
        }

        $model->orderBy('id', 'DESC');


        return $this->render('index', [
            'models' => $model->paginate(),
            'pager' => $model->pager
        ]);
    }
    public function create()
    {
        /** @var PacketModel $model */
        $model = new PacketModel();

        if ($this->isPost() && $this->validate($model->getRules())) {

            try {
                $model = $model->loadAndSave($this->request, function ($request, $data) {
                    return $data;
                });

                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'success',
                    'message' => 'Thêm mới thành công'
                ]);

                return $this->response->redirect(route_to('admin_packet'));
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

    public function update($id)
    {
        /** @var PacketModel $model */
        $model = (new PacketModel())->find($id);


        if (!$model) {
            return $this->renderError();
        }


        if ($this->isPost() && $this->validate($model->getRules('update'))) {
            try {
                $model = $model->loadAndSave($this->request, function ($request, $data) {
                    return $data;
                });


                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'info',
                    'message' => 'Cập nhật thành công'
                ]);
                return $this->response->redirect(route_to('admin_packet'));
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
        /** @var PacketModel $model */
        if (!$this->isPost() || !($model = (new PacketModel())->find($id))) {
            return $this->renderError();
        }

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'warning',
            'message' => 'Xoá thành công'
        ]);
        $model->delete($model->getPrimaryKey());
        return $this->response->redirect(route_to('admin_packet'));
    }


}
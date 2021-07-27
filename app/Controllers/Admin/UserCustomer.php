<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Helpers\ArrayHelper;
use App\Helpers\SessionHelper;
use App\Models\AdministratorModel;
use App\Models\PacketModel;
use App\Models\UserPacketModel;
use App\Models\UsersModel;

class UserCustomer extends BaseController
{

    public function index()
    {
        $model = new UsersModel();

        if (($keyword = $this->request->getGet('keyword')) !== null) {
            $model
                ->like('full_name', $keyword)
                ->orLike('phone', $keyword)
                ->orLike('email', $keyword);
        }

        $model
            ->orderBy('active', 'ASC')
            ->orderBy('id','DESC');


        return $this->render('index', [
            'models' => $model->paginate(),
            'pager' => $model->pager
        ]);
    }

    public function view($id)
    {
        /** @var UsersModel $model */
        $model = (new UsersModel())->find($id);


        if (!$model) {
            return $this->renderError();
        }
        if ($this->isPost() && $this->validate($model->getRules('update'))) {
            try {
                $model = $model->loadAndSave($this->request, function ($request, $data) {

                    if (($pwd = ArrayHelper::getValue($data, 'password')) !== null) {
                        $data['password'] = md5($pwd);
                        unset($pwd);
                    }

                    return $data;
                });
                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'info',
                    'message' => 'Đổi mật khẩu thành công'
                ]);
                return $this->response->redirect(route_to('admin_user_customer'));
            } catch (\Exception $ex) {
                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'danger',
                    'message' => $ex->getMessage()
                ]);
            }


        }
        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function update($id)
    {
        /** @var UsersModel $model */
        $model = (new UsersModel())->find($id);
        $packet = (new PacketModel())->findAll();

        $packet_model = (new UserPacketModel());
        $get_packet = $packet_model->get_user_packet($id);
//        var_dump($get_packet);die();

        if (!$model) {
            return $this->renderError();
        }


        if ($this->isPost() && $this->validate($model->getRules('update'))) {
            try {
                $model = $model->loadAndSave($this->request, function ($request, $data) {

//                    if (($pwd = ArrayHelper::getValue($data, 'password')) !== null) {
//                        $data['password'] = md5($pwd);
//                        unset($pwd);
//                    }

                    return $data;
                });

                $packet_model->delete_user_packet($id);

                $packet_id = $_POST['packet'];
                $packet_model->insert_user_packet($id, $packet_id);


                $model->update($model->getPrimaryKey(), ['active' => 1]);
                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'info',
                    'message' => 'Cập nhật thành công'
                ]);
                return $this->response->redirect(route_to('admin_user_customer'));
            } catch (\Exception $ex) {
                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'danger',
                    'message' => $ex->getMessage()
                ]);
            }


        }

        return $this->render('update', [
            'model' => $model,
            'packet' => $packet,
            'get_packet' => $get_packet,
            'validator' => $this->validator
        ]);
    }

    /**
     * @param $id
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function delete($id)
    {
        /** @var UsersModel $model */
        if (!$this->isPost() || !($model = (new UsersModel())->find($id))) {
            return $this->renderError();
        }

        SessionHelper::getInstance()->setFlash('ALERT', [
            'type' => 'warning',
            'message' => 'Xoá thành công'
        ]);
        $model->delete($model->getPrimaryKey());
        return $this->response->redirect(route_to('admin_user_customer'));
    }


}
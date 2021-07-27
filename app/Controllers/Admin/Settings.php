<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Helpers\ArrayHelper;
use App\Helpers\Json;
use App\Helpers\SessionHelper;
use App\Helpers\StringHelper;
use App\Models\ObjectContentModel;
use App\Models\NewsModel;
use App\Models\SettingsModel;
use CodeIgniter\HTTP\Request;

class Settings extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        $models = new SettingsModel();

        $models = $models->findAll();

        $list_config = [];
        if($models){
            foreach ($models as $model){
                $list_config[$model->key] = $model->value;
            }
        }
        return $this->render('index', [
            'model' => $list_config,
        ]);
    }


    /**
     * @param $id
     * @return \CodeIgniter\HTTP\Response|string
     */
    public function update()
    {

        if ($this->isPost() ) {
            $model = (new SettingsModel());
            try {

                $data =$this->request->getPost();

                //process upload file
                $home_banner_1 = $this->upload('home_banner_1');
                $home_banner_2 = $this->upload('home_banner_2');
                $home_banner_3 = $this->upload('home_banner_3');
                $home_meta_link = $this->upload('home_meta_link');
                if($home_banner_1 && !empty($home_banner_1)){
                    $model->insert_or_update('home_banner_1',$home_banner_1);
                }
                if($home_banner_2 && !empty($home_banner_2)){
                    $model->insert_or_update('home_banner_2',$home_banner_2);
                }
                if($home_banner_3 && !empty($home_banner_3)){
                    $model->insert_or_update('home_banner_3',$home_banner_3);
                }
                if ($home_meta_link && !empty($home_meta_link)){
                    $model->insert_or_update('home_meta_link',$home_meta_link);
                }

                $home_video_thumb_1 = $this->upload('home_video_thumb_1');
                $home_video_thumb_2 = $this->upload('home_video_thumb_2');
                $home_video_thumb_3 = $this->upload('home_video_thumb_3');

                if($home_video_thumb_1 && !empty($home_video_thumb_1)){
                    $model->insert_or_update('home_video_thumb_1',$home_video_thumb_1);
                }
                if($home_video_thumb_2 && !empty($home_video_thumb_2)){
                    $model->insert_or_update('home_video_thumb_2',$home_video_thumb_2);
                }
                if($home_video_thumb_3 && !empty($home_video_thumb_3)){
                    $model->insert_or_update('home_video_thumb_3',$home_video_thumb_3);
                }

                $contact_box_banner = $this->upload('contact_box_banner');
                if($contact_box_banner && !empty($contact_box_banner)){
                    $model->insert_or_update('contact_box_banner',$contact_box_banner);
                }
                $home_logo_link = $this->upload_logo('home_logo_link');
                if($home_logo_link && !empty($home_logo_link)) {
                    $model->insert_or_update('home_logo_link', $home_logo_link);
                }
                $home_favicon_link = $this ->upload_favicon_logo('home_favicon_link');
                if($home_favicon_link && !empty($home_favicon_link)) {
                    $model->insert_or_update('home_favicon_link', $home_favicon_link);
                }

                //process data
                foreach ($data as $key => $value){
                    $model->insert_or_update($key,$value);
                }

                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'info',
                    'message' => 'Cập nhật thành công'
                ]);

                return $this->response->redirect(route_to('admin_setting'));
            } catch (\Exception $ex) {
                SessionHelper::getInstance()->setFlash('ALERT', [
                    'type' => 'danger',
                    'message' => $ex->getMessage()
                ]);
            }
        }


        return $this->index();
    }


    /**
     * Upload file
     *
     * @return null|string
     */
    protected function upload($key = '')
    {
        if (($file = $this->request->getFile($key)) === null || $file->getError() || !$file->isValid()) {
            return null;
        }

        $uploadPath = ROOTPATH . PUBLISH_FOLDER . '/uploads/content';

        $fileName = $file->getFileNameStore();

        if (!$file->hasMoved() && $file->move($uploadPath, $fileName)) {
            return $fileName;
        }

        return null;
    }
    protected function upload_logo($key = '')
    {
        if (($file = $this->request->getFile($key)) === null || $file->getError() || !$file->isValid()) {
            return null;
        }

        $uploadPath = ROOTPATH . PUBLISH_FOLDER . '/images';

        $fileName = $file->getFileNameStore();

        if (!$file->hasMoved() && $file->move($uploadPath, $fileName)) {
            return $fileName;
        }

        return null;
    }
    protected function upload_favicon_logo($key = '')
    {
        if (($file = $this->request->getFile($key)) === null || $file->getError() || !$file->isValid()) {
            return null;
        }

        $uploadPath = ROOTPATH . PUBLISH_FOLDER . '/';

        $fileName = 'favicon.ico';

        if (!$file->hasMoved() && $file->move($uploadPath, $fileName, true)) {
            return $fileName;
        }

        return null;
    }
}
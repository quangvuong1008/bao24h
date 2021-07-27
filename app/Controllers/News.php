<?php

namespace App\Controllers;


use App\Models\NewsModel;
use App\Models\SettingsModel;
use App\Models\VotesModel;

class News extends BaseController
{
    public function index()
    {
        $model = (new NewsModel())->where('is_lock', 0)->orderBy('created_at', 'DESC');

        $settings =  new SettingsModel();
        $settings = $settings->findAll();
        $setting_array = [];
        if($settings){
            foreach ($settings as $setting){
                $setting_array[$setting->key] = $setting->value;
            }
        }

        return $this->render('news/index', [
            'models' => $model->paginate(),
            'pager' => $model->pager,
            'title' => $setting_array['news_meta_title'],
            'meta_image_url'=> $model->getImage()
        ]);
    }

    public function detail(int $id)
    {
        $vote  =(new VotesModel())->get_avg_vote_rate_of_news($id);
        $model = (new NewsModel())
            ->where('is_lock', 0)->find($id);

        if (!$model) {
            return $this->renderError();
        }

        return $this->render('news/detail', [
            'vote'=>$vote,
            'model' => $model,
            'meta_image_url'=> $model->getImage()
        ]);
    }
    public function insert_votes_rate_news(){
        $data = $this->request->getPost();
        $object_id = $data['object_id'];
        $guest_id = (new \DateTime())->format('Y-m-d H:i:s');
        $vote_rate = $data['vote_rate'];
        $ip_address = $this->request->getIPAddress();



        $key = 'vote_news'. $object_id;
        $session = session();

        $exits_session = $session->get($key);
        if($exits_session) {
            echo json_encode(0);
            die;
        }

        $session->set($key,1);

        $votes_rate = (new VotesModel())->insert_vote_rate_news($object_id,$guest_id,$vote_rate,$ip_address);
        echo json_encode(1);

    }
}
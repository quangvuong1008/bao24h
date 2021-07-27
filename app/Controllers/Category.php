<?php

namespace App\Controllers;


use App\Models\CategoryModel;
use App\Models\PostsModel;
use App\Models\VotesModel;

class Category extends BaseController
{
    public function index(int $id)
    {
        $vote = (new VotesModel())->get_avg_vote_rate_of_category($id);
        /** @var CategoryModel $model */

        $model_cate = (new CategoryModel())->where('is_lock', 0)->find($id);
//
//        if (!$model) {
//            return $this->renderError();
//        }

        /** @var CategoryModel $children */
        $model = (new CategoryModel());
        $model_top = $model
            ->where('is_lock', '0')
            ->find($id);
        $category = $model
            ->addQuery('where', ['is_lock', 0])
            ->getCategoryRecursive($id , 0,2);
        $cate = $model->getCategoryIdRecursive($id, '0', '3');
        $posts = (new PostsModel());
        $post_detail_top = $posts
            ->whereIn('category_id', $cate)
            ->where('is_lock', 0)
            ->orderBy('updated_at', 'DESC');
//        $children = (new CategoryModel())
//            ->where('parent_id', $model->getPrimaryKey())
//            ->where('is_lock', 0);
        $models = (new PostsModel())
            ->where('is_lock', 0)
            ->orderBy('updated_at','DESC');


        return $this->render('index', [
            'vote' => $vote,
            'model' => $model_cate,
            'category'=>$category,
            'model_top'=>$model_top,
//            'model_top' => $children->paginate(10),
//            'pagers' => $children->pager,
            'post_detail_top'=>$post_detail_top->paginate(6),
            'pager' => $post_detail_top->pager,
            'meta_image_url' => $model_top->getImage()
        ]);

    }

    public function detail(int $id)
    {
        $vote = (new VotesModel())->get_avg_vote_rate_of_category($id);
        /** @var PostsModel $model */
        $model = (new PostsModel())->where('is_lock', 0)->find($id);
        if (!$model || !($category = $this->findCategory($model->category_id))) {
            return $this->renderError();
        }
        $meta_posts = [];
        $meta_posts['title'] = $model->meta_title;
        $meta_posts['keywords'] = $model->meta_keywords;
        $meta_posts['description'] = $model->meta_description;


        return $this->render('category/detail', [
            'vote' => $vote,
            'model' => $model,
            'meta_image_url' => $model->getImage(),
            'category' => $category,
            'meta_posts' => $meta_posts
        ]);
    }

    public function ajaxCategoryTop(int $id)
    {
        $this->layout = null;

        $model = (new CategoryModel())->where('is_lock', 0)->find($id);

        if (!$model) {
            return null;
        }

        /** @var CategoryModel $children */
        $children = (new CategoryModel())
            ->where('parent_id', $model->getPrimaryKey())
            ->where('is_lock', 0)
            ->findAll(6);


        return $this->render('category/ajax-category-top', [
            'models' => $children
        ]);
    }

    public function insert_votes_rate_category()
    {
        $data = $this->request->getPost();
        $object_id = $data['object_id'];
        $guest_id = (new \DateTime())->format('Y-m-d H:i:s');
        $vote_rate = $data['vote_rate'];
        $ip_address = $this->request->getIPAddress();


        $key = 'vote_category' . $object_id;
        $session = session();

        $exits_session = $session->get($key);
        if ($exits_session) {
            echo json_encode(0);
            die;
        }

        $session->set($key, 1);

        $votes_rate = (new VotesModel())->insert_vote_rate($object_id, $guest_id, $vote_rate, $ip_address);
        echo json_encode(1);

    }

    protected function findCategory(int $id)
    {
        return (new CategoryModel())->where('is_lock', 0)->find($id);
    }
}
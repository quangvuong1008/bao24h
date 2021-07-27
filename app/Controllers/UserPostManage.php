<?php

namespace App\Controllers;

use App\Helpers\SessionHelper;
use App\Helpers\Widgets\UsersRegisterWidget;
use App\Models\DistrictModel;
use App\Models\PacketModel;
use App\Models\ProductCategoryModel;
use App\Models\ProvinceModel;
use App\Models\StreetModel;
use App\Models\UserMediaModel;
use App\Models\UserPacketModel;
use App\Models\UserProductModel;
use App\Models\UsersModel;
use App\Models\WardModel;
use DateTime;

class UserPostManage extends BaseController
{
    public function userPostManage()
    {
        if (!$this->check_users_login()) {
            return null;
        }

        $model = new UsersModel();

        $session = session();
        $user_id = $session->get(SESSION_USER_ID_KEY);
        if ($user_id) {
            $model->find($user_id);
        }
        $list_user_post = (new UserProductModel())
            ->where('user_id', $user_id)
            ->orderBy('id', 'DESC');


        return $this->render('post/index', [
            'list_user_post' => $list_user_post->paginate(8),
            'pager' => $list_user_post->pager
//            'models'=>$model
        ]);
    }

    public function userPosts()
    {
        if (!$this->check_users_login()) {
            return null;
        }
        $model = new UsersModel();
        $session = session();
        $user_id = $session->get(SESSION_USER_ID_KEY);
        if ($user_id) {
            $models = $model->find($user_id);

        }
        $provinces = (new ProvinceModel())->findAll();
        $category_product = (new ProductCategoryModel())
            ->where('parent_id', 0)
            ->findAll();
        $user_packet = (new UserPacketModel())
            ->select_name_packet($user_id);


        return $this->render('post/user_post', [
            'category_product' => $category_product,
            'provinces' => $provinces,
            'user_packet' => $user_packet
        ]);
    }

    public function changeUserInformation()
    {
        if (!$this->check_users_login()) {
            return null;
        }
        $model = new UsersModel();
        $session = session();
        $user_id = $session->get(SESSION_USER_ID_KEY);
        if ($user_id) {
            $model = $model->find($user_id);
        }
        return $this->render('post/change_user_information', [
            'models' => $model
        ]);
    }

    public function update_change_user_information()
    {
        $session = session();
        $user_id = $session->get(SESSION_USER_ID_KEY);
        $data = $this->request->getPost();
        $full_name = $data['full_name'];
        $phone = $data['phone'];
        $address = $data['address'];
        $save = new UsersModel();
        $save->update_user_information($full_name, $phone, $address,$user_id);
        if ($save) {
            SessionHelper::getInstance()->setFlash('REGISTER', [
                'type' => 'FRONT_SUCCESS_CHANGE',
                'message' => 'Sửa thành công'
            ]);
        } else {
            SessionHelper::getInstance()->setFlash('REGISTER', [
                'type' => 'FRONT_ERROR_CHANGE',
                'message' => 'Sửa thất bại'
            ]);
        }
        return $this->response->redirect(route_to('change_user_information'));
    }

    public function changePassword()
    {
        if (!$this->check_users_login()) {
            return null;
        }
            $user_model = (new UsersModel());
        return $this->render('post/change_password', [
            'user_models' => $user_model
        ]);
    }

    public function update_change_password()
    {
        $session = session();
        $user_id = $session->get(SESSION_USER_ID_KEY);
        $data = $this->request->getPost();
        $old_password = md5($data['old_password']);

        $password = md5($data['password']);
        $save = new UsersModel();
        $select = $save->select_user_password($user_id);
        $password_db = '';
        foreach ($select as $sl){
            $password_db = $sl ;
        }
        if ($password_db == $old_password) {
            $save->update_user_password($password,$user_id);
            SessionHelper::getInstance()->setFlash('REGISTER', [
                'type' => 'FRONT_SUCCESS_CHANGE_PASSWORD',
                'message' => 'Đổi mật khẩu thành công'
            ]);
        } else {
            SessionHelper::getInstance()->setFlash('REGISTER', [
                'type' => 'FRONT_ERROR_CHANGE_PASSWORD',
                'message' => 'Mật khẩu không trùng khớp'
            ]);
        }
        return $this->response->redirect(route_to('change_password'));
    }

    public function select_district($province_id)
    {
//        $province_id = $this->request->getGet('province_id');
        $model = (new DistrictModel())->select_district_from_province($province_id);
        echo json_encode($model);
    }


    public function insert_data_user_product()
    {


        if (!$this->check_users_login()) {
            return null;
        }

        $data = $this->request->getPost();

        $product_type = $data['product_type'];
        if (!$product_type){
            SessionHelper::getInstance()->setFlash('REGISTER', [
                'type' => 'FRONT_ERROR_INDEX',
                'message' => 'Tài khoản chưa được xét duyệt vu lòng chờ quản trị xét duyệt'
            ]);
            return $this->response->redirect(route_to('user_posts_manage'));
        }
        $start_date = null;
        if ($data['start_date']) {
            $start_date = date_timestamp_get(date_create_from_format('d/m/Y', $data['start_date']));
        }
        $end_date = null;
        if ($data['end_date']) {
            $end_date = date_timestamp_get(date_create_from_format('d/m/Y', $data['end_date']));
        }
        $sold_type = $data['sold_type'];
        $product_category_id = $data['product_category_id'];
        $province = $data['province'];
        $district = $data['district'];
        $price = $data['price'];
        $unit = $data['unit'];
        $address = $data['address'];
        $title = $data['title'];
        $description = $data['description'];
        $content = $data['content'];
        $keyword = $data['keyword'];
        $user_name = $data['user_name'];
        $user_address = $data['user_address'];
        $user_phone = $data['user_phone'];
        $user_email = $data['user_email'];
        $created_at = date_timestamp_get(new DateTime());
        $model_user_product = new UserProductModel();
        $model = new UsersModel();
        $session = session();
        $user_id = $session->get(SESSION_USER_ID_KEY);
        if ($user_id) {
            $model->find($user_id);
        }

        $packet_of_user = $model->get_packet_of_user($user_id);
//        $packet_count_of_user = $model->get_count_packet_of_user($user_id);

        if (!$packet_of_user) { //nếu không tồn tại gói tinh thì thông báo rồi thoát
            //
            SessionHelper::getInstance()->setFlash('REGISTER', [
                'type' => 'FRONT_ERROR_INDEX',
                'message' => 'Tài khoản chưa được xét duyệt vu lòng chờ quản trị xét duyệt'
            ]);
            return $this->response->redirect(route_to('user_posts_manage'));
        } else { //nếu tồn tại gói tin thì xem xét tiếp
            // nếu là gói tin ngày thì xử lý theo gói tin ngày
            if ($packet_of_user->range_type == 'day') {
                //lấy ra tổng số bản ghi theo ngày của user
                $check_count_create_at_day = $model_user_product->select_count_created_at_day($user_id)->total_rec_p_day;
                //so sánh số bản ghi theo ngày với number_post
                if ($check_count_create_at_day >= $packet_of_user->number_post) {
                    SessionHelper::getInstance()->setFlash('REGISTER', [
                        'type' => 'FRONT_ERROR_INDEX',
                        'message' => 'Bạn đã đăng quá số bài quy định'
                    ]);
                    return $this->response->redirect(route_to('user_posts_manage'));

                }
            } else { // nếu ko phải là gói ngày thì xử lý theo tháng
                if ($packet_of_user->range_type == 'month') {
                    //lấy ra số bản ghi theo tháng
                    $check_count_create_at_month = $model_user_product->select_count_created_at_month($user_id)->total_rec_p_month;

                    //so sánh số bản ghi theo tháng với number_post
                    if ($check_count_create_at_month >= $packet_of_user->number_post) {
                        SessionHelper::getInstance()->setFlash('REGISTER', [
                            'type' => 'FRONT_ERROR_INDEX',
                            'message' => 'Bạn đã đăng quá số bài quy định của gói'
                        ]);
                        return $this->response->redirect(route_to('user_posts_manage'));
                    }
                }
            }
        }
        $status = $data['status'];
        if ($packet_of_user->range_type == 'day') {
            $status = 0;
        } else {
            if ($packet_of_user->range_type == 'month') {
                $status = 1;
            }
        }

        $product_id = $model_user_product->insert_user_product($user_id, $product_type, $start_date, $end_date, $sold_type, $product_category_id, $province, $district,
            $price, $unit, $address, $title,$description, $content, $keyword, $status,$user_name,$user_address,$user_phone,$user_email,$created_at);

        if ($product_id) {

            //xư lý upload file và gắn file ở đây
            $dataInfo = array();
            $user_file = count($_FILES['user_media']['name']);
            $user_file_size = array_sum($_FILES['user_media']['size']);
            $file_size_images = 2097152;


            $user_media_model = new UserMediaModel();
            if ($user_file >= 5) {
                $user_file = 5;
            }


            if ($user_file_size > $file_size_images) {
                SessionHelper::getInstance()->setFlash('REGISTER', [
                    'type' => 'FRONT_ERROR_INDEX',
                    'message' => 'Kích thước ảnh không được vượt quá 2MB'
                ]);
                return $this->response->redirect(route_to('user_posts_manage'));

            }
            for ($i = 0; $i < $user_file; $i++) {
                $target_file = ROOTPATH . PUBLISH_FOLDER . '/uploads/user_media/' . $_FILES['user_media']['name'][$i];
                move_uploaded_file($_FILES["user_media"]["tmp_name"][$i], $target_file);
                $url = (base_url('/uploads/user_media/' . $_FILES['user_media']['name'][$i]));
                $user_media_model->insert_user_media($user_id, $product_id, $url, $target_file);
            }

            SessionHelper::getInstance()->setFlash('REGISTER', [
                'type' => 'FRONT_SUCCESS_INDEX',
                'message' => 'Đăng tin thành công'
            ]);
        } else {
            SessionHelper::getInstance()->setFlash('REGISTER', [
                'type' => 'FRONT_ERROR_INDEX',
                'message' => 'Đăng tin thất bại'
            ]);
        }
        return $this->response->redirect(route_to('user_posts_manage'));
    }

    public function updateUserPosts($id)
    {
        if (!$this->check_users_login()) {
            return null;
        }

        $model = (new UserProductModel())
            ->find($id);
        $product_category_id = $model->sold_type;
        $provinces_id = $model->province;
        $district_id = $model->district;
        $product_type = $model->product_type;
        $provinces = (new ProvinceModel())->findAll();
        $district = (new DistrictModel())->where('_province_id', $provinces_id)->findAll();
        $model_user_media = (new UserMediaModel())->where('user_product_id', $id)->findAll();
//        dd($model_user_media);


        $model_category_product = (new ProductCategoryModel());
        $category_product = $model_category_product
            ->where('parent_id', 0)
            ->findAll();
        $category_product_parent = $model_category_product->where('parent_id', $product_category_id)->findAll();

        return $this->render('post/user_post', [
            'category_product' => $category_product,
            'select_province_id' => $provinces_id,
            'select_district_id' => $district_id,
            'districts' => $district,
            'model' => $model,
            'model_user_medias' => $model_user_media,
            'provinces' => $provinces,
            'product_type' => $product_type,
            'category_product_parent' => $category_product_parent,
            'select_product_category_id' => $product_category_id
        ]);
    }

    public function update_data_user_product($id)
    {

        if (!$this->check_users_login()) {
            return null;
        }
        $model_user_product = (new UserProductModel())->find($id);
//        $model_pro_id = $model_user_product ->id;
        if (!$model_user_product) {
            return null;
        }
        $user_product_id = $model_user_product->user_id;
        $session = session();
        $user_id = $session->get(SESSION_USER_ID_KEY);
        if ($user_id != $user_product_id) {
            return $this->response->redirect(route_to('login'));
        }
        $data = $this->request->getPost();
        $product_type = $data['product_type'];
        $start_date = null;
        if ($data['start_date']) {
            $start_date = date_timestamp_get(date_create_from_format('d/m/Y', $data['start_date']));
        }
        $end_date = null;
        if ($data['end_date']) {
            $end_date = date_timestamp_get(date_create_from_format('d/m/Y', $data['end_date']));
        }
        $sold_type = $data['sold_type'];
        $product_category_id = $data['product_category_id'];
        $province = $data['province'];
        $district = $data['district'];
        $price = $data['price'];
        $unit = $data['unit'];
        $address = $data['address'];
        $title = $data['title'];
        $description = $data['description'];
        $content = $data['content'];
        $keyword = $data['keyword'];
        $user_name = $data['user_name'];
        $user_address = $data['user_address'];
        $user_phone = $data['user_phone'];
        $user_email = $data['user_email'];

        $update_user_pro = $model_user_product->update_user_product($id, $user_id, $product_type, $start_date, $end_date, $sold_type, $product_category_id, $province, $district,
            $price, $unit, $address, $title,$description, $content, $keyword,$user_name,$user_address,$user_phone,$user_email);

        if ($update_user_pro) {

            $dataInfo = array();
//            $user_file = count($_FILES['user_media']['name']);
            $user_media_model = new UserMediaModel();
            $count = $user_media_model->select_user_media($id)->num;
            $user_file = 0;
            if (isset($_FILES['user_media']['name'])) {
                $user_file = count($_FILES['user_media']['name']);
                $user_file_size = array_sum($_FILES['user_media']['size']);
                $file_size_images = 2097152;
                if ($count >= 5) {
                    SessionHelper::getInstance()->setFlash('REGISTER', [
                        'type' => 'FRONT_ERROR_INDEX',
                        'message' => 'Số lượng ảnh đã lớn hơn 5'
                    ]);
                    return $this->response->redirect(route_to('user_posts_manage'));
                }
                if ($user_file_size > $file_size_images) {
                    SessionHelper::getInstance()->setFlash('REGISTER', [
                        'type' => 'FRONT_ERROR_INDEX',
                        'message' => 'kích thước ảnh đã lớn hơn 2 MB'
                    ]);
                    return $this->response->redirect(route_to('user_posts_manage'));
                }
            }

            if ($user_file) {

                for ($i = 0; $i < $user_file; $i++) {

                    if ($count <= 5) {
                        $target_file = ROOTPATH . PUBLISH_FOLDER . '/uploads/user_media/' . $_FILES['user_media']['name'][$i];
                        move_uploaded_file($_FILES["user_media"]["tmp_name"][$i], $target_file);
                        $url = (base_url('/uploads/user_media/' . $_FILES['user_media']['name'][$i]));

                        $user_media_model->insert_user_media($user_id, $id, $url, $target_file);
                    }

                    $count++;

                }
            }

            SessionHelper::getInstance()->setFlash('REGISTER', [
                'type' => 'FRONT_SUCCESS_INDEX',
                'message' => 'Sửa tin thành công'
            ]);
        } else {
            SessionHelper::getInstance()->setFlash('REGISTER', [
                'type' => 'FRONT_ERROR_INDEX',
                'message' => 'Sửa thất bại'
            ]);
        }
        return $this->response->redirect(route_to('user_posts_manage'));
    }

    public function delete_image_user_upload()
    {
        $data = $this->request->getPost();
        $id = $data['id'];
        (new UserMediaModel())->delete($id);
        echo json_encode(1);
    }


    public function select_product_category($parent_id)
    {
        $model = (new ProductCategoryModel())->select_product_category_id($parent_id);
        echo json_encode($model);
    }


}


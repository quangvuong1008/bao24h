<?php namespace App\Controllers;

use App\Helpers\ArrayHelper;
use App\Helpers\SessionHelper;
use App\Helpers\SettingHelper;
use App\Helpers\StringHelper;
use App\Helpers\Widgets\ContactWidget;
use App\Models\CategoryModel;
use App\Models\FormRequestModel;
use App\Models\NewsModel;
use App\Models\PacketModel;
use App\Models\PartnerModel;
use App\Models\PostsModel;
use App\Models\ProductCategoryModel;
use App\Models\ProjectCategoryModel;
use App\Models\RouterUrlModel;
use App\Models\SettingsModel;
use App\Models\SliderModel;
use App\Models\TestimonialModel;
use App\Models\UserProductModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Home extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        // Sliders
        $sliders = (new SliderModel())
            ->where('is_lock', 0)
            ->orderBy('order_no', SORT_ASC)
            ->findAll();

        // Project Category
        $projectCategories = (new ProjectCategoryModel())
            ->where('is_lock', 0)
            ->findAll(6);

        // Testimonials
        $testimonials = (new TestimonialModel())
            ->where('is_lock', 0)
            ->findAll(4);

        // Testimonials
        $partners = (new PartnerModel())
            ->where('is_lock', 0)
            ->findAll(20);

        $newsItems = (new NewsModel())
            ->where('is_lock', 0)
            ->where('is_hot', 1)
            ->findAll(3);

        $settings = new SettingsModel();
        $settings = $settings->findAll();
        $setting_array = [];
        if ($settings) {
            foreach ($settings as $setting) {
                $setting_array[$setting->key] = $setting->value;
            }
        }

        //new
        $id = $setting_array['home_corner_view_id'];

        $new = (new PostsModel())
            ->where('is_lock', '0')
            ->where('id', $id)
            ->findAll();



        //product

        $packet = (new PacketModel());

        $user_product = (new UserProductModel());

        $user_product_vip = $user_product
            ->where('status', 1)
            ->where('is_lock', 0)
            ->whereNotIn('product_type', ['tin thường'])
            ->orderBy('created_at', 'DESC')
            ->findAll(10);


        $user_product_free = $user_product
            ->where('status', 1)
            ->where('is_lock', 0)
            ->where('product_type', 'tin thường')
            ->orderBy('created_at', 'DESC')
            ->findAll(10);

        //posts
        $posts = (new PostsModel());
        $posts_top = $posts
            ->where('is_lock', '0')
            ->orderBy('updated_at', 'DESC')
            ->findAll(3);

        $posts_new = $posts
            ->where('is_lock','0')
            ->orderBy('updated_at','DESC')
            ->findAll(1);

        $posts_hot_news = $posts
            ->where('is_lock','0')
            ->orderBy('updated_at','DESC')
            ->findAll('25');
        $Categories_posts_video = null;

        $cate_posts_video_id = $setting_array['home_video_block_id'];
        if($cate_posts_video_id){
            $Categories_posts_video = (new CategoryModel())->find($cate_posts_video_id);

            if($Categories_posts_video){
                $all_child_cate_id =  (new CategoryModel())
                    ->getCategoryIdRecursive($cate_posts_video_id,0,3);

                $posts = null;
                if ($all_child_cate_id[0]){
                    $posts = (new PostsModel())
                        ->whereIn('category_id', $all_child_cate_id)
                        ->where('is_lock', 0)
                        ->orderBy('updated_at', 'DESC')->findAll(10);
                }

                $Categories_posts_video->$posts = $posts;
            }
                $posts_video = $Categories_posts_video->$posts ;

        }


        // Category
        $categories = (new CategoryModel());

        $id_video = $setting_array['home_video_id'];
        $categories_video = $categories
            ->addQuery('where', ['is_lock', 0])
            ->getCategoryRecursive($id_video, 0, 2);


        /// posts_category
        $categories_menu = (new CategoryModel());

        $postsCategories = (new CategoryModel())
            ->where('is_lock',0)
            ->where('parent_id',0)
            ->findAll();


        for($i=0; $i< count($postsCategories); $i++){
            $all_child_cate_id =  (new CategoryModel())
                ->getCategoryIdRecursive($postsCategories[$i]->id,0,3);
            $posts = (new PostsModel());
            $posts_hot = $posts
                ->whereIn('category_id', $all_child_cate_id)
                ->where('is_lock', 0)
                ->orderBy('updated_at', 'DESC')->findAll(1);
            $posts_title = $posts
                ->whereIn('category_id', $all_child_cate_id)
                ->where('is_lock', 0)
                ->orderBy('updated_at', 'DESC')->findAll(6);
            $postsCategories[$i]->posts_hot = $posts_hot;
            $postsCategories[$i]->posts_title = $posts_title;
        }

        $posts_view_index = (new NewsModel())
            ->where('is_lock','0')
            ->orderBy('updated_at','DESC')
            ->findAll(7);

        return $this->render('index', [
            'sliders' => $sliders,
            'projectCategories' => $projectCategories,
            'posts_top' => $posts_top,
            'posts_new' => $posts_new,
            'newsItems' => $newsItems,
            'testimonials' => $testimonials,
            'partners' => $partners,
            'title' => $setting_array['home_meta_title'],
            'settings' => $setting_array,
            'meta_image_url' => SettingHelper::getSettingImage($setting_array['home_meta_link']),
            'user_product_vip' => $user_product_vip,
            'user_product_free' => $user_product_free,
            'new' => $new,
            'categories_video'=>$categories_video,
            'posts_video'=>$posts_video,
            'posts_hot_news'=>$posts_hot_news,
            'postsCategories'=>$postsCategories,
            'categories_menu'=>$categories_menu,
            'posts_view_index'=>$posts_view_index
        ]);
    }

    /**
     * @return string
     */
    public function search()
    {
        $query = $this->request->getGet('query');

        $model = new RouterUrlModel();
        $model
            ->where('frontend_router', 'IS NOT NULL')
            ->where('original_title', 'IS NOT NULL');
        if ($query && !empty($query)) {
            $model
                ->like('slug', StringHelper::rewrite($query))
                ->orLike('original_title', $query);
        }

        $models = new UserProductModel();
        $models
            ->where('status', 1);


        if ($query && !empty($query)) {
            $models
                ->like('title', $query)
                ->orLike('address', $query)
                ->orLike('price', $query);
        }

        return $this->render('home/search', [
            'model' => $model,
            'user_product' => $models->paginate(20),
            'pagers' => $models->pager,
            'models' => $model->paginate(20),
            'pager' => $model->pager
        ]);
    }

    /**
     * @return \CodeIgniter\HTTP\Response|string
     * @throws \ReflectionException
     */
    public function register()
    {
        if (!$this->isPost() || !($data = $this->request->getPost()) || empty($data)) {
            return $this->renderError();
        }

        $data['user_ip'] = $this->request->getIPAddress();;

        $model = new FormRequestModel();

        $fallBackUrl = ArrayHelper::getValue($data, 'ref_url', '/');

        if ($this->validate($model->getRules()) && $model->process($data)) {
            SessionHelper::getInstance()->setFlash(ContactWidget::SESSION_ALERT_KEY, [
                'type' => 'FRONT_SUCCESS',
                'message' => 'Gửi yêu cầu thành công'
            ]);
        } else {
            SessionHelper::getInstance()->setFlash(ContactWidget::SESSION_ALERT_KEY, [
                'type' => 'FRONT_ERROR',
                'message' => 'Đã có lỗi xảy ra, hãy thử lại'
            ]);
        }


        $this->send_email($data);


        return $this->response->redirect($fallBackUrl);
    }

    public function send_email($data)
    {

        require APPPATH . '../vendor/autoload.php';

        $settings = new SettingsModel();
        $settings = $settings->findAll();
        $setting_array = [];
        if ($settings) {
            foreach ($settings as $setting) {
                $setting_array[$setting->key] = $setting->value;
            }
        }

        if (!$setting_array['send_email_smtp_host']) return;

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = $setting_array['send_email_smtp_host'];                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = $setting_array['send_email_smtp_username'];                     // SMTP username
            $mail->Password = $setting_array['send_email_smtp_password'];                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = $setting_array['send_email_smtp_port'];                                    // TCP port to connect to
            $mail->setLanguage('vi');
            //Recipients
            $mail->setFrom($setting_array['send_email_smtp_username'], 'angiakhang.com');
            $mail->addAddress($setting_array['home_email'], 'Lien He');     // Add a recipient
//            $mail->addReplyTo('info@example.com', 'Information');
//            $mail->addCC('cc@example.com');
            $mail->addBCC('aman.secret.vn@gmail.com');

            // Attachments
//            $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Thong tin khach hang';
            $noi_dung = '<p>Thông tin khách hàng được gửi từ hệ thống web angiakhang.com</p>';
            $noi_dung .= '<p>Tên khách hàng: ' . $data['full_name'] . '</p>';
            $noi_dung .= '<p>Email: ' . $data['email'] . '</p>';
            $noi_dung .= '<p>Phone: ' . $data['phone'] . '</p>';
            $noi_dung .= '<p>Yêu cầu: ' . $data['request'] . '</p>';

            $mail->Body = $noi_dung;
            $mail->AltBody = 'Đây là email gửi từ web angiakhang.com';

            $mail->send();
        } catch (Exception $e) {
//            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    /**
     * @return string
     */
    public function contact()
    {
        $model = FormRequestModel::getInstance();

        $message = SessionHelper::getInstance()->getFlash(ContactWidget::SESSION_ALERT_KEY);

        $settings = new SettingsModel();
        $settings = $settings->findAll();
        $setting_array = [];
        if ($settings) {
            foreach ($settings as $setting) {
                $setting_array[$setting->key] = $setting->value;
            }
        }

        return $this->render('home/contact', [
            'model' => $model,
            'message' => $message,
            'settings' => $setting_array
        ]);
    }
}

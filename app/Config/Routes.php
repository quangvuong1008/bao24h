<?php namespace Config;

use App\Helpers\StringHelper;
use App\Models\AdministratorModel;
use App\Models\RouterUrlModel;
use CodeIgniter\Router\RouteCollection;

/**
 * --------------------------------------------------------------------
 * URI Routing
 * --------------------------------------------------------------------
 * This file lets you re-map URI requests to specific controller functions.
 *
 * Typically there is a one-to-one relationship between a URL string
 * and its corresponding controller class/method. The segments in a
 * URL normally follow this pattern:
 *
 *    example.com/class/method/id
 *
 * In some instances, however, you may want to remap this relationship
 * so that a different class/function is called than the one
 * corresponding to the URL.
 */

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 * The RouteCollection object allows you to modify the way that the
 * Router works, by acting as a holder for it's configuration settings.
 * The following methods can be called on the object to modify
 * the default operations.
 *
 *    $routes->defaultNamespace()
 *
 * Modifies the namespace that is added to a controller if it doesn't
 * already have one. By default this is the global namespace (\).
 *
 *    $routes->defaultController()
 *
 * Changes the name of the class used as a controller when the route
 * points to a folder instead of a class.
 *
 *    $routes->defaultMethod()
 *
 * Assigns the method inside the controller that is ran when the
 * Router is unable to determine the appropriate method to run.
 *
 *    $routes->setAutoRoute()
 *
 * Determines whether the Router will attempt to match URIs to
 * Controllers when no specific route has been defined. If false,
 * only routes that have been defined here will be available.
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Admin router
$routes->group(ADMIN_PATH, function (RouteCollection $routes) {
    $routes->add('/', 'App\Controllers\Admin\Home::index', ['as' => 'admin_home']);

    // Auth
    $routes->add('auth/initialize', 'App\Controllers\Admin\Auth::initialize', [
        'as' => 'admin_initialize'
    ]);
    $routes->add('auth/login', 'App\Controllers\Admin\Auth::login', [
        'as' => 'admin_login'
    ]);
    $routes->add('auth/logout', 'App\Controllers\Admin\Auth::logout', [
        'as' => 'admin_logout'
    ]);

    // Slider
    $routes->add('slider', 'App\Controllers\Admin\Slider::index', [
        'as' => 'admin_slider'
    ]);
    $routes->add('slider/create', 'App\Controllers\Admin\Slider::create', [
        'as' => 'admin_slider_create'
    ]);
    $routes->add('slider/update/(:num)', 'App\Controllers\Admin\Slider::update/$1', [
        'as' => 'admin_slider_update'
    ]);
    $routes->add('slider/delete/(:num)', 'App\Controllers\Admin\Slider::delete/$1', [
        'as' => 'admin_slider_delete'
    ]);

    // Content Category
    $routes->add('category', 'App\Controllers\Admin\Category::index', [
        'as' => 'admin_category'
    ]);
    $routes->add('category/create', 'App\Controllers\Admin\Category::create', [
        'as' => 'admin_category_create'
    ]);
    $routes->add('category/update/(:num)', 'App\Controllers\Admin\Category::update/$1', [
        'as' => 'admin_category_update'
    ]);
    $routes->add('category/delete/(:num)', 'App\Controllers\Admin\Category::delete/$1', [
        'as' => 'admin_category_delete'
    ]);

    // Posts
    $routes->add('posts', 'App\Controllers\Admin\Posts::index', [
        'as' => 'admin_posts'
    ]);
    $routes->add('posts/create', 'App\Controllers\Admin\Posts::create', [
        'as' => 'admin_posts_create'
    ]);
    $routes->add('posts/update/(:num)', 'App\Controllers\Admin\Posts::update/$1', [
        'as' => 'admin_posts_update'
    ]);
    $routes->add('posts/delete/(:num)', 'App\Controllers\Admin\Posts::delete/$1', [
        'as' => 'admin_posts_delete'
    ]);
    $routes->add('posts/meta/(:num)', 'App\Controllers\Admin\Posts::meta/$1', [
        'as' => 'admin_posts_meta'
    ]);

    // Project Category
    $routes->add('project-category', 'App\Controllers\Admin\ProjectCategory::index', [
        'as' => 'admin_project_category'
    ]);
    $routes->add('project-category/create', 'App\Controllers\Admin\ProjectCategory::create', [
        'as' => 'admin_project_category_create'
    ]);
    $routes->add('project-category/update/(:num)', 'App\Controllers\Admin\ProjectCategory::update/$1', [
        'as' => 'admin_project_category_update'
    ]);
    $routes->add('project-category/delete/(:num)', 'App\Controllers\Admin\ProjectCategory::delete/$1', [
        'as' => 'admin_project_category_delete'
    ]);

    // Project
    $routes->add('project', 'App\Controllers\Admin\Project::index', [
        'as' => 'admin_project'
    ]);
    $routes->add('project/create', 'App\Controllers\Admin\Project::create', [
        'as' => 'admin_project_create'
    ]);
    $routes->add('project/update/(:num)', 'App\Controllers\Admin\Project::update/$1', [
        'as' => 'admin_project_update'
    ]);
    $routes->add('project/delete/(:num)', 'App\Controllers\Admin\Project::delete/$1', [
        'as' => 'admin_project_delete'
    ]);

    // Product Category
    $routes->add('product-category', 'App\Controllers\Admin\ProductCategory::index', [
        'as' => 'admin_product_category'
    ]);
    $routes->add('product-category/create', 'App\Controllers\Admin\ProductCategory::create', [
        'as' => 'admin_product_category_create'
    ]);
    $routes->add('product-category/update/(:num)', 'App\Controllers\Admin\ProductCategory::update/$1', [
        'as' => 'admin_product_category_update'
    ]);
    $routes->add('product-category/delete/(:num)', 'App\Controllers\Admin\ProductCategory::delete/$1', [
        'as' => 'admin_product_category_delete'
    ]);

    // Product
    $routes->add('product', 'App\Controllers\Admin\Product::index', [
        'as' => 'admin_product'
    ]);
    $routes->add('product/create', 'App\Controllers\Admin\Product::create', [
        'as' => 'admin_product_create'
    ]);
    $routes->add('product/update/(:num)', 'App\Controllers\Admin\Product::update/$1', [
        'as' => 'admin_product_update'
    ]);
    $routes->add('product/delete/(:num)', 'App\Controllers\Admin\Product::delete/$1', [
        'as' => 'admin_product_delete'
    ]);

    // Content
    $routes->add('content', 'App\Controllers\Admin\Content::index', [
        'as' => 'admin_content'
    ]);
    $routes->add('content/create', 'App\Controllers\Admin\Content::create', [
        'as' => 'admin_content_create'
    ]);
    $routes->add('content/update/(:num)', 'App\Controllers\Admin\Content::update/$1', [
        'as' => 'admin_content_update'
    ]);
    $routes->add('content/delete/(:num)', 'App\Controllers\Admin\Content::delete/$1', [
        'as' => 'admin_content_delete'
    ]);
    $routes->add('content/meta/(:any)/(:num)', 'App\Controllers\Admin\Content::meta/$1/$2', [
        'as' => 'admin_content_meta'
    ]);

    // News
    $routes->add('news', 'App\Controllers\Admin\News::index', [
        'as' => 'admin_news'
    ]);
    $routes->add('news/create', 'App\Controllers\Admin\News::create', [
        'as' => 'admin_news_create'
    ]);
    $routes->add('news/update/(:num)', 'App\Controllers\Admin\News::update/$1', [
        'as' => 'admin_news_update'
    ]);
    $routes->add('news/delete/(:num)', 'App\Controllers\Admin\News::delete/$1', [
        'as' => 'admin_news_delete'
    ]);

    // Testimonial
    $routes->add('testimonial', 'App\Controllers\Admin\Testimonial::index', [
        'as' => 'admin_testimonial'
    ]);
    $routes->add('testimonial/create', 'App\Controllers\Admin\Testimonial::create', [
        'as' => 'admin_testimonial_create'
    ]);
    $routes->add('testimonial/update/(:num)', 'App\Controllers\Admin\Testimonial::update/$1', [
        'as' => 'admin_testimonial_update'
    ]);
    $routes->add('testimonial/delete/(:num)', 'App\Controllers\Admin\Testimonial::delete/$1', [
        'as' => 'admin_testimonial_delete'
    ]);

    // Partner
    $routes->add('partner', 'App\Controllers\Admin\Partner::index', [
        'as' => 'admin_partner'
    ]);
    $routes->add('partner/create', 'App\Controllers\Admin\Partner::create', [
        'as' => 'admin_partner_create'
    ]);
    $routes->add('partner/update/(:num)', 'App\Controllers\Admin\Partner::update/$1', [
        'as' => 'admin_partner_update'
    ]);
    $routes->add('partner/delete/(:num)', 'App\Controllers\Admin\Partner::delete/$1', [
        'as' => 'admin_partner_delete'
    ]);

    // User Request
    $routes->add('user-request', 'App\Controllers\Admin\UserRequest::index', [
        'as' => 'admin_user_request'
    ]);
    $routes->add('user-request/view/(:num)', 'App\Controllers\Admin\UserRequest::view/$1', [
        'as' => 'admin_user_request_view'
    ]);
    $routes->add('user-request/update/(:num)', 'App\Controllers\Admin\UserRequest::update/$1', [
        'as' => 'admin_user_request_update'
    ]);
    $routes->add('user-request/delete/(:num)', 'App\Controllers\Admin\UserRequest::delete/$1', [
        'as' => 'admin_user_request_delete'
    ]);

    // Shopping Cart
    $routes->add('cart', 'App\Controllers\Admin\ShoppingCart::index', [
        'as' => 'admin_cart'
    ]);
    $routes->add('cart/view/(:num)', 'App\Controllers\Admin\ShoppingCart::view/$1', [
        'as' => 'admin_cart_view'
    ]);
    $routes->add('cart/update/(:num)', 'App\Controllers\Admin\ShoppingCart::update/$1', [
        'as' => 'admin_cart_update'
    ]);
    $routes->add('cart/delete/(:num)', 'App\Controllers\Admin\ShoppingCart::delete/$1', [
        'as' => 'admin_cart_delete'
    ]);

    //setting
    $routes->add('settings', 'App\Controllers\Admin\Settings::index', [
        'as' => 'admin_setting'
    ]);
    $routes->add('settings/update', 'App\Controllers\Admin\Settings::update', [
        'as' => 'admin_settings_update'
    ]);


    // Administrator
    $routes->add('administrator', 'App\Controllers\Admin\Administrator::index', [
        'as' => 'administrator'
    ]);
    $routes->add('administrator/create', 'App\Controllers\Admin\Administrator::create', [
        'as' => 'administrator_create'
    ]);
    $routes->add('administrator/update/(:num)', 'App\Controllers\Admin\Administrator::update/$1', [
        'as' => 'administrator_update'
    ]);
    $routes->add('administrator/delete/(:num)', 'App\Controllers\Admin\Administrator::delete/$1', [
        'as' => 'administrator_delete'
    ]);

    //user_customer
    $routes->add('user-customer', 'App\Controllers\Admin\UserCustomer::index', [
        'as' => 'admin_user_customer'
    ]);
    $routes->add('user-customer/view/(:num)', 'App\Controllers\Admin\UserCustomer::view/$1', [
        'as' => 'admin_user_customer_view'
    ]);
    $routes->add('user-customer/update/(:num)', 'App\Controllers\Admin\UserCustomer::update/$1', [
        'as' => 'admin_user_customer_update'
    ]);
    $routes->add('user-customer/delete/(:num)', 'App\Controllers\Admin\UserCustomer::delete/$1', [
        'as' => 'admin_user_customer_delete'
    ]);

    //user_product
    $routes->add('user-product', 'App\Controllers\Admin\UserProduct::index', [
        'as' => 'admin_user_product'
    ]);
    $routes->add('user-product/view/(:num)', 'App\Controllers\Admin\UserProduct::view/$1', [
        'as' => 'admin_user_product_view'
    ]);
    $routes->add('user-product/update/(:num)', 'App\Controllers\Admin\UserProduct::update/$1', [
        'as' => 'admin_user_product_update'
    ]);
    $routes->add('user-product/delete/(:num)', 'App\Controllers\Admin\UserProduct::delete/$1', [
        'as' => 'admin_user_product_delete'
    ]);

    //packet
    $routes->add('packet', 'App\Controllers\Admin\Packet::index', [
        'as' => 'admin_packet'
    ]);
    $routes->add('packet/create', 'App\Controllers\Admin\Packet::create', [
        'as' => 'admin_packet_create'
    ]);
    $routes->add('packet/update/(:num)', 'App\Controllers\Admin\Packet::update/$1', [
        'as' => 'admin_packet_update'
    ]);
    $routes->add('packet/delete/(:num)', 'App\Controllers\Admin\Packet::delete/$1', [
        'as' => 'admin_packet_delete'
    ]);




});

$routes->group('cli', function (RouteCollection $routes) {

});

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index',['as'=>'home_index']);

$routes->add('/cart', 'App\Controllers\ShoppingCart::index', ['as' => 'cart']);
$routes->add('/shopping-cart/add', 'App\Controllers\ShoppingCart::add', ['as' => 'cart_add']);
$routes->add('/shopping-cart/decrement', 'App\Controllers\ShoppingCart::decrement', ['as' => 'cart_decrement']);
$routes->add('/shopping-cart/remove', 'App\Controllers\ShoppingCart::remove', ['as' => 'cart_remove']);
$routes->add('/checkout', 'App\Controllers\ShoppingCart::checkout', ['as' => 'cart_checkout']);
$routes->add('/tim-kiem', 'App\Controllers\Home::search', ['as' => 'home_search']);
$routes->add('/lien-he', 'App\Controllers\Home::contact', ['as' => 'home_contact']);

$routes->add('/dang-ky-bao-gia', 'App\Controllers\Home::register', ['as' => 'home_register']);
//$routes->add('/mau-nha-dep', 'App\Controllers\Project::index', ['as' => 'project']);
$routes->add('/cua-hang', 'App\Controllers\Product::category', ['as' => 'product']);
$routes->add('/kinh-nghiem-hay', 'App\Controllers\News::index', ['as' => 'news']);

$routes->add('/users-login', 'App\Controllers\Users::login', ['as' => 'login']);
$routes->add('/users-logout', 'App\Controllers\Users::logout', ['as' => 'logout']);
$routes->add('/users-register', 'App\Controllers\Users::register', ['as' => 'register']);
$routes->add('/user-posts-manage', 'App\Controllers\UserPostManage::userPostManage', ['as' => 'user_posts_manage']);
$routes->add('/user-posts', 'App\Controllers\UserPostManage::userPosts', ['as' => 'user_posts']);
$routes->add('/update-user-posts/(:num)', 'App\Controllers\UserPostManage::updateUserPosts/$1', ['as' => 'update_user_posts']);
$routes->add('/change-user-information', 'App\Controllers\UserPostManage::changeUserInformation', ['as' => 'change_user_information']);
$routes->add('/change-password', 'App\Controllers\UserPostManage::changePassword', ['as' => 'change_password']);
$routes->add('/get-all-link', 'App\Controllers\SiteMap::filterAllTagLinkOnPage', ['as' => 'get_all_link']);
$routes->add('/rss', 'App\Controllers\RssController::index', ['as' => 'index']);

$request = Services::request();
$slug = $request->uri->getSegment(1);
if ($slug && $slug !== ADMIN_PATH) {
    if (($config = RouterUrlModel::findBySlug($slug)) !== null) {
        $routes->add('/(:any)', 'App\Controllers\\' . $config->frontend_router . '/' . $config->object_id);
    } else {
//        $routes->add('/(:any)', 'App\Controllers\Error::code404');
    }
}


$routes->add('/([a-z0-9A-Z\-]+)-(:num)', 'App\Controllers\Product::detail/$2',['as' => 'detail_user_product']);

$routes->add('/(:num)/([a-z0-9A-Z\-]+)', 'App\Controllers\Category::detail/$1',['as' => 'detail_category']);
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

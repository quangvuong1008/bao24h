<?php

namespace App\Controllers;

use App\Helpers\StringHelper;
use App\Libraries\BaseServices;
use App\Libraries\BaseView;
use App\Models\RouterUrlModel;
use CodeIgniter\Controller;
use CodeIgniter\Router\RouteCollection;

/**
 * Class BaseController
 * @package App\Controllers
 */
class BaseController extends Controller
{
    public $layout = 'main';

    /** @var BaseView */
    protected $view;

    /** @var RouteCollection */
    protected $routes;

    /**
     * @param string $name
     * @param array $data
     * @param array $options
     * @return string
     */
    private function view(string $name, array $data = [], array $options = []): string
    {
        /** @var BaseView $renderer */
        $renderer = $this->view ?: ($this->view = BaseServices::renderer());

        $saveData = null;
        if (array_key_exists('saveData', $options) && $options['saveData'] === true) {
            $saveData = (bool)$options['saveData'];
            unset($options['saveData']);
        }

        return $renderer->setData($data, 'raw')->render($name, $options, $saveData);
    }

    /**
     * Render view content of controller
     *
     * @param $fileName
     * @param array $data
     * @param array $options
     * @return string
     */
    public function render($fileName, array $data = [], array $options = []): string
    {
        list($moduleName, $controllerName, $actionName) = array_pad($this->request->uri->getSegments(),
            3, null);

        $moduleName = $moduleName === ADMIN_PATH ? strtolower($moduleName) : 'front';

        if (strpos($fileName, '/') > -1) {
            $view = "$moduleName/$fileName";
        } else {
            $slug = $this->request->uri->getSegment(1);

            if ($slug && ($router = RouterUrlModel::findBySlug($slug)) !== null) {
                $moduleName = 'front';
                list($controllerName) = StringHelper::explode($router->frontend_router, '::');
                $controllerName = strtolower($controllerName);
            } else {
                $controllerName = !$controllerName ? 'home' : str_replace('-', '_', $controllerName);
            }

            $view = "$moduleName/$controllerName/$fileName";
        }

        if (!$this->layout) {
            return $this->view($view, $data, $options);
        }

        return $this->view("{$moduleName}/layout/{$this->layout}", [
            'title' => $this->view->title,
            'content' => $this->view($view, $data, $options),
            'request' => $this->request
        ]);
    }

    /**
     * @return string
     */
    public function renderError(): string
    {
        return $this->render('errors/html/error_404');
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return !empty($this->request->getPost());
    }
    public function check_users_login(){
        $session = session();
        $user_id = $session->get(SESSION_USER_ID_KEY);
        if(!$user_id) {
            $this->response->redirect(route_to('login'));
            return false;
        }
        return $user_id;
    }
}
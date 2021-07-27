<?php

namespace App\Libraries;

use App\Helpers\ArrayHelper;
use App\Helpers\Assets\BaseAsset;
use App\Helpers\Html;
use App\Helpers\StringHelper;
use CodeIgniter\HTTP\Request;
use CodeIgniter\View\View;
use Psr\Log\LoggerInterface;

class BaseView extends View
{
    public $title;

    protected $js = [];

    protected $css = [];

    protected $meta = [];

    public $path;

    /** @var Request */
    protected $request;

    /**
     * @var array $assets
     */
    public $assets = [];

    /**
     * {@inheritdoc}
     */
    public function __construct(\Config\View $config, $viewPath = null, $loader = null, $debug = null, LoggerInterface $logger = null)
    {
        parent::__construct($config, $viewPath, $loader, $debug, $logger);

        helper(['html']);

        if (!$this->request) {
            $this->request = service('request');
        }
    }

    /**
     *
     */
    public function head()
    {
        if (!empty($this->assets)) {
            $this->compileAssets($this->assets);
        }
        if (!empty($this->meta)) {
            echo implode("\n", array_values($this->meta)) . "\n";
        }
        $this->renderCssFiles();

    }

    /**
     *
     */
    public function registerAssets()
    {
        $this->renderJsFiles();
    }

    /**
     * @param string $name
     * @param array $data
     * @param array $options
     * @return string
     */
    public function renderView(string $name, array $data = [], array $options = []): string
    {
        $renderer = BaseServices::renderer();

        $saveData = null;
        if (array_key_exists('saveData', $options) && $options['saveData'] === true) {
            $saveData = (bool)$options['saveData'];
            unset($options['saveData']);
        }

        return $renderer->setData($data, 'raw')->render($name, $options, $saveData);
    }

    /**
     * @param string $name
     * @param array $data
     * @return string
     */
    public function import(string $name, array $data = []): string
    {
        if (!strpos($name, '/')) {
            $uri = $this->request->uri;
            if (!$uri) return $name;
            [$moduleName, $controllerName] = array_pad($this->request->uri->getSegments(), 2, null);

            $moduleName = strtolower($moduleName ?: 'front');

            $controllerName = $controllerName ? str_replace('-', '_', $controllerName) : 'home';

            $name = "{$moduleName}/{$controllerName}/{$name}";
        }
        return $this->setData($data)->render($name);
    }

    /**
     * @param array $assets
     */
    private function compileAssets(array $assets)
    {
        /** @var BaseAsset $obj */
        foreach ($assets as $asset) {
            $obj = new $asset();

            if (!empty($obj->depends)) {
                $this->compileAssets($obj->depends);
            }

            if (!empty($obj->js)) {
                foreach ($obj->js as $js) {
                    $url = $obj->createUrl($js);
                    if (!in_array($url, $this->js)) {
                        $this->js[] = $url;
                    }
                }
            }

            if (!empty($obj->css)) {
                foreach ($obj->css as $css) {
                    $url = $obj->createUrl($css);
                    if (!in_array($url, $this->css)) {
                        $this->css[] = $url;
                    }
                }
            }
        }
    }

    /**
     *
     */
    private function renderCssFiles()
    {
        if (!empty($this->css)) {
            foreach ($this->css as $css) {
                echo link_tag($css) . "\n";
            }
        }
    }

    public function registerJsFile(string $file)
    {
        array_push($this->js, $file);
    }

    /**
     *
     */
    private function renderJsFiles()
    {
        if (!empty($this->js)) {
            foreach ($this->js as $js) {
                echo script_tag($js) . "\n";
            }
        }
    }

    public function createUrl($url): string
    {
        return '';
    }

    /**
     * @param $name
     * @param $content
     */
    public function registerMetaTags($name, $content)
    {
        if (!in_array($name, $this->meta)) {
            $this->meta[$name] = Html::tag('meta', null, ['name' => $name, 'content' => $content]);
        }
    }
}
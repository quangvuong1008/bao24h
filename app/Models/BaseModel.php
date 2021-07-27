<?php

namespace App\Models;

use App\Helpers\ArrayHelper;
use App\Helpers\StringHelper;
use CodeIgniter\HTTP\Request;
use CodeIgniter\Model;

/**
 * Class BaseModel
 * @package App\Models
 *
 * @property string $slug
 */
abstract class BaseModel extends Model
{

    protected $returnType = 'array';

    protected $frontendRouter;

    /**
     * @param $rule
     * @param $value
     * @return int
     */
    private function _formatByRule($rule, $value)
    {
//        if (strpos($rule, 'integer') > -1) {
//            echo $attribute; die;
//            return (int)$value;
//        }
        return $value;
    }

    /**
     * @param array $data
     * @return mixed
     */
    private function _assign(array $data)
    {
        $className = get_called_class();

        $model = new $className();

        $rules = $this->getRules();

        $rule = null;

        foreach ($data as $attribute => $value) {
            if ($attribute === $this->primaryKey || (isset($rules[$attribute]) &&
                    ($rule = $rules[$attribute]) !== null) || in_array($attribute, $this->allowedFields)) {
                $model->$attribute = $this->_formatByRule($rule, $value);
            }
        }

        return $model;
    }

    /**
     * {@inheritdoc}
     */
    public function find($id = null)
    {
        $result = parent::find($id);

        if (!$result) return null;

        return $this->_assign($result);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param bool $activeRecord
     * @return array|null
     */
    public function findAll(int $limit = 0, int $offset = 0, bool $activeRecord = true)
    {
        $data = parent::findAll($limit, $offset);

        if (!$activeRecord) return $data;

        if (!$data || empty($data)) return null;

        return array_map(function ($item) {
            return $this->_assign($item);
        }, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function first()
    {
        $data = parent::first();

        if (!$data || empty($data)) return null;

        return $this->_assign($data);
    }

    /**
     * @param string|null $scenario
     * @return array
     */
    abstract public function getRules(string $scenario = null): array;

    /**
     * @param Request $request
     * @return bool
     */
    public function load(Request $request): bool
    {
        $this->setAttributes($request->getPost());
        return true;
    }

    /**
     * @param array $data
     */
    public function setAttributes(array $data)
    {
        $rules = array_keys($this->getRules());
        foreach ($data as $attribute => $value) {
            if (!in_array($attribute, $this->allowedFields) && !in_array($attribute, $rules)) continue;
            $this->$attribute = $value;
        }
    }

    /**
     * @return array
     */
    public function getArray(): array
    {
        $rules = $this->getRules();

        $fields = array_keys($rules);

        if (empty($fields)) return null;

        $data = [];

        foreach (array_unique(array_merge($fields, $this->allowedFields)) as $attribute) {
            $data[$attribute] = $this->_formatByRule($rules[$attribute], $this->$attribute);
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @return int
     */
    public function getPrimaryKey()
    {
        return (int)$this->{$this->primaryKey};
    }

    /**
     * @return bool
     */
    public function isNewRecord(): bool
    {
        return !$this->getPrimaryKey();
    }

    /**
     * @param Request $request
     * @param callable|null $dataCallback
     * @return null|BaseModel
     * @throws \ReflectionException
     */
    public function loadAndSave(Request $request, callable $dataCallback = null)
    {
        if (!$this->load($request) || ($data = $this->getArray()) === null) return null;

        unset($data[$this->updatedField]);
        unset($data[$this->createdField]);

        if ($dataCallback && is_callable($dataCallback)) {
            $data = call_user_func($dataCallback, $request, $data);
        }

        if (($pk = $this->getPrimaryKey()) !== 0) {
            if ($this->update($pk, $data)) {
                return $this->find($pk);
            }
            return null;
        }

        // Create
        if (($newPk = $this->insert($data)) !== null) {
            return $this->find($newPk);
        }
        return null;
    }

    /**
     * @param string $html
     * @return string
     */
    protected function removeEditorAuthor(string $html): string
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NODEFDTD);
        $xPath = new \DOMXPath($dom);
        $nodes = $xPath->query('//p[@data-f-id="pbf"]');
        if ($nodes->item(0)) {
            $nodes->item(0)->parentNode->removeChild($nodes->item(0));
        }
        $result = $dom->saveHTML($dom->documentElement);
        return preg_replace('~<(?:!DOCTYPE|/?(?:html|head|body))[^>]*>\s*~i', '', $result);
    }

    /**
     * Logging author
     *
     * @param array $data
     * @return array
     */
    public function authorLog(array $data)
    {
        $identity = AdministratorModel::findIdentity();
        if (!$identity) return $data;

        // Temp: Remove editor author tag
        if (($intro = ArrayHelper::getValue($data, ['data', 'intro'])) !== null && !empty($intro)) {
            $data['data']['intro'] = $this->removeEditorAuthor($intro);
        }
        if (($content = ArrayHelper::getValue($data, ['data', 'content'])) !== null && !empty($content)) {
            $data['data']['content'] = $this->removeEditorAuthor($content);
        }

        if ($this->isNewRecord()) {
            $data['data']['author_id'] = $identity->getPrimaryKey();
        } else {
            $data['data']['modifier_id'] = $identity->getPrimaryKey();
        }

        return $data;
    }

    /**
     * @param array $data
     * @return array
     * @throws \ReflectionException
     */
    public function instanceUrl(array $data)
    {
        $slug = ArrayHelper::getValue($data, ['data', 'data', 'slug']);

        // $isNewRecord = false;
        $pk = (int)ArrayHelper::getValue($data, [$this->primaryKey, 0]);

        if (!$pk) {
            // $isNewRecord = true;
            $pk = (int)ArrayHelper::getValue($data, [$this->primaryKey]);
        }

        if (!$slug || empty($data) || !$this->frontendRouter || !$pk) {

            return $data;
        }

        $objectName = get_called_class();

        $originalTitle = ArrayHelper::getValue($data, ['data', 'data', 'title']);
        $originalImage = ArrayHelper::getValue($data, ['data', 'data', 'image']);

        /** @var RouterUrlModel $model */
        $model = (new RouterUrlModel())
            ->where('object_id', $pk)
            ->where('object_name', $objectName)
            ->first();

        if (!$model) {
            $newModel = new RouterUrlModel();
            $newModel->insert([
                'slug' => $slug, 'object_name' => $objectName, 'object_id' => $pk,
                'frontend_router' => $this->frontendRouter, 'original_title' => $originalTitle,
                'original_image' => $originalImage
            ], false);
        } else {
            $model->update($model->getPrimaryKey(), [
                'slug' => $slug, 'frontend_route' => $this->frontendRouter,
                'original_title' => $originalTitle,// ?: $model->original_title,
                'original_image' => $originalImage,// ?: $model->original_image,
            ]);
        }

        return $data;
    }

    /**
     * @param array $data
     * @return array
     */
    public function removeUrl(array $data)
    {
        if (!($pk = ArrayHelper::getValue($data, [$this->primaryKey, 0]))) return $data;

        $className = get_called_class();

        $model = RouterUrlModel::getInstance($className, $pk);

        if (!$model) return $data;

        $model->delete($model->getPrimaryKey());

        return $data;
    }
}
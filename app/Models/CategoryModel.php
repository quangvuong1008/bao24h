<?php

namespace App\Models;

use App\Helpers\StringHelper;
use App\Models\Interfaces\ContentInterface;
use App\Models\Interfaces\ImageAssetInterface;
use App\Models\Interfaces\UrlInterface;

/**
 * Class ContentCategoryModel
 * @package App\Models
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property string $slug
 * @property string $image
 * @property string $intro
 * @property int $is_lock
 * @property int $created_at
 * @property int $updated_at
 *
 * @property int $level
 * @property CategoryModel[] $children
 */
class CategoryModel extends BaseModel implements ContentInterface, ImageAssetInterface, UrlInterface
{
    protected $table = 'category';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['title', 'slug', 'parent_id', 'image', 'intro', 'is_lock', 'created_at', 'updated_at','menu_order'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $dateFormat = 'int';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $beforeInsert = ['updateSlug', 'authorLog'];
    protected $beforeUpdate = ['updateSlug', 'authorLog'];

    protected $frontendRouter = 'Category::index';
    protected $afterInsert = ['instanceUrl'];
    protected $afterUpdate = ['instanceUrl'];
    protected $afterDelete = ['removeUrl'];

    private $_query = [];

    /**
     * @param int|null $page
     * @return string
     */
    public function getUpdateUrl(int $page = null): string
    {
        return route_to('admin_category_update', $this->getPrimaryKey(), $page);
    }

    /**
     * @param array $data
     * @return array
     */
    public function updateSlug(array $data): array
    {
        if (!isset($data['data']['slug']) || empty($data['data']['slug'])) {
            // Create 'slug' if not exists
            $data['data']['slug'] = $data['data']['title'];
        }
        $data['data']['slug'] = StringHelper::rewrite($data['data']['slug']);
        return $data;
    }

    private static $_cached;

    /**
     * @param array $query
     * @return CategoryModel[]
     */
    public static function getItems(array $query = [])
    {
        if (!static::$_cached) {
            $model = new static();

            if (!empty($query)) {
                foreach ($query as $method => $value) {
                    list($attr, $cond) = $value;
                    $model->$method($attr, $cond);
                }
            }
            static::$_cached = $model->findAll();
        }
        return static::$_cached;
    }

    /**
     * @param string $key
     * @param array $value
     * @return $this
     */
    public function addQuery(string $key, array $value = [])
    {
        $this->_query[$key] = $value;
        return $this;
    }

    public function get_items_of_cate(array $query = [])
    {
        if (!empty($query)) {
            foreach ($query as $method => $value) {
                list($attr, $cond) = $value;
                $this->$method($attr, $cond);
            }
        }
        return $this->findAll();
    }

    /**
     * @param int $parentId
     * @param int $level
     * @param int|null $maxLevel
     * @return array
     */
    public function getCategoryRecursive($parentId = 0, $level = 0, int $maxLevel = null): array
    {
        $items = self::getItems($this->_query);
        if (!$items) return [];

        $result = [];
        foreach ($items as $item) {
            if ($item->parent_id == $parentId) {
                $item->level = $level;
                $children = (!$maxLevel || $level < $maxLevel) ?
                    $this->getCategoryRecursive((int)$item->id, $level + 1, $maxLevel) : null;
                if ($children && !empty($children)) {
                    $item->children = $children;
                }
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * @param array $result
     * @param int $parentId
     * @param int $level
     * @return array
     */
    public function getCategoryOptions(array &$result = [], int $parentId = 0, $level = 0): array
    {
        $items = self::getItems($this->_query);
        if (!$items) return [];

        if ($level === 0) {
            $result = [0 => 'DANH MỤC GỐC'];
        }
        foreach ($items as $item) {
            if ($item->parent_id == $parentId) {
                $result[$item->id] = str_repeat('-- ', $level + 1) . $item->title;
                $children = $this->getCategoryOptions($result, $item->id, $level + 1);
                if (!empty($children)) {
                    $result = $children;
                }
            }
        }

        return $result;
    }

    /* menu_order */
    public function getCategoryRecursive_menu($parentId = 0, $level = 0, int $maxLevel = null): array
    {
        $items = $this->get_items_of_cate($this->_query);
        if (!$items) return [];

        $result = [];
        foreach ($items as $item) {
            if ($item->parent_id == $parentId) {
                $item->level = $level;
                $children = (!$maxLevel || $level < $maxLevel) ?
                    $this->getCategoryRecursive_menu((int)$item->id, $level + 1, $maxLevel) : null;
                if ($children && !empty($children)) {
                    $item->children = $children;
                }
                $result[] = $item;
            }
        }

        return $result;
    }


    public function getCategoryIdRecursive($parentId = 0, $level = 0, int $maxLevel = null): array
    {
        $items = self::getItems($this->_query);
        if (!$items) return [];

        $result = [];
        $result[] = strval($parentId);
        foreach ($items as $item) {
            if ($item->parent_id == $parentId) {
                $item->level = $level;
                $childrens = (!$maxLevel || $level < $maxLevel) ?
                    $this->getCategoryRecursive((int)$item->id, $level + 1, $maxLevel) : null;
                if ($childrens && !empty($childrens)) {
                    foreach ($childrens as $child){
                        $result[] = $child->id;
                    }
                }

                $result[] = $item->id;
            }
        }

        return $result;
    }
    /**
     * @return null|string
     */
    public function getImage(): string
    {
        if (!$this->image || empty($this->image)) return '/images/empty.jpg';

        return base_url("uploads/category/{$this->image}");
    }

    /**
     * @param array $contents
     * @throws \ReflectionException
     */
    public function saveContents(array $contents)
    {
        $no = 0;
        foreach ($contents as $pk => $content) {
            $model = new ObjectContentModel();
            if (is_int($pk)) {
                $content['id'] = $pk;
            }
            $content['order_no'] = $no;
            $no++;
            $content['object_name'] = $this->table;
            $content['object_id'] = $this->getPrimaryKey();
            $model->setAttributes($content);
            if (!$model->save($content)) {
                throw new \Exception('Đã có lỗi xảy ra khi lưu nội dung');
            }
        }
    }

    /**
     * @return ObjectContentModel[]
     */
    public function getContents()
    {
        return (new ObjectContentModel())
            ->where('object_name', $this->table)
            ->where('object_id', $this->getPrimaryKey())
            ->orderBy('order_no', SORT_ASC)
            ->findAll();
    }

    /**
     * @param string|null $scenario
     * @return array
     */
    public function getRules(string $scenario = null): array
    {
        return [
            'title' => 'required|min_length[3]|max_length[255]',
            'slug' => 'max_length[255]',
            'parent_id' => 'integer',
            'image' => 'max_length[255]',
            'contents' => 'array[title,content]',
            'menu_order' =>'integer',
        ];
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return base_url($this->slug);
    }

    /**
     * @param int $targetId
     * @param array $result
     * @param int $level
     * @return array
     */
    public function breadcrumbs(int $targetId, array &$result = [], $level = 0): array
    {

        $items = self::getItems($this->_query);
        if (!$items) return [];

        foreach ($items as $model) {
            if ($model->getPrimaryKey() === $targetId) {
                // Add item to first of array
                array_unshift($result, !$level ? (['label' => $model->title, 'url' => $model->getUrl()]) : [
                    'label' => $model->title, 'url' => $model->getUrl()
                ]);
                $this->breadcrumbs($model->parent_id, $result, $level + 1);
                break;
            }
        }

        return $result;
    }
}
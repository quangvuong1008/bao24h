<?php

namespace App\Models;


use App\Helpers\StringHelper;
use App\Models\Interfaces\ImageAssetInterface;
use App\Models\Interfaces\UrlInterface;
use App\Models\ProductModel;

/**
 * Class ProjectCategoryModel
 * @package App\Models
 *
 * @property string $title
 * @property string $slug
 * @property int $parent_id
 * @property int $is_lock
 * @property string $intro
 * @property string $image
 * @property ProductCategoryModel[] $children
 * @property ProductModel[] $product
 */
class ProductCategoryModel extends BaseModel implements ImageAssetInterface, UrlInterface
{
    protected $table = 'product_category';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['title', 'slug', 'image', 'intro', 'is_lock','parent_id','menu_order'];

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

    protected $frontendRouter = 'Product::index';
    protected $afterInsert = ['instanceUrl'];
    protected $afterUpdate = ['instanceUrl'];
    protected $afterDelete = ['removeUrl'];
    private $_query = [];
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
     * @return CategoryModel[]
     */
//    public static function getItems()
//    {
//        if (!static::$_cached) {
//            $model = new static();
//            static::$_cached = $model->findAll();
//        }
//        return static::$_cached;
//    }
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

    /**
     * @param array $result
     * @param int $parentId
     * @param int $level
     * @return array
     */
//    public function getCategoryOptions(array &$result = [], int $parentId = 0, $level = 0): array
//    {
//        $items = self::getItems();
//        if (!$items) return [0 => 'DANH MỤC GỐC'];
//
//
//        if ($level === 0) {
//            $result = [0 => 'DANH MỤC GỐC'];
//        }
//        foreach ($items as $item) {
//            if ((int)$item->parent_id === $parentId) {
//                $result[$item->id] = str_repeat('-- ', $level + 1) . $item->title;
//            }
//        }
//
//        return $result;
//    }

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
    /**
     * @return string
     */
    public function getImage(): string
    {
        if (!$this->image || empty($this->image)) return '/images/empty.jpg';

        return base_url("uploads/category/{$this->image}");
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
            'image' => 'max_length[255]',
        ];
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return base_url($this->slug);
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


    public function select_product_category_id($parent_id){
        return $this->db->query('SELECT * FROM product_category WHERE parent_id = ?',[$parent_id])->getResultArray();
    }
}
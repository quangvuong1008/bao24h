<?php

namespace App\Models;


use App\Helpers\StringHelper;
use App\Models\Interfaces\ImageAssetInterface;
use App\Models\Interfaces\UrlInterface;

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
 * @property int $created_at
 * @property int $updated_at
 */
class ProjectCategoryModel extends BaseModel implements UrlInterface, ImageAssetInterface
{
    protected $table = 'project_category';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['title', 'slug', 'parent_id', 'intro', 'is_lock', 'image', 'created_at', 'updated_at'];

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

    protected $frontendRouter = 'Project::category';
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
        if (!$items) return [0 => 'DANH MỤC GỐC'];


        if ($level === 0) {
            $result = [0 => 'DANH MỤC GỐC'];
        }
        foreach ($items as $item) {
            if ((int)$item->parent_id === $parentId) {
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
     * @param string|null $scenario
     * @return array
     */
    public function getRules(string $scenario = null): array
    {
        return [
            'title' => 'required|min_length[3]|max_length[255]|trim',
            'slug' => 'max_length[255]',
//            'parent_id' => 'integer',
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
     * @return string
     */
    public function getImage(): string
    {
        if (!$this->image || empty($this->image)) return '/images/empty.jpg';

        return base_url("uploads/project/{$this->image}");
    }
}
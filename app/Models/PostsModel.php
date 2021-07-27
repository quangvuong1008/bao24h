<?php

namespace App\Models;

use App\Helpers\StringHelper;
use App\Models\Interfaces\ContentInterface;
use App\Models\Interfaces\ImageAssetInterface;
use App\Models\Interfaces\UrlInterface;

/**
 * Class NewsModel
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $category_id
 * @property string $image
 * @property string $intro
 * @property int $is_hot
 * @property int $is_lock
 */
class PostsModel extends BaseModel implements ImageAssetInterface, ContentInterface, UrlInterface
{
    protected $table = 'posts';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['id', 'title', 'slug', 'category_id', 'intro','meta_title',
        'meta_keywords',
        'meta_description',
        'image', 'is_lock', 'created_at', 'updated_at'];

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

//    protected $frontendRouter = 'Category::detail';
//    protected $afterInsert = ['instanceUrl'];
//    protected $afterUpdate = ['instanceUrl'];
//    protected $afterDelete = ['removeUrl'];

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

    /**
     * @return string
     */
    public function getImage(): string
    {
        if (!$this->image || empty($this->image)) return '/images/empty.jpg';

        return base_url("uploads/content/{$this->image}");
    }

    /**
     * @return ObjectContentModel[]|null
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
     * @param string|null $scenario
     * @return array
     */
    public function getRules(string $scenario = null): array
    {
        return [
            'title' => 'required|min_length[3]|max_length[255]',
            'image' => 'max_length[255]',
            'contents' => 'array[title,content]',
        ];
    }

    public function getCategoryOptions()
    {
        return (new CategoryModel())->getCategoryOptions();
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return base_url($this->id . '/' . $this->slug);
    }

    /**
     * @return string
     */
    public function select_category_id()
    {
        $category_id_db = $this->db->query('SELECT title FROM category WHERE id = ?', [$this->category_id])->getRow();
        if ($category_id_db) {
            return $category_id_db->title;
        }
        return '';
    }

    public function update_meta($id, $meta_title, $meta_keywords, $meta_description)
    {
        return $this->db->query('UPDATE `posts` SET meta_title= ? , meta_keywords = ? , meta_description = ? WHERE id = ?' , [
                $meta_title, $meta_keywords, $meta_description, $id
            ]);
    }
}
<?php

namespace App\Models;

use App\Helpers\StringHelper;
use App\Models\Interfaces\ContentInterface;
use App\Models\Interfaces\ImageAssetInterface;
use App\Models\Interfaces\UrlInterface;

/**
 * Class ProjectModel
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $category_id
 * @property string $image
 * @property string $intro
 * @property int $is_lock
 * @property int $created_at
 * @property int $updated_at
 */
class ProjectModel extends BaseModel implements ImageAssetInterface, ContentInterface, UrlInterface
{
    protected $table = 'project';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['title', 'slug', 'category_id', 'intro', 'image', 'is_lock', 'created_at', 'updated_at'];

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

    protected $frontendRouter = 'Project::detail';
    protected $afterInsert = ['instanceUrl'];
    protected $afterUpdate = ['instanceUrl'];
    protected $afterDelete = ['removeUrl'];

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
     * @return array
     */
    public function getCategoryOptions(): array
    {
        return (new ProjectCategoryModel())->getCategoryOptions();
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        if (!$this->image || empty($this->image)) return '/images/empty.jpg';

        return base_url("uploads/project/{$this->image}");
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
            'slug' => 'max_length[255]',
            'category_id' => 'required|integer',
            'image' => 'max_length[255]',
            'contents' => 'array[title,content]',
        ];
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return base_url($this->slug);
    }
}
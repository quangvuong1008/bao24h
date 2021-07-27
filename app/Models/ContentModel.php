<?php

namespace App\Models;


use App\Helpers\StringHelper;
use App\Models\Interfaces\ContentInterface;
use App\Models\Interfaces\ImageAssetInterface;

/**
 * Class ContentCategoryModel
 * @package App\Models
 *
 * @property string $title
 * @property string $slug
 * @property int $category_id
 * @property string $intro
 * @property string $content
 * @property string $image
 * @property string $material
 * @property string $guarantee
 * @property int $price
 * @property int $discount
 * @property int $is_lock
 */
class ContentModel extends BaseModel implements ImageAssetInterface
{
    protected $table = 'content';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['title', 'slug', 'image', 'intro', 'content', 'is_lock'];

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


    protected $frontendRouter = 'Content::detail';
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
     * @return string
     */
    public function getImage(): string
    {
        if (!$this->image || empty($this->image)) return '/images/empty.jpg';

        return base_url("uploads/content/{$this->image}");
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
}
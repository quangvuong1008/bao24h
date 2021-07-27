<?php

namespace App\Models;

use App\Helpers\StringHelper;
use App\Models\Interfaces\ContentInterface;

/**
 * Class CategoryContentModel
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $object_name
 * @property int $object_id
 */
class ObjectContentModel extends BaseModel
{
    protected $table = 'object_content';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['title', 'slug', 'object_name', 'object_id', 'content', 'order_no'];

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
     * @param string|null $scenario
     * @return array
     */
    public function getRules(string $scenario = null): array
    {
        return [
            'title' => 'required|min_length[3]|max_length[255]',
            'object_name' => 'required|min_length[3]|max_length[40]',
            'slug' => 'max_length[255]',
            'order_no' => 'integer'
        ];
    }
}
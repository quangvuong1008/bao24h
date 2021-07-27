<?php

namespace App\Models;

use App\Models\Interfaces\ImageAssetInterface;
use App\Models\Interfaces\UrlInterface;

/**
 * Class RouterUrlModel
 * @package App\Models
 *
 * @property string $object_name
 * @property int $object_id
 * @property string $frontend_router
 * @property string $original_title
 * @property string $original_image
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 */
class RouterUrlModel extends BaseModel implements ImageAssetInterface, UrlInterface
{
    protected $table = 'router_url';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'slug', 'object_name', 'object_id', 'frontend_router', 'original_title', 'original_image', 'auto_description',
        'meta_title', 'meta_keywords', 'meta_description'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $dateFormat = 'int';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $beforeInsert = ['authorLog'];
    protected $beforeUpdate = ['authorLog'];

    /**
     * @param string|null $scenario
     * @return array
     */
    public function getRules(string $scenario = null): array
    {
        return [];
    }

    /**
     * @param $objectName
     * @param $objectId
     * @return RouterUrlModel|null
     */
    public static function getInstance($objectName, $objectId)
    {
        /** @var static $model */
        $model = (new static())
            ->where('object_name', $objectName)->where('object_id', $objectId)->first();

        if ($model && !$model->isNewRecord()) return $model;

        $model = new static();
        $data = [];
        $data['object_name'] = $objectName;
        $data['object_id'] = $objectId;

        if (($newPk = $model->save($data)) !== null) {
            return $model->find($newPk);
        }
        return null;
    }

    /**
     * @param string $slug
     * @return null|RouterUrlModel
     */
    public static function findBySlug(string $slug)
    {
        return (new static())->where('slug', trim($slug))->first();
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        if (!$this->original_image || empty($this->original_image)) return '/images/empty.jpg';

        switch ($this->object_name) {
            case (CategoryModel::class):
                return base_url("uploads/category/{$this->original_image}");
            case (ProjectCategoryModel::class):
            case (ProjectModel::class):
                return base_url("uploads/project/{$this->original_image}");
            case (ProductCategoryModel::class):
            case (ProductModel::class):
                return base_url("uploads/product/{$this->original_image}");
            case (NewsModel::class):
            case (ContentModel::class):
                return base_url("uploads/content/{$this->original_image}");
        }

        return '';
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return base_url($this->slug);
    }
}
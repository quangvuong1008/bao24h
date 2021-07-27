<?php

namespace App\Models;

use App\Helpers\SessionHelper;

/**
 * Class FormRequestModel
 * @package App\Models
 *
 * @property string $full_name
 * @property string $email
 * @property string $phone
 * @property string $request
 * @property string $ref_url
 * @property int $is_done
 * @property int $created_at
 */
class FormRequestModel extends BaseModel
{
    protected $table = 'form_request';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'full_name', 'email', 'request', 'phone', 'ref_url', 'user_ip', 'is_done', 'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $dateFormat = 'int';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    const SES_KEY = 'FORM_REGISTER';

    /**
     * @param string|null $scenario
     * @return array
     */
    public function getRules(string $scenario = null): array
    {
        return [
            'full_name' => 'required|min_length[3]|max_length[255]',
            //'email' => 'required|min_length[3]|max_length[255]',
            'phone' => 'required|min_length[3]|max_length[255]',
        ];
    }

    /**
     * Use this for widget model
     *
     * @return FormRequestModel
     */
    public static function getInstance()
    {
        $model = new static();
        $prevData = SessionHelper::getInstance()->get(static::SES_KEY);
        if ($prevData) {
            $model->setAttributes($prevData);
        }
        return $model;
    }

    /**
     * @param array $data
     * @return bool
     * @throws \ReflectionException
     */
    public function process(array $data): bool
    {
        // Save to session if submit fail
        SessionHelper::getInstance()->set(self::SES_KEY, $data);

        if(strpos($data['phone'],'0') !== 0){
            return false;
        }
        if(strpos($data['phone'],'http') !== false || strpos($data['request'],'http') !== false
            || strpos($data['request'],'sex') !== false){
            return false;
        }

        if (!$this->insert($data)) {
            return false;
        }

        // Clear data from session
        SessionHelper::getInstance()->remove(self::SES_KEY);

        // TODO: Sent email to both of client and admin


        return true;
    }
}
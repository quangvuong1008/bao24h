<?php

namespace App\Models;

use App\Helpers\ArrayHelper;
use App\Helpers\SessionHelper;
use App\Helpers\StringHelper;
use App\Models\Interfaces\IdentityInterface;

/**
 * Class AdministratorModel
 * @package App\Models
 *
 * @property int $id
 * @property string $account_name
 * @property string $password_hash
 * @property string $full_name
 * @property string $avt
 * @property int $type
 * @property int $is_lock
 *
 * @property int $login_after_init
 */
class AdministratorModel extends BaseModel implements IdentityInterface
{
    protected $table = 'administrator';
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'full_name', 'account_name', 'password_hash', 'password_salt', 'is_lock', 'login_after_init', 'avt'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $dateFormat = 'int';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $beforeInsert = ['createAvt'];
    protected $beforeUpdate = ['createAvt'];

    /** @var AdministratorModel $_user */
    protected static $_user;

    const LOGIN_KEY = 'PANDA_ADMIN';

    const TYPE_ADMIN = 1;
    const TYPE_MEMBER = 0;


    /**
     * @param array $data
     * @return array
     */
    public function createAvt(array $data): array
    {
        $fullName = ArrayHelper::getValue($data, ['data', 'full_name']);
        if ($fullName && !empty($fullName)) {
            $paths = StringHelper::explode(trim($fullName), ' ');
            $endPath = $paths[count($paths) - 1];
            $data['data']['avt'] = strtoupper($endPath[0]);
        }
        return $data;
    }

    /**
     * @param $password
     * @return string
     */
    public static function createPasswordHash($password): string
    {
        $options = [
            'salt' => 'your_custom_function_for_salt',
            'cost' => 12
        ];
        return password_hash($password, PASSWORD_DEFAULT, $options);
    }

    /**
     * @return bool
     */
    public function login(): bool
    {
        SessionHelper::getInstance()->set(self::LOGIN_KEY, [
            'id' => $this->getPrimaryKey(),
            'account_name' => $this->account_name
        ]);

        return ($data = SessionHelper::getInstance()->get(self::LOGIN_KEY)) !== null && !empty($data);
    }

    /**
     *
     */
    public function logout()
    {
        SessionHelper::getInstance()->remove(self::LOGIN_KEY);
    }

    /**
     * @return null|AdministratorModel|object
     */
    public static function findIdentity()
    {
        if (($data = SessionHelper::getInstance()->get(static::LOGIN_KEY)) === null
            || empty($data) || !($id = ArrayHelper::getValue($data, 'id'))) return null;

        return (new static())->where('is_lock', 0)->find($id);
    }

    /**
     * @param $password
     * @return bool
     */
    public function validatePasswordHash($password): bool
    {
        if (empty($password)) return false;
        return password_verify($password, $this->password_hash);
    }


    /**
     * @param string $accountName
     * @return AdministratorModel|null
     */
    public static function findByUsername($accountName)
    {
        if (static::$_user && static::$_user->account_name === $accountName) return static::$_user;

        /** @var AdministratorModel $model */
        $model = (new static())
            ->where('account_name', trim($accountName))
            ->where('is_lock', 0)
            ->first();

        if (!$model) return null;

        static::$_user = $model;
        return $model;
    }

    /**
     * @param string $scenario
     * @return array
     */
    private function getRulesByScenario(string $scenario): array
    {
        $scenarios = [
            'update' => [
                'full_name' => 'required|min_length[3]|max_length[50]',
                'account_name' => 'required|min_length[3]|max_length[50]',
                'password' => 'max_length[255]',
            ]
        ];

        return ArrayHelper::getValue($scenarios, $scenario);
    }

    /**
     * @param string|null $scenario
     * @return array
     */
    public function getRules(string $scenario = null): array
    {
        if ($scenario && ($data = $this->getRulesByScenario($scenario))) {
            return $data;
        }
        return [
            'full_name' => 'required|min_length[3]|max_length[50]',
            'account_name' => 'required|min_length[3]|max_length[50]',
            'password_hash' => 'max_length[255]',
            'password_salt' => 'max_length[255]',
            'password' => 'min_length[6]|max_length[255]',
            'avt' => 'max_length[2]',
        ];
    }
}
<?php

namespace App\Models\Forms;

use App\Models\AdministratorModel;
use App\Models\Interfaces\IdentityInterface;

/**
 * Class AdminLoginModel
 * @package App\Models\Forms
 *
 * @property string $account_name
 * @property string $account_password
 */
class AdminLoginModel extends BaseFormModel implements IdentityInterface
{
    /** @var AdministratorModel */
    private $_user;

    /**
     * @return array
     */
    public function getRules(): array
    {
        return [
            'account_name' => [
                'label' => 'Tên đăng nhập',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} không được để trống.'
                ]
            ],
            'account_password' => [
                'label' => 'Mật khẩu',
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} không được để trống.'
                ]
            ],
        ];
    }

    /**
     * @return AdminLoginModel
     */
    public function bindAdminAccount()
    {
        if (!$this->account_name) return null;

        if ($this->_user && $this->_user->account_name === trim($this->account_name)) return $this;

        $this->_user = self::findByUsername(trim($this->account_name));
        return $this;
    }

    /**
     * @param string $username
     * @return IdentityInterface
     */
    public static function findByUsername(string $username)
    {
        return AdministratorModel::findByUsername($username);
    }

    /**
     * @return IdentityInterface|null
     */
    public static function findIdentity()
    {
        return AdministratorModel::findIdentity();
    }

    /**
     * @return bool
     */
    public function login(): bool
    {
        if (!$this->account_name || !$this->account_password || !$this->_user) return false;

        // Validate password
        if (!$this->_user->validatePasswordHash($this->account_password)) return false;

        return $this->_user->login();
    }

    /**
     * @return void
     */
    public function logout()
    {

    }

    /**
     * @param $password
     * @return string
     */
    public static function createPasswordHash($password): string
    {
        return null;
    }

    /**
     * @param $password
     * @return bool
     */
    public function validatePasswordHash($password): bool
    {
        return false;
    }
}
<?php

namespace App\Models\Interfaces;


interface IdentityInterface
{
    /**
     * @param string $username
     * @return IdentityInterface
     */
    public static function findByUsername(string $username);

    /**
     * @return IdentityInterface|null
     */
    public static function findIdentity();

    /**
     * @return bool
     */
    public function login(): bool;

    /**
     * @return void
     */
    public function logout();

    /**
     * @param $password
     * @return string
     */
    public static function createPasswordHash($password): string;

    /**
     * @param $password
     * @return bool
     */
    public function validatePasswordHash($password): bool;
}
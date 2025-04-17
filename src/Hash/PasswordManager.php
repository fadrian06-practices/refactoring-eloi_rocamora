<?php

declare(strict_types=1);

namespace FasLatam\Hash;

interface PasswordManager
{
    public const string SALT = 'ilovecodeofninjabymikedalisay';

    public function checkPassword($passdb, $passtocheck);

    public function hashPassword($pass);
}

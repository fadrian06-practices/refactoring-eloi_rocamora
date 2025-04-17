<?php

declare(strict_types=1);

namespace FasLatam\Hash;

interface PasswordManager
{
    const SALT = 'ilovecodeofninjabymikedalisay';

    public function checkPassword($passdb, $passtocheck);

    public function hashPassword($pass);
}

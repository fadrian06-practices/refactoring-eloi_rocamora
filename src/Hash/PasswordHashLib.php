<?php

declare(strict_types=1);

namespace FasLatam\Hash;

use FasLatam\Exceptions\UserNotExistsException;

class PasswordHashLib implements PasswordManager
{
    public function checkPassword($passdb, $passtocheck): void
    {
        $saltedPostedPassword = self::SALT . $passtocheck;
        $check = password_verify($saltedPostedPassword, (string) $passdb);

        if (!$check) {
            throw new UserNotExistsException();
        }
    }

    public function hashPassword($pass): string
    {
        $pass = self::SALT . $pass;
        return password_hash($pass, PASSWORD_DEFAULT);
    }
}

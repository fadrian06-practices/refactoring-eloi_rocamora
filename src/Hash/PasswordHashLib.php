<?php

namespace FasLatam\Hash;

use FasLatam\Exceptions\UserNotExistsException;

class PasswordHashLib implements PasswordManager
{
    public function checkPassword($passdb, $passtocheck)
    {
        $saltedPostedPassword = self::SALT.$passtocheck;
        $check= password_verify($saltedPostedPassword, $passdb);

        if (!$check) {
            throw new UserNotExistsException;
        }
    }

    public function hashPassword($pass)
    {
        $pass= self::SALT.$pass;
        return password_hash($pass, PASSWORD_DEFAULT);
    }
}

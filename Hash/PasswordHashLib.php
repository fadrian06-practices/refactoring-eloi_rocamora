<?php

namespace Hash;
use Exceptions\UserNotExistsException;


class PasswordHashLib implements  PasswordManager{
    public function checkPassword($passdb, $passtocheck)
    {
        $saltedPostedPassword = SELF::SALT.$passtocheck;
        $check= password_verify($saltedPostedPassword,$passdb);

        if (!$check) {
            throw new UserNotExistsException;
        }

    }

    public function hashPassword($pass)
    {
        $pass= SELF::SALT.$pass;
        return password_hash($pass,PASSWORD_DEFAULT);
    }


}

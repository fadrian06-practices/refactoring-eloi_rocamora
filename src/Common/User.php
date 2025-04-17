<?php

declare(strict_types=1);

namespace FasLatam\Common;

class User
{
    private $email;

    private $password;

    /** @return mixed ... */
    public function getEmail()
    {
        return $this->email;
    }

    /** @param mixed $email */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /** @return mixed ... */
    public function getPassword()
    {
        return $this->password;
    }

    /** @param mixed $password .... */
    public function setPassword($password): void
    {
        $this->password = $password;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 24/5/15
 * Time: 16:43
 */

namespace Common;


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
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /** @return mixed ... */
    public function getPassword()
    {
        return $this->password;
    }

    /** @param mixed $password .... */
    public function setPassword($password)
    {
        $this->password = $password;
    }


}

<?php

namespace FasLatam\UsersCont;

use FasLatam\Database\DatabaseRepository;
use FasLatam\Common\User;
use FasLatam\Hash\PasswordManager;

class UsersManager
{
    private $dm;
    private $pm;

    function __construct(DatabaseRepository $dm, PasswordManager $pm)
    {
        $this->dm = $dm;
        $this->pm = $pm;
    }

    public function checkRegisteredUser($email, $passwd)
    {
        try {
            $user = new User();
            $user->setEmail($email);
            $user = $this->dm->getUser($user);
            $this->pm->checkPassword($user->getPassword(), $passwd);

        } catch (\PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }

    }

    public function registerNewUser($email, $passwd)
    {
        try {
            $password = $this->pm->hashPassword($passwd);
            $user = new User();
            $user->setPassword($password);
            $user->setEmail($email);
            $this->dm->insertUser($user);
        } catch (\PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }
    }
}

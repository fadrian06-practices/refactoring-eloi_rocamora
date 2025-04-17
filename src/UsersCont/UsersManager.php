<?php

namespace FasLatam\UsersCont;

use FasLatam\Database\DatabaseRepository;
use FasLatam\Common\User;
use FasLatam\Hash\PasswordManager;

class UsersManager
{
    public function __construct(private readonly DatabaseRepository $dm, private readonly PasswordManager $pm)
    {
    }

    public function checkRegisteredUser($email, $passwd): void
    {
        try {
            $user = new User();
            $user->setEmail($email);
            $user = $this->dm->getUser($user);
            $this->pm->checkPassword($user->getPassword(), $passwd);
        } catch (\PDOException $pdoException) {
            echo "Error: " . $pdoException->getMessage();
        }
    }

    public function registerNewUser($email, $passwd): void
    {
        try {
            $password = $this->pm->hashPassword($passwd);
            $user = new User();
            $user->setPassword($password);
            $user->setEmail($email);
            $this->dm->insertUser($user);
        } catch (\PDOException $pdoException) {
            echo "Error: " . $pdoException->getMessage();
        }
    }
}

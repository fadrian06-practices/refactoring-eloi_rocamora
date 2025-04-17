<?php

declare(strict_types=1);

namespace FasLatam\UsersCont;

use FasLatam\Database\DatabaseRepository;
use FasLatam\Common\User;
use FasLatam\Hash\PasswordManager;

class UsersManager
{
    public function __construct(private readonly DatabaseRepository $databaseRepository, private readonly PasswordManager $passwordManager)
    {
    }

    public function checkRegisteredUser($email, $passwd): void
    {
        try {
            $user = new User();
            $user->setEmail($email);
            $user = $this->databaseRepository->getUser($user);
            $this->passwordManager->checkPassword($user->getPassword(), $passwd);
        } catch (\PDOException $pdoException) {
            echo "Error: " . $pdoException->getMessage();
        }
    }

    public function registerNewUser($email, $passwd): void
    {
        try {
            $password = $this->passwordManager->hashPassword($passwd);
            $user = new User();
            $user->setPassword($password);
            $user->setEmail($email);
            $this->databaseRepository->insertUser($user);
        } catch (\PDOException $pdoException) {
            echo "Error: " . $pdoException->getMessage();
        }
    }
}

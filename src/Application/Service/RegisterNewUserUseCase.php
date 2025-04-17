<?php

declare(strict_types=1);

namespace FasLatam\Application\Service;

use FasLatam\Common\User;
use FasLatam\Database\DatabaseRepository;
use FasLatam\Hash\PasswordManager;
use PDOException;

class RegisterNewUserUseCase
{
    public function __construct(
        private readonly DatabaseRepository $databaseRepository,
        private readonly PasswordManager $passwordManager,
    ) {
        // ...
    }

    public function __invoke($email, $passwd): void
    {
        try {
            $password = $this->passwordManager->hashPassword($passwd);
            $user = new User();
            $user->setPassword($password);
            $user->setEmail($email);
            $this->databaseRepository->insertUser($user);
        } catch (PDOException $pdoException) {
            echo "Error: " . $pdoException->getMessage();
        }
    }
}

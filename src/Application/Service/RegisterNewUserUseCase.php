<?php

declare(strict_types=1);

namespace FasLatam\Application\Service;

use FasLatam\Common\User;
use FasLatam\Database\UserWriter;
use FasLatam\Hash\PasswordManager;
use PDOException;

class RegisterNewUserUseCase
{
    public function __construct(
        private readonly UserWriter $userWriter,
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
            $this->userWriter->insertUser($user);
        } catch (PDOException $pdoException) {
            echo "Error: " . $pdoException->getMessage();
        }
    }
}

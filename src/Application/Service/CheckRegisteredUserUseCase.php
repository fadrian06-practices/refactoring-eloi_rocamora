<?php

declare(strict_types=1);

namespace FasLatam\Application\Service;

use FasLatam\Common\User;
use FasLatam\Database\UserReader;
use FasLatam\Hash\PasswordManager;
use PDOException;

class CheckRegisteredUserUseCase
{
    public function __construct(
        private readonly UserReader $userReader,
        private readonly PasswordManager $passwordManager,
    ) {
        // ...
    }

    public function __invoke($email, $passwd): void
    {
        try {
            $user = new User();
            $user->setEmail($email);
            $user = $this->userReader->getUser($user);
            $this->passwordManager->checkPassword($user->getPassword(), $passwd);
        } catch (PDOException $pdoException) {
            echo "Error: " . $pdoException->getMessage();
        }
    }
}

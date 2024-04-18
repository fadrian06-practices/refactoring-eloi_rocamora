<?php

namespace App\Application\Services;

use App\Common\User;
use App\Database\DatabaseRepository;
use App\Hash\PasswordManager;
use PDOException;

final class RegisterNewUserUseCase
{
  private $dm;
  private $pm;

  public function __construct(DatabaseRepository $dm, PasswordManager $pm)
  {
    $this->dm = $dm;
    $this->pm = $pm;
  }

  public function __invoke($email, $passwd)
  {
    try {
      $password = $this->pm->hashPassword($passwd);
      $user = new User();
      $user->setPassword($password);
      $user->setEmail($email);
      $this->dm->insertUser($user);
    } catch (PDOException $exception) {
      echo "Error: {$exception->getMessage()}";
    }
  }
}

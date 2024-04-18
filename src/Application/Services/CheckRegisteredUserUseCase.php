<?php

namespace App\Application\Services;

use App\Common\User;
use App\Database\DatabaseRepository;
use App\Hash\PasswordManager;
use PDOException;

final class CheckRegisteredUserUseCase
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
      $user = new User();
      $user->setEmail($email);
      $user = $this->dm->getUser($user);
      $this->pm->checkPassword($user->getPassword(), $passwd);
    } catch (PDOException $exception) {
      echo "Error: {$exception->getMessage()}";
    }
  }
}

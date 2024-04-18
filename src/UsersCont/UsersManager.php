<?php

namespace App\UsersCont;

use App\Common\User;
use App\Database\DatabaseRepository;
use App\Hash\PasswordManager;
use PDOException;

class UsersManager
{
  private $dm;
  private $pm;

  public function __construct(DatabaseRepository $dm, PasswordManager $pm)
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
    } catch (PDOException $exception) {
      echo "Error: {$exception->getMessage()}";
    }
  }

  public function registerNewUser($email, $passwd)
  {
    try {
      $password = $this->pm->hashPassword($passwd);
      $user = new User();
      $user->setPassword($password);
      $user->setEmail($email);
    } catch (PDOException $exception) {
      echo "Error: {$exception->getMessage()}";
    }
  }
}

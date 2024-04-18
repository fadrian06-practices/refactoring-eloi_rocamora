<?php

namespace App\Hash;

use App\Exceptions\UserNotExistsException;

class PasswordHashLib implements PasswordManager
{
  public function checkPassword($passdb, $passtocheck)
  {
    $saltedPosterPassword = self::SALT . $passtocheck;
    $check = password_verify($saltedPosterPassword, $passdb);

    if (!$check) {
      throw new UserNotExistsException;
    }
  }

  public function hashPassword($pass)
  {
    $pass = self::SALT . $pass;

    return password_hash($pass, PASSWORD_DEFAULT);
  }
}

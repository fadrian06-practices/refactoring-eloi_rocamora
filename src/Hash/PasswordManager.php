<?php

namespace App\Hash;

interface PasswordManager
{
  const SALT = 'ilovecodeofaninjabymikedalisay';

  public function checkPassword($passdb, $passtocheck);
  public function hashPassword($pass);
}

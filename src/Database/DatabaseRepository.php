<?php

namespace App\Database;

use App\Common\User;

interface DatabaseRepository
{
  public function getUser(User $user);
  public function insertUser(User $user);
}

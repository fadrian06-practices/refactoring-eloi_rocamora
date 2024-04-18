<?php

namespace App\Database;

use App\Common\User;

interface UserReaderRepository
{
  public function getUser(User $user);
}

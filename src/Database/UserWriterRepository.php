<?php

namespace App\Database;

use App\Common\User;

interface UserWriterRepository extends UserReaderRepository
{
  public function insertUser(User $user);
}

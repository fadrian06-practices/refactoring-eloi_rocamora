<?php

declare(strict_types=1);

namespace FasLatam\Database;

use FasLatam\Common\User;

interface UserWriter
{
    public function insertUser(User $user);
}

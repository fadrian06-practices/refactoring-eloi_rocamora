<?php

declare(strict_types=1);

namespace FasLatam\Database;

use FasLatam\Common\User;

interface DatabaseRepository
{
    public function getUser(User $user);

    public function insertUser(User $user);
}

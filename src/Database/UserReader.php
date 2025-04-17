<?php

declare(strict_types=1);

namespace FasLatam\Database;

use FasLatam\Common\User;

interface UserReader
{
    public function getUser(User $user);
}

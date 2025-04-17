<?php
namespace Database;

use Common\User;

interface DatabaseRepository
{

    public function getUser(User $user);

    public function insertUser(User $user);
}

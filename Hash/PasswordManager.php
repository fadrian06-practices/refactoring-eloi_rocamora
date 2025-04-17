<?php
/**
 * Created by PhpStorm.
 * User: Eloi
 * Date: 24/5/15
 * Time: 19:51
 */

namespace Hash;


interface PasswordManager {

    const SALT = 'ilovecodeofninjabymikedalisay';
    public function checkPassword ($passdb,$passtocheck);
    public function hashPassword($pass);
}

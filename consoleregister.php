<?php

declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

use FasLatam\Application\Service\RegisterNewUserUseCase;
use FasLatam\Database\MysqlDatabaseRepository;
use FasLatam\Hash\PasswordHashLib;
use FasLatam\Exceptions\PersoExceptions;

echo "WELCOME TO REGISTER UTILITY\n";
echo "Put your Username: ";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
$email = trim($line);

echo "Put your Password: ";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
$password = trim($line);

var_dump($email, $password);

try {
    $dbmanager = new MysqlDatabaseRepository();
    $hashmanager = new PasswordHashLib();
    $user_man = new RegisterNewUserUseCase($dbmanager, $hashmanager);
    $user_man($email, $password);

    echo "Successful registration. \n";
} catch (PersoExceptions) {
    echo "Please try again.";
}

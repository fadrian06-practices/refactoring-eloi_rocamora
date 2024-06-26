<?php

use App\Application\Services\RegisterNewUserUseCase;
use App\Database\MysqlDatabaseRepository;
use App\Exceptions\PersoExceptions;
use App\Hash\PasswordHashLib;

require_once __DIR__ . '/autoload.php';

echo "WELCOME TO REGISTER UTILITY\n";
echo 'Put your Username: ';
$handle = fopen('php://stdin', 'r');
$line = fgets($handle);
$email = trim($line);

echo 'Put your Password: ';
$handle = fopen('php://stdin', 'r');
$line = fgets($handle);
$password = trim($line);

var_dump($email, $password);

try {
  $dbmanager = new MysqlDatabaseRepository();
  $hashmanager = new PasswordHashLib();
  $user_man = new RegisterNewUserUseCase($dbmanager, $hashmanager);
  $user_man($email, $password);

  echo "Successful registration.\n";
} catch (PersoExceptions $exception) {
  echo 'Please try agait.';
}

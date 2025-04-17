<?php
require_once __DIR__ . '/autoload.php';
use Database\MysqlDatabaseRepository;
use Hash\PasswordHashLib;
use Exceptions\PersoExceptions;
use UsersCont\UsersManager;


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
  $user_man = new UsersManager($dbmanager, $hashmanager);
  $user_man->registerNewUser($email, $password);

  echo "Successful registration. \n";

} catch (PersoExceptions $exception) {
  echo "Please try again.";
}

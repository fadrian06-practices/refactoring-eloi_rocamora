<?php

use App\Application\Services\RegisterNewUserUseCase;
use App\Database\MysqlDatabaseRepository;
use App\Exceptions\PersoExceptions;
use App\Hash\PasswordHashLib;

require_once __DIR__ . '/autoload.php';

if ($_POST) {
  try {
    $dbmanager = new MysqlDatabaseRepository();
    $hashmanager = new PasswordHashLib();
    $user_man = new RegisterNewUserUseCase($dbmanager, $hashmanager);
    $user_man($_POST['email'], $_POST['password']);

    echo $twig->render('message.twig', ['message' => 'Successful registration']);
  } catch (PersoExceptions $exception) {
    echo $twig->render('messageback.twig', [
      'message' => $exception->getMessage(),
      'ref' => 'register.php',
      'reftit' => 'Please try again.'
    ]);
  }
} else {
  echo $twig->render('form.twig', [
    'action' => 'register.php',
    'formtitle' => 'Registration Form',
    'subname' => 'Register',
    'back' => 'login.php',
    'note1' => 'Already have an account?',
    'note2' => 'Login'
  ]);
}

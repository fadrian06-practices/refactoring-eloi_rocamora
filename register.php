<?php

declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

use FasLatam\Application\Service\RegisterNewUserUseCase;
use FasLatam\Database\MysqlDatabaseRepository;
use FasLatam\Hash\PasswordHashLib;
use FasLatam\Exceptions\PersoExceptions;

if ($_POST !== []) {
    try {
        $dbmanager = new MysqlDatabaseRepository();
        $passwordHashLib = new PasswordHashLib();
        $user_man = new RegisterNewUserUseCase($dbmanager, $passwordHashLib);
        $user_man($_POST['email'], $_POST['password']);

        echo $twig->render('message.twig', ['message' => 'Successful registration']);
    } catch (PersoExceptions $exception) {
        echo $twig->render(
            'messageback.twig',
            ['message' => $exception->getMessage(), 'ref' => 'register.php', 'reftit' => 'Please try again.']
        );
    }
} else {
    echo $twig->render(
        'form.twig',
        [
            'action' => 'register.php',
            'formtitle' => 'Registration Form',
            'subname' => 'Register',
            'back' => 'login.php',
            'note1' => 'Already have an account? ',
            'note2' => 'Login',
        ],
    );
}

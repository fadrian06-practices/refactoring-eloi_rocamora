<?php

declare(strict_types=1);

require_once __DIR__ . '/autoload.php';

use FasLatam\Application\Service\CheckRegisteredUserUseCase;
use FasLatam\Exceptions\PersoExceptions;
use FasLatam\Database\MysqlDatabaseRepository;
use FasLatam\Hash\PasswordHashLib;

// form is submitted, check if acess will be granted
if ($_POST !== []) {
    try {
        $dbmanager = new MysqlDatabaseRepository();
        $hashmanager = new PasswordHashLib();

        $user_man = new CheckRegisteredUserUseCase($dbmanager, $hashmanager);
        $user_man($_POST['email'], $_POST['password']);
        echo $twig->render('message.twig', ['message' => 'Access granted.']);
    } catch (PersoExceptions $pe) {
        echo $twig->render(
            'messageback.twig',
            ['message' => $pe->getMessage(), 'ref' => 'login.php', 'reftit' => 'Please try again.']
        );
    }
} else {
    echo $twig->render('form.twig', [
        'action' => 'login.php',
        'formtitle' => 'Website Login',
        'subname' => 'Login',
        'back' => 'register.php',
        'note1' => 'New here? ',
        'note2' => 'Register for free'
    ]);
}

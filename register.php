<?php

require_once __DIR__ . '/autoload.php';

use FasLatam\Database\MysqlDatabaseRepository;
use FasLatam\Hash\PasswordHashLib;
use FasLatam\Exceptions\PersoExceptions;
use FasLatam\UsersCont\UsersManager;

if ($_POST) {
    try {
        $dbmanager = new MysqlDatabaseRepository();
        $passwordHashLib = new PasswordHashLib();
        $user_man = new UsersManager($dbmanager, $passwordHashLib);
        $user_man->registerNewUser($_POST['email'], $_POST['password']);


        echo $twig->render('message.twig', array('message' => 'Successful registration'));
    } catch (PersoExceptions $exception) {
        echo $twig->render(
            'messageback.twig',
            array('message' => $exception->getMessage(), 'ref' => 'register.php', 'reftit' => 'Please try again.')
        );
    }
} else {
    echo $twig->render(
        'form.twig',
        array(
            'action' => 'register.php',
            'formtitle' => 'Registration Form',
            'subname' => 'Register',
            'back' => 'login.php',
            'note1' => 'Already have an account? ',
            'note2' => 'Login',
        ),
    );
}

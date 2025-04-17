<?php

require_once __DIR__ . '/autoload.php';

use FasLatam\Exceptions\PersoExceptions;
use FasLatam\UsersCont\UsersManager;
use FasLatam\Database\MysqlDatabaseRepository;
use FasLatam\Hash\PasswordHashLib;

// form is submitted, check if acess will be granted
if ($_POST) {
    try {
        $dbmanager = new MysqlDatabaseRepository();
        $hashmanager = new PasswordHashLib();

        $user_man=new UsersManager($dbmanager, $hashmanager);
        $user_man->checkRegisteredUser($_POST['email'], $_POST['password']);
        echo $twig->render('message.twig', array('message' => 'Access granted.'));
    } catch (PersoExceptions $pe) {
        echo $twig->render(
            'messageback.twig',
            array('message' => $pe->getMessage(), 'ref' => 'login.php', 'reftit' => 'Please try again.')
        );
    }
} else {
    echo $twig->render('form.twig', array(
        'action' => 'login.php',
        'formtitle' => 'Website Login',
        'subname' => 'Login',
        'back' => 'register.php',
        'note1' => 'New here? ',
        'note2' => 'Register for free'
    ));
}

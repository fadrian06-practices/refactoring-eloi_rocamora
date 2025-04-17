<?php
require_once __DIR__ . '/autoload.php';
use Database\MysqlDatabaseRepository;
use Hash\PasswordHashLib;
use Exceptions\PersoExceptions;
use UsersCont\UsersManager;




if ($_POST) {

    try {

        $dbmanager = new MysqlDatabaseRepository();
        $passwordHashLib = new PasswordHashLib();
        $user_man=new UsersManager($dbmanager, $passwordHashLib);
        $user_man->registerNewUser($_POST['email'],$_POST['password']);


        echo $twig->render('message.twig', array('message' => 'Successful registration'));

    } catch (PersoExceptions $exception) {
        echo $twig->render('messageback.twig',
            array('message' => $exception->getMessage(), 'ref' => 'register.php', 'reftit' => 'Please try again.'));
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

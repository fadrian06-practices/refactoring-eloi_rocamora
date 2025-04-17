<?php

error_reporting(~E_DEPRECATED);

require_once __DIR__.'/vendor/autoload.php';

Twig_Autoloader::register(); // Enable autoloader

$loader = new \Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new \Twig_Environment($loader, array('debug' => true));
$twig->addExtension(new Twig_Extension_Debug());

<?php

declare(strict_types=1);

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\Extension\DebugExtension;

error_reporting(~E_DEPRECATED);

require_once __DIR__ . '/vendor/autoload.php';

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader, ['debug' => true]);
$twig->addExtension(new DebugExtension());

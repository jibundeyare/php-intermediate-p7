<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// activation du système d'autoloading de Composer
require __DIR__.'/../vendor/autoload.php';

// instanciation du chargeur de templates
$loader = new FilesystemLoader(__DIR__.'/../templates');

// instanciation du moteur de template
$twig = new Environment($loader);

// initialisation d'une donnée
$greeting = 'Hello Twig!';

// affichage du rendu d'un template
echo $twig->render('hello-twig.html.twig', [
    // transmission de données au template
    'greeting' => $greeting,
]);

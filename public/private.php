<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// activation du système d'autoloading de Composer
require __DIR__.'/../vendor/autoload.php';

// démarrage de la session
session_start();

// instanciation du chargeur de templates
$loader = new FilesystemLoader(__DIR__.'/../templates');

// instanciation du moteur de template
$twig = new Environment($loader);

// traitement des données
if (!isset($_SESSION['login'])) {
    // l'utilisateur ne peut pas accéder à la page
    // renvoyer l'utilisateur vers la home page
    $url = '/';
    header("Location: {$url}", true, 301);
    exit();
}

// affichage du rendu d'un template
echo $twig->render('private.html.twig', [
    // transmission de données au template
    'login' => $_SESSION['login'],
    'email' => $_SESSION['email'],
]);
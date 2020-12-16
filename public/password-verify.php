<?php

use Symfony\Component\Yaml\Yaml;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__.'/../vendor/autoload.php';

session_start();

// instanciation du chargeur de templates
$loader = new FilesystemLoader(__DIR__.'/../templates');

// instanciation du moteur de template
$twig = new Environment($loader);

// traitement des données
$config = Yaml::parseFile(__DIR__.'/../config/config.yaml');

dump($config);

$password = '123';
$errors = [];

if (!password_verify($password, $config['password'])) {
    $errors['password'] = 'Mot de passe ou login invalide';
}

// affichage du rendu d'un template
echo $twig->render('password-verify.html.twig', [
    // transmission de données au template
    'errors' => $errors,
]);
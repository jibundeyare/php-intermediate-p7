<?php

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

require __DIR__.'/../vendor/autoload.php';

// instanciation du chargeur de templates
$loader = new FilesystemLoader(__DIR__.'/../templates');

// instanciation du moteur de template
$twig = new Environment($loader, [
    // activation du mode debug
    'debug' => true,
    // activation du mode de variables strictes
    'strict_variables' => true,
]);

// chargement de l'extension DebugExtension
$twig->addExtension(new DebugExtension());

// traitement des données
$formData = [
    'login' => '',
    'year' => '',
    'email' => '@popschool.fr',
];
$errors = [];

if ($_POST) {
    foreach ($formData as $key => $value) {
        if (isset($_POST[$key])) {
            $formData[$key] = $_POST[$key];
        }
    }

    $minLength = 3;
    $maxLength = 10;

    if (empty($_POST['login'])) {
        // le champs est-il vide ?
        $errors['login'] = 'merci de renseigner ce champ';
    } elseif (strlen($_POST['login']) < 3 || strlen($_POST['login']) > 10) {
        // la longueur du login est-elle hors des limites ?
        $errors['login'] = "merci de renseigner un login dont la longueur est comprise entre {$minLength} et {$maxLength} inclus";
    } elseif (preg_match('/^[a-zA-Z]+$/', $_POST['login']) === 0) {
        // le login est-il composé exclusivement de lettres de a à z, majuscules ou mnisucules ?
        $errors['login'] = 'merci de renseigner un login composé uniquement de lettres de l\'alphabet sans accent';
    }

    $date = new DateTime();
    $maxYear = (int) $date->format('Y');
    $minYear = $maxYear - 100;

    if (empty($_POST['year'])) {
        // le champs est-il vide ?
        $errors['year'] = 'merci de renseigner ce champ';
    } elseif (!is_numeric($_POST['year'])) {
        // la valeur est-elle numérique ?
        $errors['year'] = 'merci de renseigner ce champ avec une année valide';
    } elseif ((float) $_POST['year'] - (int) $_POST['year'] != 0) {
        // la valeur possède-t-elle des chiffres après la virgule ?
        $errors['year'] = 'merci de renseigner ce champ avec une année valide';
    } elseif ($_POST['year'] <= $minYear || $_POST['year'] >= $maxYear) {
        // la valeur est-elle hors des limites ?
        $errors['year'] = "merci de renseigner une année comprise entre {$minYear} et {$maxYear} inclus";
    }

    if (empty($_POST['email'])) {
        $errors['email'] = 'merci de renseigner ce champ';
    } elseif (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
        $errors['email'] = 'merci de renseigner un email valide';
    }

    // si il n'y a pas d'erreur, on redirige l'utilisateur vers la page d'accueil
    if (!$errors) {
        $url = '/';
        header("Location: {$url}", true, 302);
        exit();
    }
}

// affichage du rendu d'un template
echo $twig->render('form-validation.html.twig', [
    // transmission de données au template
    'errors' => $errors,
    'formData' => $formData,
]);

<?php

namespace App;

use Exception;

require __DIR__.'/../vendor/autoload.php';

function myLoop(int $max, int $limit): void
{
    for ($i = 0; $i < $max; $i++) {
        echo "$i<br>";

        if ($i == $limit) {
            throw new Exception("le 5ème tour est passé");
            echo "ce texte ne s'affichera jamais";
        }
    }
}

try {
    myLoop(10, 5);
} catch (Exception $e) {
    // echo "{$e->getMessage()}<br>";
    // echo "{$e->getFile()}<br>";
    // echo "{$e->getLine()}<br>";
    // echo "{$e->getCode()}<br>";
    // echo "{$e->getTraceAsString()}<br>";
    // dump($e->getTrace());

    $error = $e->getMessage();
    // ou
    header('Location: error500.html');
    exit();
} finally {
    echo "ce texte s'affiche qu'il y ait eu exception ou pas<br>";
}

// ...

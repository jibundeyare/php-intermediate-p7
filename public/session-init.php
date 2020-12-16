<?php

use Symfony\Component\Yaml\Yaml;

require_once __DIR__.'/../vendor/autoload.php';

session_start();

$config = Yaml::parseFile(__DIR__.'/../config/config.yaml');

$_SESSION['login'] = $config['login'];
$_SESSION['email'] = $config['email'];

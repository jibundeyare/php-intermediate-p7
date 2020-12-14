<?php

use Symfony\Component\Yaml\Yaml;

require __DIR__.'/../vendor/autoload.php';

$config = Yaml::parseFile(__DIR__.'/../config/config.yaml');

dump($config);

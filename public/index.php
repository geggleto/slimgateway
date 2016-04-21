<?php

require '../vendor/autoload.php';

$app = new Slim\App();

$container = $app->getContainer();

require "../config/slim.php";
require "../config/deps.php";
require "../config/db.php";

$app->run();


<?php

require '../vendor/autoload.php';

$app = new Slim\App();

$container = $app->getContainer();

require "../config/slim.php";
require "../config/deps.php";
require "../config/db.env.php";
require "../config/db.php";
require "../config/routes.php";
require "../config/validators.php";

$app->run();


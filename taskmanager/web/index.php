<?php

ini_set('display_errors', 0);

require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../app/app.php';
require __DIR__.'/../config/prod.php';
require __DIR__ . '/../app/service.php';
require __DIR__ . '/../app/routing.php';

$app->run();

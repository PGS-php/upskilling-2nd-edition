<?php

use Symfony\Component\Debug\Debug;

require_once __DIR__.'/../vendor/autoload.php';

Debug::enable();

$app = require __DIR__.'/../app/app.php';
require __DIR__.'/../config/dev.php';
require __DIR__ . '/../app/service.php';
require __DIR__ . '/../app/routing.php';

$app->run();

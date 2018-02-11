<?php

use App\UserInterface\Controllers\Dashboard\DashboardController;

/**
 * Controllers
 */
$app['dashboard.controller'] = function () use ($app) {
    return new DashboardController($app);
};

/**
 * Repositories
 */
$app['task_repository'] = function () use ($app) {
    return $app['em']->getRepository('App\Application\Task\Task');
};

/**
 * Services
 */
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    return $twig;
});

$app['em'] = $app["orm.em"];

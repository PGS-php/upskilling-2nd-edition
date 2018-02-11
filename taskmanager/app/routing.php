<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->get('/', 'dashboard.controller:indexAction')->bind('home');

$app->error(function (\Exception $e, Request $request, $code) use ($app) {

    if ($app['debug']) {
        return;
    }

    switch ($code) {
        case 500:
            return new Response($app['twig']->render('errors/5xx.html.twig'), 404);
    }
});
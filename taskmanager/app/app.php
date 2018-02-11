<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());



// @TODO Load database credentials from config file
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'host' => 'tm_mysql',
        'dbname' => 'tm',
        'user' => 'tm',
        'password' => 'tm',
        'charset' => 'utf8',
        'driverOptions' => array(1002 => 'SET NAMES utf8')
    ),
));

$app->register(new DoctrineOrmServiceProvider, array(
    "orm.proxies_dir" => __DIR__ . "/../../../var/cache/doctrine/proxy",
    'orm.em.options' => array(
        'mappings' => array(
            array(
                'type' => 'simple_yml',
                'namespace' => 'App\Application',
                'path' => __DIR__ . '/../src/Infrastructure/Doctrine/Mapping',
            )
        ),
    ),
));

return $app;

<?php

require '../vendor/autoload.php';

use Slim\Slim,
    RedBeanPHP\R;

$app=new Slim([
    'templates.path'=>'../templates/'
]);

$app->get('/',function () use ($app){
    $app->render('index.php');
});

$app->run();
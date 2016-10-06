<?php

require '../vendor/autoload.php';

use Slim\Slim,
    RedBeanPHP\R;

R::setup('mysql:host=149.202.160.19;dbname=hky16_v0', 'data', 'hk16');
R::getAll('installations');

$app=new Slim([
    'templates.path'=>'../templates/'
]);

$app->get('/',function () use ($app){
    $app->render('index.php');
});

$app->run();
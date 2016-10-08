<?php

require '../vendor/autoload.php';
require '../options.php';

use Slim\Slim,
    RedBeanPHP\R;

R::setup('mysql:host=' . __HOST__ . ';dbname='.__DB__, __USER__, __PASS__);

$app=new Slim([
    'templates.path'=>'../templates/'
]);

$app->get('/(:page)',function ($page='index') use ($app){
    $app->render('includes/includes.php',compact('page'));
});

$app->post('/(:page)',function ($page='index') use ($app){
    $app->render('includes/includes.php',compact('page'));
});

$app->run();
//ss
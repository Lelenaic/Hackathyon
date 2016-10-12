<?php
use Hackathyon\Utility,
    Hackathyon\User;
@session_start();

if (!Utility::isLogged() and $page!='login'){
    header ('location: login');
    die;
}

chdir('../templates/');
$user=new User($page);
$user->login();
$user->logout();
if (file_exists($page.'.php')){
    $pages=['login','forgot','500'];
    if (!in_array($page,$pages)){
        $w=new \Hackathyon\Weather();
        $weather=$w->getW();
        $w->getTemp();
        include 'includes/header.php';
    }
    include $page.'.php';
}else{
    include '404.php';
}
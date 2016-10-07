<?php
use Hackathyon\Utility,
    Hackathyon\User;
@session_start();

if (!Utility::isLogged() and $page!='login'){
    header ('location: login');
    die;
}
chdir('../templates/');
//die(password_hash('1234',PASSWORD_DEFAULT));

$user=new User($page);
$user->login();
$user->logout();
if (file_exists($page.'.php')){
    $pages=['login','forgot'];
    if (!in_array($page,$pages)){
        include 'includes/header.php';
    }
    include $page.'.php';
}else{
    include '404.php';
}

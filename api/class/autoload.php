<?php
/**
* Class Autoloader
*/
class Autoloader{

/**
* Enregistre notre autoloader
*/
static function register(){
    spl_autoload_register(array(__CLASS__, 'autoload'));
}

/**
* Inclue le fichier correspondant à notre classe
* @param $class string Le nom de la classe à charger
*/
static function autoload($class){
    if (file_exists('../class/' . $class . '.php')){
        require '../class/' . $class . '.php';
    }
}

}
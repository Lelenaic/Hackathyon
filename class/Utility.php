<?php

namespace Hackathyon;

use DateTime;
use RedBeanPHP\R;

class Utility {

    /**
     * Redirect to login if a user is not logged.
     */
    public static function notLogged() {
        header('location: login');
        die;
    }

    /**
     * Verify if a user is logged.
     * @return bool
     */
    public static function isLogged() {
        if (isset($_SESSION['id'])) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Verify if the user is logged and if the IP did not change.
     */
    public static function verifyLog(){
        if (!self::isLogged()){
            self::logOut();
        }elseif (!$_SERVER['REMOTE_ADDR']==$_SESSION['ip']){
            self::logOut(true);
        }
    }

    /**
     * Used to log out a user.
     * @param bool $error
     */
    public static function logOut($error=false){
        unset($_SESSION['id']);
        unset($_SESSION['ip']);
        unset($_SESSION['admin']);
        session_destroy();
        session_start();
        if ($error){
            $_SESSION['message']='<i class="fa fa-info" aria-hidden="true"></i> Session invalide, merci de vous reconnecter.';
            $_SESSION['messageType']='warning';
        }else{
            $_SESSION['message']='<i class="fa fa-check" aria-hidden="true"></i> Vous avez bien été déconnecté !';
            $_SESSION['messageType']='info';
        }
        header('location: login');
        die;
    }

    /**
     * Used to display an alert.
     * @param int $spaceU
     * @return string
     */
    public static function seeMsg($spaceU = 0) {
        if (isset($_SESSION['message'])) {
            $msg = $_SESSION['message'];
            $type = $_SESSION['messageType'];
            $space = isset($_SESSION['messageSpace']) ? $_SESSION['messageSpace'] : 0;
            if ($spaceU == $space) {
                unset($_SESSION['messageType']);
                unset($_SESSION['messageSpace']);
                unset($_SESSION['message']);
                return '<div class="alert alert-' . $type . ' fade in"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>' . $msg . '</div>';
            }
        }
    }

    public static function dateUS2FR($dateus) {
        $datefr=explode('-',$dateus);
        return $datefr[2].'/'.$datefr[1].'/'.$datefr[0];
    }

    /**
     * Generate a random string
     * @param int $length
     * @return string
     */
    public static function generateRandomString($length = 32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}

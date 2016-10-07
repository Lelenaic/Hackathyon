<?php

namespace Hackathyon;

use DateTime;
use RedBeanPHP\R;

class Utility {

    public static function notLogged() {
        header('location: login');
        die;
    }

    public static function isLogged() {
        if (isset($_SESSION['id'])) {
            return true;
        }else{
            return false;
        }
    }

    public static function verifyLog(){
        if (!self::isLogged()){
            self::logOut();
        }elseif (!$_SERVER['REMOTE_ADDR']==$_SESSION['ip']){
            self::logOut(true);
        }
    }

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

    public static function addLog($type, $result) {
        $type = addslashes($type);
        $result = addslashes($result);
        $id = isset($_SESSION['id']) ? $_SESSION['id']:0;
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR']:'127.0.0.1';
        $log=R::dispense('logs');
        $log->user_id=$id;
        $log->date=$date;
        $log->time=$time;
        $log->type=$type;
        $log->result=$result;
        $log->ip=$ip;
        R::store($log);
    }
    
    public static function getName(){
        $name=Database::query('select username from users where id='.$_SESSION['id']);
        return $name[0][0];
    }

    public static function dateUS2FR($dateus) {
        $datefr=explode('-',$dateus);
        return $datefr[2].'/'.$datefr[1].'/'.$datefr[0];
    }

    public static function generateRandomString($length = 32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function ago($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'an',
            'm' => 'mois',
            'w' => 'semaine',
            'd' => 'jour',
            'h' => 'heure',
            'i' => 'minute',
            's' => 'seconde',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v;
                if ($v!='mois'){
                    $v.=($diff->$k > 1 ? 's' : '');
                }
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string): 'A l\'instant';
    }

}

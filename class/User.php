<?php


namespace Hackathyon;
use RedBeanPHP\R;

class User
{
    private $_page;

    public function __construct($page)
    {
        $this->_page=$page;
    }

    private function define()
    {
        if (isset($_SESSION['id'])) {

        }
    }

    public function getUserInfos(){
        var_dump(R::findOne('users','id=?',[$_SESSION['id']]));
    }

    private function resetTries(){
        $tries=R::findOne('tries','ip=? and date=?',[$_SERVER['REMOTE_ADDR'],date('Y-m-d')]);
        if (!is_null($tries)){
            $tries->mustIgnore=1;
            R::store($tries);
        }
    }

    public function login(){
        if ($this->_page=='login' and isset($_POST['mail'])){
            //$this->verifyTries();
            $info=R::findOne('users','mail=? and active=1',[$_POST['mail']]);
            if (!is_null($info) and $_POST['pass']==$info->getProperties()['pass']){
                $_SESSION['id']=$info->getProperties()['id'];
                $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
                //Utility::addLog('connexion','Success');
                //$this->resetTries();
                header('location: ./');
                die;
            }else{
                //$this->addTry();
                $_SESSION['message']='<i class="fa fa-exclamation-triangle"></i> <b>Erreur !</b> Votre e-mail ou votre mot de passe est incorrect !';
                $_SESSION['messageType']='danger';
                header('location: login');
                die;
            }
        }
    }

    private function addTry(){
        $ip=$_SERVER['REMOTE_ADDR'];
        $date=date('Y-m-d');
        $try=R::findOrCreate('tries',['ip'=>$ip,'date'=>$date]);
        $try->date=$date;
        $try->ip=$ip;
        $try->number++;
        R::store($try);
    }

    private function verifyTries(){
        $tries=R::findOne('tries','ip=? and date=? and mustIgnore=0',[$_SERVER['REMOTE_ADDR'],date('Y-m-d')]);
        if ($tries->number>=10){
            $_SESSION['message']='<i class="fa fa-exclamation-triangle"></i> <b>Erreur !</b> Vous avez fait trop d\'erreurs aujourd\'hui, rééssayez demain.';
            $_SESSION['messageType']='warning';
            header('location: login');
            die;
        }
    }

    public function logout(){
        if ($this->_page=='logout'){
            Utility::logOut();
        }
    }
}
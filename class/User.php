<?php


namespace Hackathyon;
use RedBeanPHP\R;

class User
{
    private $_page;

    /**
     * User constructor.
     * @param $page
     */
    public function __construct($page)
    {
        $this->_page=$page;
    }

    /**
     * Verify the user creditentials then log in or not.
     */
    public function login(){
        if ($this->_page=='login' and isset($_POST['mail'])){
            $info=R::findOne('users','mail=? and active=1',[$_POST['mail']]);
            if (!is_null($info) and password_verify($_POST['pass'],$info->getProperties()['pass'])){
                $_SESSION['id']=$info->getProperties()['id'];
                $_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
                header('location: ./');
                die;
            }else{
                $_SESSION['message']='<i class="fa fa-exclamation-triangle"></i> <b>Erreur !</b> Votre e-mail ou votre mot de passe est incorrect !';
                $_SESSION['messageType']='danger';
                header('location: login');
                die;
            }
        }
    }

    /**
     * Destroy the session to log out.
     */
    public function logout(){
        if ($this->_page=='logout'){
            Utility::logOut();
        }
    }
}
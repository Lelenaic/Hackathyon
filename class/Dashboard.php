<?php

namespace Hackathyon;
use RedBeanPHP\R;

class Dashboard
{
    public function getRadiatorsNumber(){
        $number=R::count('installations','user_id=?',[$_SESSION['id']]);
        return $number;
    }

    public function getMail(){
        $user=R::findOne('users','id=?',[$_SESSION['id']]);
        return $user->getProperties()['mail'];
    }

    public function consumption(){
        $r=R::find('installations','user_id=?',[$_SESSION['id']]);
        $cons=0;
        foreach ($r as $item) {
            $findCons=R::findOne('consumption','product_id=? order by timestamp desc',[$item->getProperties()['product_id']]);
            $cons+=$findCons->getProperties()['wh'];
        }
        return $cons/1000;
    }
}
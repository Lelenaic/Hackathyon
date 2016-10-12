<?php

namespace Hackathyon;
use RedBeanPHP\R;

class Dashboard
{
    /**
     * Return number of radiators for the logged user.
     * @return int
     */
    public function getRadiatorsNumber(){
        $number=R::count('installations','user_id=?',[$_SESSION['id']]);
        return $number;
    }

    /**
     * Return the mail address for the logged user.
     * @return string
     */
    public function getMail(){
        $user=R::findOne('users','id=?',[$_SESSION['id']]);
        return $user->getProperties()['mail'];
    }

    /**
     * Get the actuall consumption of all the radiators for the current user.
     * @return int
     */
    public function consumption(){
        $r=R::find('installations','user_id=?',[$_SESSION['id']]);
        $cons=0;
        foreach ($r as $item) {
            $findCons=R::findOne('consumption','product_id=? order by timestamp desc',[$item->getProperties()['product_id']]);
            $cons+=$findCons->getProperties()['wh'];
        }
        return $cons/1000;
    }

    /**
     * Rate of when the users are inside theur home.
     * @return int
     */
    public function insideRate(){
        $count1=R::count('presence','personInside=1 and user_id=?',[$_SESSION['id']]);
        $count2=R::count('presence','user_id=?',[$_SESSION['id']]);
        return floor($count1/$count2*100);
    }
}
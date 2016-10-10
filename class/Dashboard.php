<?php

namespace Hackathyon;
use RedBeanPHP\R;

class Dashboard
{
    public function getRadiatorsNumber(){
        $number=R::count('installations','user_id=?',[$_SESSION['id']]);
        return $number;
    }
}
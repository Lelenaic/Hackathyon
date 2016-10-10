<?php

namespace Hackathyon;
use RedBeanPHP\R,
    Hackathyon\Api;

class Stats
{
    public function roomGraph(){
//        $_SESSION['id']
        $products=new Api('12345','get','installations',['user_id'=>'5']);
        $products=json_decode($products->make());
        $show = '';
        $color = ['#5BAABF','#4ED18F','#94D7E9','#15BA67','#BBE0E9'];
        $i = 0;

        foreach ($products as $product) {
            $show.='{value:'.$product->power.',color:"'.$color[$i].'",highlight:"#9bddd0",label:"'.$product->placeType.' ('.$product->radioAddress.')"},';
            if($i>3){
                $i=0;
            }else{
                $i++;
            }
        }
        return substr($show,0,strlen($show)-1);
    }

    public function getTime(){

    }
}
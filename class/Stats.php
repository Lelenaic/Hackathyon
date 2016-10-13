<?php

namespace Hackathyon;
use RedBeanPHP\R,
    Hackathyon\Api;

class Stats
{
    public static function roomGraph(){
        $products = \Hackathyon\Stats::getUserInfo();
        $show = '';
        $color = ['#5BAABF','#4ED18F','#94D7E9','#15BA67','#BBE0E9'];
        $i = 0;

        foreach ($products as $product) {
            $show.='{value:'.$product->power.',color:"'.$color[$i].'",highlight:"#9bddd0",label:"'.$product->placeType.'"},';
            if($i>3){
                $i=0;
            }else{
                $i++;
            }
        }
        return substr($show,0,strlen($show)-1);
    }

    public static function getAdvice1(){
        $price = 0.15;
        $hours = 15;
        $cost = 0;
        $products = \Hackathyon\Stats::getUserInfo();
        foreach ($products as $product) {
            $cost += $product->power/1000;
        }
        $cost = $cost*$hours*$price;
        return 'En moyenne, votre chauffage vous coûte <b>'.$cost.'€ par jour</b>. Pensez à programmer votre thermostat pour ne plus chauffer votre maison inutilement et ainsi faire des économies.';
    }

    public function getTime(){
        return __DATE__;
    }

    public function  getUser(){
//        return $_SESSION['id'];
        return $_SESSION['id'];
    }

    public  function getUserInfo(){
        $products=new Api('12345','get','installations',['user_id'=>\Hackathyon\Stats::getUser()]);
        return json_decode($products->make());
    }

    public function getConsumption(){
        $consumptions = R::getAll('SELECT * FROM `consumption`
                                    WHERE user_id = '.\Hackathyon\Stats::getUser().'
                                    AND DATE(timestamp) <= "'.__DATE__.'"
                                    GROUP BY DATE(timestamp)
                                    ORDER BY `consumption`.`timestamp` DESC
                                    LIMIT 10');
        return $consumptions;
    }

    public function getTimeList(){
        $products = \Hackathyon\Stats::getConsumption();
        $consumptions = [];
        foreach ($products as $product){
            $consumptions[] = $product['wh'];
        }
        $consumptions = array_reverse($consumptions);
        $values = '[';
        foreach ($consumptions as $consumption) {
            $values .= $consumption.',';
        }
        $values = substr($values,0,strlen($values)-1);
        return $values.']';
    }

    public function getValueList(){
        $products = \Hackathyon\Stats::getConsumption();
        $times = [];
        foreach ($products as $product){
            $times[] = $product['timestamp'];
        }
        $times = array_reverse($times);
        $values = '["';
        foreach ($times as $times) {
            $values .= $times.'","';
        }
        $values = substr($values,0,strlen($values)-2);
        return $values.']';
    }
}
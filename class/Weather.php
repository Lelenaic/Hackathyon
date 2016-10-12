<?php
/**
 * Created by PhpStorm.
 * User: lelenaic
 * Date: 12/10/16
 * Time: 20:50
 */

namespace Hackathyon;
use RedBeanPHP\R;

class Weather
{
    private $_weather;

    public function __construct()
    {
        $this->_weather=$this->getWeather();
    }

    public function getTown(){
        $town=R::findOne('installations','user_id=?',[$_SESSION['id']]);
        return $town->getProperties()['city'];
    }

    private function getWeather(){
        $city=$this->getTown();
        $weather=json_decode(utf8_decode(file_get_contents('http://api.wunderground.com/api/a19e3f9f3427a3cc/conditions/hourly/q/France/'.$city.'.json')));
        return $weather;

    }

    public function getW(){
        return $this->_weather;
    }

    public function getTemp(){
        $temp=$this->_weather->current_observation->temp_c;
        return $temp;
    }

    public function getPic(){
        $pic=$this->_weather->current_observation->icon_url;
        return $pic;
    }

    public function prevent($n=0){
        $weather=$this->_weather->hourly_forecast[$n];
        $hour=$weather->FCTTIME->hour;
        $temp=$weather->temp->metric;
        $weath=$weather->icon_url;
        return [$hour,$temp,$weath];
    }

    public function showPrevent(){
        $html='';
        for ($i=0;$i<10;$i++){
            $prev=$this->prevent($i);
            $action=$prev[1]<22 ? 'En fonctionnement':'A l\'arrêt';
            $html.='<tr>';
            $html.='<td>'.$prev[0].'h00</td>';
            $html.='<td>'.$action.'</td>';
            $html.='<td>'.$prev[1].'°C</td>';
            $html.='<td><img src="'.$prev[2].'"/></td>';
            $html.='</tr>';
        }
        return $html;
    }

}
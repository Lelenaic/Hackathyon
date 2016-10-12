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

    /**
     * Weather constructor.
     */
    public function __construct()
    {
        $this->_weather=$this->getWeather();
    }

    /**
     * Return the city where the actual user lives.
     * @return mixed
     */
    public function getTown(){
        $town=R::findOne('installations','user_id=?',[$_SESSION['id']]);
        return $town->getProperties()['city'];
    }

    /**
     * Get the JSON data from the weather API.
     * @return mixed
     */
    private function getWeather(){
        $city=$this->getTown();
        $weather=json_decode(utf8_decode(file_get_contents('http://api.wunderground.com/api/a19e3f9f3427a3cc/conditions/hourly/q/France/'.$city.'.json')));
        return $weather;

    }

    /**
     * Return the weather object.
     * @return mixed
     */
    public function getW(){
        return $this->_weather;
    }

    /**
     * Return the actual temperature.
     * @return int|float
     */
    public function getTemp(){
        $temp=$this->_weather->current_observation->temp_c;
        return $temp;
    }

    /**
     * Return the weather picture (cloud, sun etc.)
     * @return string
     */
    public function getPic(){
        $pic=$this->_weather->current_observation->icon_url;
        return $pic;
    }

    /**
     * Return the future weather depending of the asked hour
     * (if n==0 you will get the weather for the next hour)
     * @param int $n
     * @return array
     */
    public function prevent($n=0){
        $weather=$this->_weather->hourly_forecast[$n];
        $hour=$weather->FCTTIME->hour;
        $temp=$weather->temp->metric;
        $weath=$weather->icon_url;
        return [$hour,$temp,$weath];
    }

    /**
     * Create the table structure for the weather table
     * @return string
     */
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
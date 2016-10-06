<?php

namespace Hackathyon;
use RedBeanPHP\R;

class Api
{
    private $_key;
    private $_action;
    private $_category;
    private $_query;
    const hash = 'bDeUew3JX4Zg96raHzwcQSwDyVAdLesZ';
    const requestable = ['consumption', 'heatinglevel', 'installations', 'operatingmode', 'presence'];

    /**
     * Api constructor.
     * @param string $key
     * @param string $action
     * @param string $category
     * @param string $query
     */
    public function __construct($key = null, $action = null, $category = null, $query = null)
    {
        $this->_key = $key;
        $this->_action = $action;
        $this->_category = $category;
        $this->_query = is_null($query) ? null : explode(';', $query);
        $this->verify();
    }

    /**
     * Store the fact that the Apikey ask for data.
     * Used to define a limit for each key.
     */
    private function addRequest()
    {
        $request = R::findOrCreate('request', ['ip' => $_SERVER['REMOTE_ADDR'], 'api_id' => $this->getIdFromKey(), 'date' => date('Y-m-d')]);
        $request->ip = $_SERVER['REMOTE_ADDR'];
        $request->date = date('Y-m-d');
        $request->api_id = $this->getIdFromKey();
        $request->number++;
        R::store($request);
    }

    /**
     * Return ID that matches the given Apikey.
     * @return int
     */
    private function getIdFromKey()
    {
        $id = R::findOne('api', 'apikey=?', [crypt($this->_key, self::hash)]);
        return $id->getProperties()['id'];
    }

    /**
     * Verify if all the API params are defined.
     */
    private function verify()
    {
        if (is_null($this->_key) || is_null($this->_action) || is_null($this->_category)) {
            die('Erreur dans la definition de l\'API');
        }
        if ($this->_action != 'post' && is_null($this->_query)) {
            die('Erreur dans la definition de l\'API');
        }
        $this->verifKey();
        $this->verifLimit();
        $this->verifyCategory();
    }

    /**
     * Verify if the Apikey exists and is valid.
     * We add a try if the user fails. Cf addTry() Method.
     */
    private function verifKey()
    {
        $verif = R::findOne('api', 'apikey=?', [crypt($this->_key, self::hash)]);
        $this->verifTries();
        if (is_null($verif)) {
            $this->addTry();
            die('API key error !');
        }
        if ($verif->getProperties()['id'] == 0 && $this->_key != '' && is_null($this->_key)) {
            $this->addTry();
            die('API key error !');
        }
    }

    /**
     * Verify if the category exists and is editable.
     */
    private function verifyCategory()
    {
        if (!in_array($this->_category, self::requestable)) {
            die('Unknown category');
        }
    }

    /**
     * Add record to database to signify identification error.
     */
    private function addTry()
    {
        $try = R::findOrCreate('try', ['ip' => $_SERVER['REMOTE_ADDR'], 'date' => date('Y-m-d')]);
        $try->ip = $_SERVER['REMOTE_ADDR'];
        $try->date = date('Y-m-d');
        $try->number++;
        R::store($try);
    }

    /**
     * Actions the user can make. Call a method regarding of the called action.
     */
    public function getData()
    {
        $this->addRequest();
        switch ($this->_action) {
            case 'get':
                return $this->get();
                break;
            case 'post':
                return $this->post();
                break;
            default:
                die('Unknown action !');
        }
    }

    /**
     * Return json (asked data).
     * @return string
     */
    private function get()
    {
        //Return all records if the user record for 'all' query
        if ($this->_query[0] == 'all') {
            return json_encode(R::findAll($this->_category), JSON_UNESCAPED_UNICODE);
        } else {
            $get = array();
            //Sort conditions of the query to prepare them into a SQL request.
            foreach ($this->_query as $request) {
                $arguments = explode(',', $request);
                if ($this->_category == "rental") {
                    $args = array($this->getIdFromKey());
                    $txt = 'api_id=? and ';
                } else {
                    $args = array();
                    $txt = '';
                }

                foreach ($arguments as $argument) {
                    $arg = explode(':', $argument);
                    $txt .= isset($arg[1]) ? $arg[0] . '=? and ' : 'id=? and ';
                    $args[] = isset($arg[1]) ? $arg[1] : $arg[0];
                };
                $find = R::find($this->_category, rtrim($txt, ' and '), $args);
                $get = array_merge($get, $find);
            }
            return json_encode($get, JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Used to create or update a rental.
     */
    private function post()
    {
        $get = array();
        //Sort conditions of the query to prepare them into a SQL request.
        foreach ($_POST as $key => $request) {
            $names = explode(',', $key);
            $arguments = explode(',', $request);
            $args = array();
            $txt = '';
            for ($i=0;$i<count($arguments);$i++){
                $txt.=$names[$i].'=? and ';
                $args[]=$arguments[$i];
            }
            $find = R::find($this->_category, rtrim($txt, ' and '), $args);
            $get = array_merge($get, $find);
        }
        return json_encode($get, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Linked to addTry(), verify number of fails (to avoid bruteforce login).
     */
    private function verifTries()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $count = R::findOne('try', 'ip=? and date=?', [$ip, date('Y-m-d')]);
        if (!is_null($count) && $count->getProperties()['number'] > 9) {
            die('Error quota reached, try again tomorrow.');
        }
    }

    /**
     * Verify is the Apikey has not reached its query limit.
     */
    private function verifLimit()
    {
        $requests = R::findOne('request', 'api_id=? and MONTH(date)=?', [$this->getIdFromKey(), date('m')]);
        $max = R::findOne('api', 'apikey=?', [crypt($this->_key, self::hash)]);
        if (!is_null($requests) && $requests->getProperties()['number'] >= $max->getProperties()['max']) {
            die('Maximum requests reached, please upgrade your plan !');
        }
    }
}
<?php
namespace Hackathyon;

class Api
{
    // DO NOT modify the server URL if you want to use the main server.
    const url = 'http://hky.lenaic.me/api/public/';
    // Your API Key
    protected $apiKey;
    //The action (GET,PUT,DELETE)
    protected $action;
    //The category on wich you will perform the action
    protected $category;
    //Associative table with your properties for the Query
    //Ex : ['id'=>1,'ville'=>'Paris'];
    protected $query;

    /**
     * Api constructor.
     * @param string $apiKey
     * @param string $action
     * @param string $category
     * @param string $query
     */
    public function __construct($apiKey = null, $action = null, $category = null, $query = null)
    {

        $this->apiKey = $apiKey;
        $this->action = $action;
        $this->category = $category;
        $this->query = $query;
        $this->verify([$this->apiKey, $action, $category, $query]);
    }

    /**
     * Verify if all parameters are defined. (They are all required !)
     * @param array $items
     * @throws \Exception
     */
    protected function verify($items = array())
    {
        foreach ($items as $item) {
            if (is_null($item) or $item == '') {
                throw new \Exception('A parameter is null or not initialized !');
            }
        }
    }

    /**
     * Like the GET method put using POST
     * @return string
     */
    private function post(){
        $curl = curl_init(self::url. $this->apiKey . '/' . $this->action . '/' . $this->category);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->query));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    /**
     * Make the request to the server and return data. (JSON)
     * @return string
     * @throws \Exception
     */
    private function get()
    {
        $query = $this->initQuery($this->query);
        try {
            $api = file_get_contents(self::url . $this->apiKey . '/' . $this->action . '/' . $this->category . '/' . $query);
        } catch (\Exception $e) {
            throw new \Exception('Error : ' . $e);
        }
        return $api;
    }

    /**
     * Run the API
     * @return string
     */
    public function make(){
        if ($this->action=='post'){
            return $this->post();
        }else{
            return $this->get();
        }
    }

    /**
     * Make the correct URL for the query.
     * The query is an associative array and this method convert the array in text.
     * Ex : ['id'=>1] becomes 'id:1'
     * @param $query
     * @return string
     */
    protected function initQuery($query)
    {
        $txt = '';
        foreach ($query as $key => $item) {
            if (is_array($item)) {
                $preTxt='';
                foreach ($item as $key2=>$condition) {
                    if (is_int($key2)) {
                        $preTxt .= $condition . ',';
                    } else {
                        $preTxt .= $key2 . ':' . $condition . ',';
                    }
                }
                $txt .= substr($preTxt, 0, -1).';';
            } else {
                if (is_int($key)) {
                    $txt .= $item . ',';
                } else {
                    $txt .= $key . ':' . $item . ',';
                }
            }
        }
        return substr($txt, 0, -1);
    }
}
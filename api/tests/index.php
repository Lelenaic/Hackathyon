<?php
require 'Api.php';

use Hackathyon\Api;


$api=new Api('12345','post','consumption',['id'=>'1']);
var_dump($api->make());
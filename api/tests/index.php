<?php
require 'Api.php';

use Hackathyon\Api;


$api=new Api('12345','post','agency',['ville'=>'Paris']);
echo $api->make();
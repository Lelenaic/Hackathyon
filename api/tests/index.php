<?php
require 'Api.php';

use Hackathyon\Api;


$api=new Api('12345','post','agency',['postcode'=>'85000','ville'=>'La Roche-sur-Yon']);
echo $api->make();
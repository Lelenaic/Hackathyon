<?php
require 'Api.php';

use Hackathyon\Api;


$api=new Api('12345','post','consumption',['id_produit'=>'io://0801-5372-0988/7730125#1']);
echo $api->make();
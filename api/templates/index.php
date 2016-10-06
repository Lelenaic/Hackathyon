<?php
use Hackathyon\Api;
$api=new Api($key,$action,$category,$query);
echo $api->getData();
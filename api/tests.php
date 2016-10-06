<?php

try{
    file_get_contents('http://localhost/public/12345/get/rental/1');
}catch (Exception $e){
    throw new Exception('$e');
}


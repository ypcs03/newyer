<?php
include_once 'component/Router/Router.class.php';
$url = new Router(); 
$url->getRouter(1); 
print_r($url); //在这里可以看到各元素 
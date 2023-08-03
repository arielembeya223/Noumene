<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$router = new AltoRouter();
$router->map('GET', '/', function() {
    require  dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/index.php';
},'home');
$match = $router->match();
if(is_array($match)){
    $match['target']();
}else{
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/404.php';
}
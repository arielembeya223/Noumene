<?php

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$router = new AltoRouter();
//homme page
$router->map('GET', '/', function() {
    require  dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/index.php';
},'home');
//
//page des articles
$router->map('GET', '/[a:auteur]/[a:name]', function() {
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . '/views/article.php';
  }, 'article');
  //

$match = $router->match();
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/template/header.php';
if(is_array($match)){
    global $router;
    global $params;
    $params= $match['params'];
    $match['target']();
    
}else{
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/404.php';
}
require  dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/template/footer.html';
 

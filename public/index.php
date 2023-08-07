<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$router = new AltoRouter();
//homme page
$router->map('GET', '/', function() {
    require  dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/index.php';
},'home');
//
//page des articles
$router->map('GET', '/[*:auteur]/[*:name]', function() {
    
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . '/views/article.php';
  }, 'article');
  //

$match = $router->match();
if(is_array($match)){
    global $router;
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/template/header.php';
    $match['target']();
    require  dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/template/footer.php';
}else{
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/404.php';
}
 

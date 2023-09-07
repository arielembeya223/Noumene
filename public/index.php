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
//page d' inscription
$router->map('POST|GET', '/login', function() {
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . '/views/login.php';
  }, 'login');
  //
  //page d'inscription
  $router->map('GET', '/[i:id]-[a:token]', function() {
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . '/views/connect.php';
  }, 'connect');
  //
  //page de compte
  $router->map('GET', '/users/compte/[a:name]', function() {
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . '/views/compte.php';
  }, 'compte');
  //
  //page de connexion
  $router->map('POST|GET', '/connexion', function() {
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . '/views/connexion.php';
  }, 'connexion');
  //
  //page d'oubli de mot de passe
  $router->map('GET', '/forgot', function() {
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . '/views/forgot.php';
  }, 'forgot');
  //
  //page de changement de mot de passe
  $router->map('GET', '/compte/modif/[a:reset]', function() {
    require dirname(__DIR__) . DIRECTORY_SEPARATOR . '/views/passmodif.php';
  }, 'modif');
  //
    // d'edification
    $router->map('POST|GET', '/compte/edit/[a:name]', function() {
      require dirname(__DIR__) . DIRECTORY_SEPARATOR . '/views/ecrire.php';
    }, 'ecrire');
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
 

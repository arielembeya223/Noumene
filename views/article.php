<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Getpdo;
global $router;
$pdo=new  Getpdo;
$db=$pdo::connect();


?>
article

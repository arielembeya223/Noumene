<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Getpdo;
use App\Hash;
$faker = Faker\Factory::create();
$dates= new DateTime();
$date=$dates->format('Y-m-d H:i:s');
$connecte= new Getpdo();
$db=$connecte::connect();
$protect=new Hash;
$password=$protect::crypte('london');
$db->exec("INSERT INTO admin SET name='admin', password='{$password}'");


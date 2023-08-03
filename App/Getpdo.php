<?php
namespace App;
use PDO;
class Getpdo{
    public static function connect():PDO{
        $pdo=new PDO('mysql:host=localhost;dbname=noumene;port=3308','root','root',[
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
        ]);
        return $pdo;
    }
}
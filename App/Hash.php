<?php
namespace App;
class Hash{
    public static function crypte(string $string):string
    {
     $p= password_hash($string,PASSWORD_BCRYPT);
     return $p;
    }
}
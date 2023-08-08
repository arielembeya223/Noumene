<?php
namespace App;
use PDO;
class Querybulder{
       public $pdo;
       public function __construct( PDO $pdo)
       {
        $this->pdo=$pdo;
       }
       public function count(string $element,string $table, $condition=" "):int
       {
        $bd=$this->pdo;
        $query=$bd->query("SELECT count($element) FROM $table $condition "); 
        $fetch=(int)($query->fetch()[0]);
        return $fetch;
       }
      
}
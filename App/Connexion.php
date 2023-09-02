<?php 
namespace App;
use PDO;
class connexion{
    public $array;
    public function __construct(array $array)
    {
        $this->array=$array;
    }
   public function init(){
    $_SESSION["auth"]=$this->array;
   }  
   public function remember(PDO $pdo,string $string){
    $id = explode(';',$string)[1];
    $prepare = $pdo->prepare("SELECT * FROM users WHERE id=:id");
    $prepare->execute(['id'=>$id]);
    $fetch=$prepare->fetch(PDO::FETCH_ASSOC);
    if($fetch["token"]=== null){
       $_SESSION["auth"]=$fetch;
       return  $_SESSION["auth"];
    }else{
      return null;
    }
   }
}
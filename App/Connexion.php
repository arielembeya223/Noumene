<?php 
namespace App;
class connexion{
    public $array;
    public function __construct(array $array)
    {
        $this->array=$array;
    }
   public function init(){
    $_SESSION["auth"]=$this->array;
   }
    
}
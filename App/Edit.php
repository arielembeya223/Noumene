<?php
namespace App;
use PDO;
use DateTime;
Class Edit{
public $pdo;
public $name;
public $content;
public $auteur;
public $slug;
public $created_at;
public $categorie;
    public function __construct(string $name,string $content)
    {
        $this->name=$name;
        $this->content=$content;
    }
    public  function verify()
    { 
        $error=[];
        if(preg_match("#[^AZa-z0-9_\.]#", $this->name)){
            $error["name"] = "essayer de changer le nom de l'article";
        }
        if(strlen($this->content)<=20){
           $error["content"] = "le contenue de l'article est trop petit";
        }
        if(!empty($error)){
            return $error;
        }else{
            return true;
        }
    }
}
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
            $error["name"] = "essayer de changer le nom de l'article ,eviter les esspaces et les majuscules";
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
    public function insert(PDO $pdo,string $auteur,string $slug,$created_at,string $categorie)
    {$name=$this->name;
      $content=$this->content;
      $prepare = $pdo->prepare("INSERT INTO article SET name=:name,content=:content,auteur=:auteur,slug=:slug,created_at=:created_at,categorie=:categorie");
      $prepare->execute([
        "name"=>$name,
         "content"=>$content,
         "auteur"=>$auteur,
         "slug"=>$slug,
         "created_at"=>$created_at,
         "categorie"=>$categorie
      ]);
      return $prepare;
    }
}
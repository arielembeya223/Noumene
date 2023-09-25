<?php
namespace App;
use PDO;
use DateTime;
Class Edit{
public $name;
public $content;
public $auteur;
public $slug;
public $created_at;
public $categorie;
public $pdo;
    public function __construct(string $name,string $content,PDO $pdo)
    {
        $this->name=$name;
        $this->content=$content;
        $this->pdo=$pdo;
    }
    public  function verify()
    { 
        $error=[];
        if(preg_match("#/[^AZa-z0-9\.\ ]/i#", $this->name)){
            $error["name"] = "essayer de changer le nom de l'article ,eviter les esspaces ,les majuscules et les underscores";
        }
        if(strlen($this->content)<=60){
           $error["content"] = "le contenue de l'article est trop petit";
        }
        if(!empty($error)){
            return $error;
        }else{
            return true;
        }
    }
    public function insert(string $auteur,string $slug,$created_at,string $categorie)
    {$name=$this->name;
      $content=$this->content;
      $prepare = $this->pdo->prepare("INSERT INTO article SET name=:name,content=:content,auteur=:auteur,slug=:slug,created_at=:created_at,categorie=:categorie");
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
    public function modif(string $auteur,string $slug,$created_at,string $categorie,int $id)
    {
        $name=$this->name;
        $content=$this->content;
        $prepare = $this->pdo->prepare("UPDATE  article SET name=:name,content=:content,auteur=:auteur,slug=:slug,created_at=:created_at,categorie=:categorie WHERE id=:id");
        $prepare->execute([
          "name"=>$name,
           "content"=>$content,
           "auteur"=>$auteur,
           "slug"=>$slug,
           "created_at"=>$created_at,
           "categorie"=>$categorie,
           "id"=>$id
        ]);
        return $prepare;
      }    
    }

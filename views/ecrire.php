<?php 
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\connexion;
use App\Getpdo;
global $router;
global $params;
$name=$params["name"];
if(!empty($_SESSION["auth"])){
    if($_SESSION["auth"]["name"] !== $name){
        require "404.php";
       die();  
    }
}else{
    require "404.php";
    die();
}
$categories=["culture","sciences","litterature","Poesie","Musique","Art","Informatique","info","sport","autre"];
if(!empty($_POST)){
$dates= new DateTime();
$date=$dates->format('Y-m-d H:i:s');
$name=$_POST["name"];
$content=$_POST["content"];
$auteur=$_SESSION["auth"]["name"];
$slug=str_shuffle("abcdefghtyuiiiiiooopbvnchduwuw");
$created_at=$date;
$categorie=$_POST["categorie"];
}
?>
<div class="container">
<h1 class="text-center mb2">creer un nouvel article<h1>
<form action="" method="POST">
  <div class="form-group">
  <div class=" d-none text-danger regex-ajout">mauvais format de nom veuillez le changer, evitez de mettre des espaces</div>
         <label for="name">Titre</label>
         <input type="text" class="form-control regex-nom" id="name" name="name">
   </div>
   <div class="form-group">
         <label for="name">contenu de l'article</label>
         <textarea  class="form-control" name="content"></textarea>
   </div>
   <div class="form-group">
         <label for="name">categorie de l'article</label>
         <select class="form-control" name="categorie">
            <?php foreach($categories as $category):?>
            <option value="<?=$category?>"><?=$category?></option>
            <?php endforeach ?>
         </select>
   </div>
   <button class="btn btn-success">Creer l'article</button>
</form>
</div>

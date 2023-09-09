<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Getpdo;
global $router;
global $params;
$pdo= Getpdo::connect();
$prepare = $pdo->prepare("SELECT * FROM article WHERE name=:name");
$prepare->execute(["name"=>$params["name"]]);
$content=$prepare->fetch(PDO::FETCH_OBJ);
$categories=["culture","sciences","litterature","Poesie","Musique","Art","Informatique","info","sport","autre"];
require "nav.php"
?>
<div class="container">
<h1 class="text-center mb2">modifier  l'article <?=$params["name"]?><h1>
<form action="" method="POST">
  <div class="form-group">
  <div class=" d-none text-danger regex-ajout" style="font-size:20px;">mauvais format de nom veuillez le changer, evitez de mettre des espaces les majuscules et les underscores</div>
         <label for="name">Titre</label>
         <input type="text" class="form-control regex-nom" id="name" name="name" value="<?=$content->name?>">
   </div>
   <div class="form-group">
         <label for="name">contenu de l'article</label>
         <textarea  class="form-control" name="content"><?=$content->content?></textarea>
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
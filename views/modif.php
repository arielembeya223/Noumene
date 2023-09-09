<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Edit;
use App\Getpdo;
global $router;
global $params;
$pdo= Getpdo::connect();
$prepare = $pdo->prepare("SELECT * FROM article WHERE name=:name");
$prepare->execute(["name"=>$params["name"]]);
$content=$prepare->fetch(PDO::FETCH_OBJ);
if($content){
  if($_SESSION["auth"]["name"] !== $content->auteur){
        require "404.php";
        die();
   }
$id=(int)($content->id);
$categories=["culture","sciences","litterature","Poesie","Musique","Art","Informatique","info","sport","autre"];
$error=null;
$success=null;
if(!empty($_POST)){
$dates= new DateTime();
$date=$dates->format('Y-m-d H:i:s');
$name=$_POST["name"];
$content=$_POST["content"];
$auteur=$_SESSION["auth"]["name"];
$slug=str_shuffle("abcdefghtyuiiiiiooopbvnchduwuw");
$created_at=$date;
$categorie=$_POST["categorie"];
$pdo=Getpdo::connect();
$edit=new Edit($name,$content,$pdo);
$verify= $edit->verify();
if(!(is_array($verify))){
    $edit->modif($auteur,$slug,$created_at,$categorie,$id);
    $lien = $router->generate("article",["auteur"=>$auteur,"name"=>$name]);
    $success="votre article a bien ete modifie voici le lien pour le consulter";
}else{
    $error=$verify;
}
}
}else{
    require "404.php";
    die();
}
require "nav.php"
?>
<div class="container">
<?php if ($error !== NULL):?>
    <?php foreach($error as $e):?>
        <div class="alert alert-danger" role="alert">
            <?=$e?>
        </div>
    <?php endforeach ?>
<?php endif ?>
<?php if ($success !== NULL):?>
        <div class="alert alert-success" role="alert">
            <?=$success ?> <a href="<?=$lien?>">votre article</a>
        </div>
<?php endif ?>
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
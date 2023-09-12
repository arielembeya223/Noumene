<?php 
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Getpdo;
use App\LittleContent;
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
$auteur=$_SESSION["auth"]["name"];
$pdo = Getpdo::connect();
$prepare = $pdo->prepare("SELECT * FROM article WHERE auteur=:auteur");
$prepare->execute(["auteur"=>$auteur]);
$contents=$prepare->fetchAll(PDO::FETCH_OBJ);
?>
<?php require "nav.php"?>
<div class="container">
     <div class="text-center mb2 mt-5">
        <h1><?=$_SESSION["auth"]["name"]?><h1>
        <a class="btn btn-success" href="<?=$router->generate("ecrire",["name"=>$_SESSION["auth"]["name"]])?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
           <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
           </svg>ecrire un article
       </a>
       <?php if($contents):?>
       <h1>vos articles</h1>
       <?php endif?>
     </div>   
</div>
<main class="d-flex justify-content-center   flex-wrap">
<?php foreach($contents as  $content): ?>
  <div class="card text-white bg-dark m-3" style="max-width: 18rem;">
  <div class="card-header"><div class="text-center"><?=$content->name?></div></div>
  <div class="card-body">
    <h5 class="card-title text-center"><a href="<?=$router->generate("modification",['name'=>$content->name])?>"  class="btn btn-success">modifier l'article</a></h5>
    <p class="card-text"> <a href="<?php echo $router->generate("article",['auteur'=>$content->auteur,'name'=>$content->name])?>" class="btn btn-success">lire l'article</a></p>
  </div>
</div>
<?php endforeach ?>
</main>

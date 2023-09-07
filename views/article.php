<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Getpdo;
use App\LittleContent;

global $router;
global $params;
$pdo=new  Getpdo;
$db=$pdo::connect();
$auteur=$params["auteur"];
$name=$params["name"];
$instance=$db->prepare("SELECT * FROM article WHERE name=:name AND auteur=:auteur");
$instance->execute([
    'name'=>$name,
    'auteur'=>$auteur
]);
$resolutions=$instance->fetchAll(PDO::FETCH_OBJ);
if(empty($resolutions)){
    require "404.php";
    die("aucun article ne correspond a cette requete");
} 


if($_GET){
    $getpseudo=new  Getpdo;
    $getcomment=$pdo::connect(); 
    $pseudo = $_GET['pseudo'] ?? $_SESSION["auth"]["name"];
    $precomment=$getcomment->prepare("INSERT INTO commentaires SET pseudo=:pseudo,content=:content,param_auteur=:auteur,param_name=:name");
    $precomment->execute([
       "pseudo"=>$pseudo,
        "content"=>$_GET['commentaire'],
        "auteur"=>$auteur,
        "name"=>$name
    ]);
}

$getcommentparam=new  Getpdo;
$preparation=$getcommentparam::connect();
$commentaires=$preparation->prepare("SELECT * FROM commentaires  WHERE param_auteur=:auteur AND param_name=:name");
$commentaires->execute([
   'auteur'=>$auteur,
    'name'=>$name
]);
$finitos=$commentaires->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container">
  <article> 
      <!--gestion de l'affichage d'article-->
      <?php foreach($resolutions as $resolution):?>
            <h1><?=$resolution->name?></h1>
            <h1><p>publie le: <?=$resolution->created_at?> par <?= $resolution->auteur?></p></h1>
            <p><?=nl2br($resolution->content)?></p>
      <!---->
      <!--insertion des commentaires-->
      <h2>Les commentaires</h2>
      <form action="" method="GET">
        <?php if(empty($_SESSION["auth"])):?>
          <div class="row mb-2">
              <div class="col-sm">
                    <input type="texte" class="form-control" id="exampleFormControlInput1" placeholder=" nom ou pseudo" name="pseudo">
                </div> 
           </div>
         <?php endif ?>  
            <textarea class="form-control mb-2"  id="exampleFormControlTextarea1"   style="min-height: 150px;" placeholder="laissez nous un commentaire !"  name="commentaire"></textarea>
            <input class = "btn btn btn-success me-1" type="submit"></input>
      </form>     
            <!-- gestion des commentaires-->   
        <?php foreach($finitos as $finito):?>
                <article class="mb-4">
                    <div class="mb-1"><strong class="js-username"><?=$finito->pseudo?></strong></div>
                    <p class="js-content"><?=$finito->content?></p>
                </article>
         <?php endforeach ?>
             <!---->
             <!--listing d'article lie a cet article-->
            <?php
              $listing=new  Getpdo;
               $connexion=$listing::connect();
                 $prepare=$connexion->prepare("SELECT * FROM article WHERE categorie=:categorie LIMIT 5 ");
                $prepare->execute(["categorie"=>$resolution->categorie]);
                 $fins=$prepare->fetchAll(PDO::FETCH_OBJ);
                    $countable=count($fins);
                  ?>
                      <div class="container d-flex h-100">
                        <div class="row align-self-center">
            <?php if($countable>1):?>
                               <h3>ces articles pourront vous interesser</h3>
              <?php endif?>
                <?php if($countable===1):?>
                                <h3>cette article pourra vous interesser</h3>
                  <?php endif?>
                  <?php if($countable===0):?>
                                     <h3></h3>
                    <?php endif?>
                 <?php foreach($fins as $fin):?>                    
                                  <a href="<?=$router->generate('article',['auteur'=>$fin->auteur,'name'=>$fin->name])?>"><?=$fin->name?></a></br>
                  <?php endforeach ?>                                 
      <?php endforeach ?>
  </article>
</div>


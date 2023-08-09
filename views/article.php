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


if(!empty($_GET['pseudo']) && !empty($_GET['commentaire'])){
    $getpseudo=new  Getpdo;
    $getcomment=$pdo::connect(); 
    $precomment=$getcomment->prepare("INSERT INTO commentaires SET pseudo=:pseudo,content=:content,param_auteur=:auteur,param_name=:name");
    $precomment->execute([
       "pseudo"=>$_GET['pseudo'],
        "content"=>$_GET['commentaire'],
        "auteur"=>$auteur,
        "name"=>$name
    ]);
}
?>  
<?php foreach($resolutions as $resolution):?>
    <div class="container d-flex h-100 w-100">
    <div class="row align-self-center">
        
    <h1 class="text-decoration-underline"><?= $resolution->name?></h1>
                   <p>publie le: <?=$resolution->created_at?> par <?= $resolution->auteur?></p>
                   <p><?=nl2br($resolution->content)?></p> 

    </div>
</div>
  
                       
                              
    </div>
</div>
<div class="container d-flex h-100">
    <div class="row align-self-center">
        <h6>postez un commentaire</h6>
    </div>   
</div>        
<div class="container d-flex h-100">
    <div class="row align-self-center">
       <form action="" method="GET">
        <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Nom</label>
  <input type="texte" class="form-control" id="exampleFormControlInput1" placeholder=" nom ou pseudo" name="pseudo">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">commentaire</label>
  <textarea class="form-control" id="exampleFormControlTextarea1"  placeholder="laissez nous un commentaire !"  name="commentaire"></textarea>
</div> 
<input class = "btn btn btn-success me-1" type="submit"></input>
        </form>
    </div>   
</div>       

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



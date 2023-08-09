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
//Times New Roman" 
?>  
<?php foreach($resolutions as $resolution):?>
    
    <div class="d-flex">
            <div class="p-2 flex-fill">
                 <div class="p-2 flex-fill">Auteur:<?= $resolution->auteur?></div>
                 <div class="p-2 flex-fill">publie le: <?=$resolution->created_at?></div>
                 <h1 class="text-decoration-underline"><?= $resolution->name?></h1>
                 <p><?=$resolution->content?></p> 
                        <?php
                          $listing=new  Getpdo;
                          $connexion=$listing::connect();
                            $prepare=$connexion->prepare("SELECT * FROM article WHERE categorie=:categorie LIMIT 5");
                            $prepare->execute(["categorie"=>$resolution->categorie]);
                             $fins=$prepare->fetchAll(PDO::FETCH_OBJ);
                               $countable=count($fins);
                              ?>
                              <?php if($countable>1):?>
                              <h1>ces articles pourront vous interesser</h1>
                              <?php endif?>
                              <?php if($countable===1):?>
                              <h1>cette article pourra vous interesser</h1>
                              <?php endif?>
                              <?php if($countable===0):?>
                              <h1></h1>
                              <?php endif?>
                   <?php foreach($fins as $fin):?>
                    <div class="p-2 flex-fill">
                         <a href="<?=$router->generate('article',['auteur'=>$fin->auteur,'name'=>$fin->name])?>"><?=$fin->name?></a>
                    </div>

                    <?php endforeach ?>
            </div>       
    </div>
<?php endforeach ?>




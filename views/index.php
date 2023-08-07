<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use App\Getpdo;
use App\LittleContent;
global $router;

$pdo=new  Getpdo;
$db=$pdo::connect();
$contents=$db->query("SELECT * FROM article")->fetchAll(PDO::FETCH_OBJ);




?>

<section class="header1 cid-s6S0y5nekw mbr-fullscreen " id="header01-0">
    <div class="align-center container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 padding col-lg-10">
               <h1 class="mbr-text mbr-fonts-style display-1">Écrivez et partagez des articles grace à</h1><p class="mbr-text mbr-fonts-style display-1 text-success">Noumene</p>
               <div class="main">
  
                                                                                                                                               
               <form class = "d-flex" >  
  <bouton class = "btn btn btn-success me-1"  type = "soumettre" >Rechercher</bouton>
  <input class = "form-control" type = "search" placeholder = "vous recherchez?" aria-label = "Rechercher" >    
</form>                 
                                                         
            
            </div>
        </div>
    </div>
</section>

<section class="features6 cid-s6S1tUtSWp" id="features06-e">
 <h1 class="text-md-center mt-5">les derniers aricles</h1>
<main class="d-flex justify-content-center   flex-wrap">
<?php foreach($contents as  $content): ?>
  
  <?php $extrait= new LittleContent($content->content)?> 
<div class="card m-5 rounded border border-success" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><?=$content->name?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?=$content->auteur?></h6>
    <p class="card-text"><?=$extrait->extrait()?></p>
    <a class="card-link"><?=$content->created_at?></a>
    <a href="<?php echo $router->generate("article",['auteur'=>$content->auteur,'name'=>$content->name])?>" class="card-link">lire l'article</a>
  </div>
</div>
  
<?php endforeach ?>
</main>


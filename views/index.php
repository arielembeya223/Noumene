<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

use App\Getpdo;
use App\LittleContent;
use App\Querybulder;

global $router;
$limit=10;
$pdo=new  Getpdo;
$db=$pdo::connect();
$req="SELECT * FROM article ORDER by created_at DESC";
$totals=new Querybulder($db);
$total=$totals->count('id','article');
$paginates=ceil($total/$limit);
$page=$_GET["page"]??1;
if(($page>$paginates)|| ($page<=0)){
  $page=1;
  header('Location:' . $router->generate('home'));
}
$offset=($page-1)*$limit;
if(!empty($_GET['q'] )){
  $req_extens= " WHERE name  LIKE  " .  "'%" . htmlentities($_GET['q']) . "%'" . "OR auteur LIKE  " .  "'%" . htmlentities($_GET['q']) . "%'";
  $req = $req . $req_extens;
}
$req=$req . " LIMIT $limit OFFSET $offset";
$contents=$db->query($req)->fetchAll(PDO::FETCH_OBJ);
$count=count($contents);
?>

<section class="header1 cid-s6S0y5nekw mbr-fullscreen " id="header01-0">
    <div class="align-center container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 padding col-lg-10">
               <h1 class="mbr-text mbr-fonts-style display-1">Écrivez et partagez des articles grace à</h1><p class="mbr-text mbr-fonts-style display-1 text-success" id="noumene">Noumene</p>
               <div class="main">
  
                                                                                                                                               
               <form class = "d-flex"  action="" method="GET">  
  <input class = "form-control" type = "search" placeholder = "vous recherchez?" name="q">  
  <button class = "btn btn btn-success me-1" type="submit"><i class="bi bi-search"></i></button>  
</form>                 
                                                         
            
            </div>
        </div>
    </div>
</section>
<section class="features6 cid-s6S1tUtSWp" id="features06-e">
  <?php if(empty($_GET['q'])):?>
 <h1 class="text-md-center mt-5">les derniers aricles</h1>
  <?php endif?>
  <?php if(!empty($_GET['q']) && ($count != 0)):?>
 <h3 class="text-md-center mt-5">les resultats de votre recherche</h3>
  <?php endif?>
  <?php if(($count === 0) && !empty($_GET['q'])):?>
 <h3 class="text-md-center mt-5">Aucun resultat correspondant a votre recherche n'a ete trouve</h3>
  <?php endif?>
<main class="d-flex justify-content-center   flex-wrap">
<?php foreach($contents as  $content): ?>
  <?php $extrait= new LittleContent($content->content)?>
  <div class="" data-toggle="tooltip" data-placement="top" title="<?="contenue  lié  à la " . $content->categorie?>">
     <div class="card m-5 rounded border border-success" id="card" style="width: 18rem;">
       <div class="card-body">
         <h5 class="card-title"><?=$content->name?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?=$content->auteur?></h6>
        <p class="card-text"><?=$extrait->extrait()?></p>
        <a class="card-link"><?=$content->created_at?></a>
        <a href="<?php echo $router->generate("article",['auteur'=>$content->auteur,'name'=>$content->name])?>" class="card-link">lire l'article</a>
       </div>
     </div>
   </div>
<?php endforeach ?>
</main>
<?php if(empty($_GET['q'])):?>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="<?=$router->generate("home")?>?page=<?=$page-1?>">Precedent</a>
    </li>
    <?php for($i=1;$i<=$paginates;$i++):?>
    <li class="page-item"><a class="page-link" href="<?=$router->generate("home")?>?page=<?=$i?>"><?=$i?></a></li>
    <?php endfor ?>
    <li class="page-item">
      <a class="page-link" href="<?=$router->generate("home")?>?page=<?=$page+1?>">suivant</a>
    </li>
  </ul>
</nav>
<?php endif?>



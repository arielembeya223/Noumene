<?php

use App\Getpdo;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$pdo=new  Getpdo;
$db=$pdo::connect();


require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/template/header.php';

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
<main>

<div class="card m-5" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>
</main>

<?php require  dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views/template/footer.php';
?>
<?php
require dirname(__DIR__,2) . DIRECTORY_SEPARATOR . "vendor/autoload.php";
use App\Getpdo;
use App\Redirect;
use App\Session;
use App\connexion;

$session = new Session();
$session->start();
if(isset($_GET['deconnexion'])){
unset($_SESSION["auth"]);
$redirect=new Redirect("" . $router->generate("home"));
$redirect->go();
}
if($_COOKIE["secret"]){
  $db=new Getpdo();
  $pdo=$db::connect();
  $connexion = new connexion([]);
$connexion->remember($pdo,$_COOKIE["secret"]);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="partagez votre savoir librement est cela dans le monde entier, cultivez vous et apprenez aussi grace au autre article qui sont disponibles sur Noumene">
    <meta name="keywords" content="Civilisation  Culturelle Littérature Éducation Préhistoire Civilisation Culturelle Littérature Éducation Gastronomie Culturation Diversité Religion Tradition Musique Citoyenneté Science  Poésie Philosophie Paralittérature Sociologie Culture Philologie Mythologie Narratologie Littéraires Grammaire Science Jeunesse Historiographie  Pedagogie Ecole Emancipation Educateurs Educatives Economie Evaluation Educatrice Educate Educateur Parentalite  Poésie Claudélienne Poétisation Poéticité">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link  href="../image/Noumene.png" type="image/png"/> 
    <title>Noumene</title>
  </head>
<body>
<style>
  body{
    font-family: "Times New Roman";
  }
</style>    
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4 ">
  <div class="container-fluid">
    <a class="navbar-brand">Menu</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?=$router->generate("home")?>">acceuille</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">voir les articles </a>
        </li>
        <?php if (empty($_SESSION["auth"])):?>
          <li class="nav-item">
             <a class="nav-link" href="<?=$router->generate("login")?>">s'inscrire</a>
          </li>
          <?php else: ?>
            <li class="nav-item">
             <a class="nav-link" href="<?=$router->generate("compte",["name"=>$_SESSION["auth"]["name"]])?>">Mon compte</a>
          </li>
        <?php endif ?>
      </ul>
      <?php if (!empty($_SESSION["auth"])):?>
         <div class="d-flex">
            <a class="btn btn-outline-success deconect"  data-bs-toggle="modal" data-bs-target="#example">se deconnecter</a>
         </div>
       <?php else:?> 
          <div class="d-flex">
            <a class="btn btn-outline-success" href="<?=$router->generate("connexion")?>">se connecter</a>
         </div>
      <?php endif ?>
    </div>
  </div>
</nav>
<div class="modal" tabindex="-1" role="dialog" id="example">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">deconnexion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>vous etez sur de vouloir vous deconnecter?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"   data-bs-dismiss="modal">non fermez la boite modal</button>
        <a type="button" class="btn btn-primary" href="?deconnexion">oui j'en suis sur</a>
      </div>
    </div>
  </div>
</div>


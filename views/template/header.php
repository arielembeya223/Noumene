<?php
/**
 * changer le site dans users
 * changer l 'email dans mail et le secret dans mail
 * pdo dans getpdo
 * localhost:8000 dans forgot ligne 8
 */
require dirname(__DIR__,2) . DIRECTORY_SEPARATOR . "vendor/autoload.php";
use App\Getpdo;
use App\Redirect;
use App\Session;
use App\connexion;
$session = new Session();
$session->start();
if(isset($_GET['deconnexion'])){
unset($_SESSION["auth"]);
setcookie("secret",NULL,-1);
$redirect=new Redirect("" . $router->generate("home"));
$redirect->go();
}
if(!empty($_COOKIE["secret"])){
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
          <a class="nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
  <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
  <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
</svg>  forum </a>
        </li>
        <?php if (empty($_SESSION["auth"])):?>
          <li class="nav-item">
             <a class="nav-link" href="<?=$router->generate("login")?>">s'inscrire</a>
          </li>
          <?php else: ?>
            <li class="nav-item">
             <a class="nav-link" href="<?=$router->generate("compte",["name"=>$_SESSION["auth"]["name"]])?>"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg> Mon compte</a>
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


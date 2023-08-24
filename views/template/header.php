<?php
use App\Session;
require dirname(__DIR__,2) . DIRECTORY_SEPARATOR . "vendor/autoload.php";
$session = new Session();
$session->start();
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
          <a class="nav-link" aria-current="page" href="/">acceuille</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">voir les articles </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/login">s'inscrire</a>
        </li>
        <li class="nav-item">
          <a class="nav-link">se connecter</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="nom d'utilisateur" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">chercher</button>
      </form>
    </div>
  </div>
</nav>

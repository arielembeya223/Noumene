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
    <link rel="icon" type="image/png" href="../image/Noumene.png"/> 
    
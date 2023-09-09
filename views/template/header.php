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


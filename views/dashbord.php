<?php 
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Getpdo;
global $router;
if(empty($_SESSION["dashbord"])){
    header("Location:" . $router->generate("dashLogin"));
}
$pdo= Getpdo::connect();
$articles = $pdo->query("SELECT Count(id) FROM article")->fetch()[0];
$users=$pdo->query("SELECT Count(id) FROM users")->fetch()[0];
$users_identifie=$pdo->query("SELECT Count(id) FROM users WHERE token IS NULL")->fetch()[0];
$users_non_identifie=($users-$users_identifie);
$commentaires=$pdo->query("SELECT Count(id) FROM commentaires")->fetch()[0];
$moyenne_commentaires=round($commentaires/$articles);
require "nav.php"
?>
<div class="container">
    <div class="text-center">
        <h1>dashbord</h1>
    </div>
    <div class="d-flex justify-content-center">
      <div class="bg-green mt-3 h-50 d-inline-block" style="min-width: 300px;">
        hhhhhhhhhhhh
      </div>
    </div>
</div>

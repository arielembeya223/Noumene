<?php 
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Hash;
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
$success=null;
if(isset($_POST["name"]) && isset($_POST["password"])){
    $post_name=htmlentities($_POST["name"]);
    $post_password=(htmlentities($_POST["password"]));
    $hash= Hash::crypte($post_password);
    $pdo=Getpdo::connect();
    $req=$pdo->prepare("UPDATE admin SET name=:name, password=:password");
    $req->execute([
      "name"=>$post_name,
      "password"=>$hash
    ]);
    $success="vos informations ont ete modifies";
}
$supprime=NULL;
if(isset($_POST["supprimer_nom"]) && isset($_POST["supprimer_nom"])){
    $name=htmlentities($_POST["supprimer_nom"]);
    $auteur=htmlentities($_POST["supprimer_auteur"]);
  $pdo=Getpdo::connect();
  $req=$pdo->prepare("DELETE FROM article WHERE name=:name AND auteur=:auteur LIMIT 1");
  $req->execute([
    "name"=>$name,
    "auteur"=>$auteur
  ]);
  $supprime="l'article a ete supprime";
}
require "nav.php"
?>
<div class="container">
    <div class="text-center">
        <h1>dashbord</h1>
    </div>
    <div class="card text-center">
  <div class="card-body">
    <h5 class="card-title">Nombre d'inscription</h5>
    <p class="card-text text-success"><h1 class="text-success"><?=$users?></h1></p>
    <span class="">confirme et non confirme</span>
  </div>
</div>
</div>
<main class="d-flex justify-content-center   flex-wrap">
<div class="card text-white bg-primary m-3" style="max-width: 18rem;">
  <div class="card-header">Nombre d'utilisateur</div>
  <div class="card-body">
    <h5 class="card-title text-center"><?=$users_identifie?></h5>
    <p class="card-text"> ce nombre correspond aux utilisateurs ayant clique sur le lien qui leur ont ete envoye</p>
  </div>
</div>
<div class="card text-white bg-danger m-3" style="max-width: 18rem;">
  <div class="card-header">utilisateur non identifie</div>
  <div class="card-body">
    <h5 class="card-title text-center"><?=$users_non_identifie?></h5>
    <p class="card-text">ce nombre correspond aux utilisateurs n'ayant pas  clique sur le lien qui leur ont ete envoye</p>
  </div>
</div>
<div class="card text-white bg-success m-3" style="max-width: 18rem;">
  <div class="card-header">Nombre d'article</div>
  <div class="card-body">
    <h5 class="card-title text-center"><?=$articles?></h5>
    <p class="card-text">ce nombre correspond aux nombres d'article ecrit par les utilisateurs</p>
  </div>
</div>
<div class="card text-white bg-secondary m-3" style="max-width: 18rem;">
  <div class="card-header">Nombre de commentaires</div>
  <div class="card-body">
    <h5 class="card-title text-center"><?=$commentaires?></h5>
    <p class="card-text">ce nombre correspond aux nombres totales de commntaire ecrit</p>
  </div>
</div>
<div class="card bg-light m-3" style="max-width: 18rem;">
  <div class="card-header">Moyenne des commentaires par article</div>
  <div class="card-body">
    <h5 class="card-title text-center"><?=$moyenne_commentaires?></h5>
    <p class="card-text">ce nombre a la moyenne des commentaires par article</p>
  </div>
</div>
</main>
<div class="container">
  <h4 class="text-center">Modifier les informations de l'administrateur</h4>
<form action="" method="POST">
<?php if ($success !== NULL):?>
        <div class="alert alert-success" role="alert">
            <?=$success?>
        </div>
<?php endif ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Modifier le nom de l'administrateur</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="name"  placeholder="nom d'admin" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Modifier le mot de passe</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="mot de passe admin" required>
  </div>
  <button type="submit" class="btn  btn-success mt-2">Submit</button>
</form>
</div>
<div class="container">
  <h4 class="text-center text-danger">Supprimer un article</h4>
  <?php if ($supprime !== NULL):?>
        <div class="alert alert-danger" role="alert">
            <?=$supprime?>
        </div>
<?php endif ?>
  <form action="" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">article</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="supprimer_nom"  placeholder="nom de l'article a supprime" required>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">auteur</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="supprimer_auteur"  placeholder="nom de l'auteur" required>
  </div>
  <button type="submit" class="btn  btn-danger mt-2" onclick="return confirm('Voulez vous vraiment effectuer cette action ?')">Supprimer</button>
</form>
</div>
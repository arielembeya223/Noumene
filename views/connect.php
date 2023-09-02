<?php
 require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
 use App\Redirect;
 use App\connexion;
 use App\Getpdo;
 global $params;
  global $router;
  if(!empty($_SESSION["auth"])){
  $redirect=new Redirect("" . $router->generate("compte",["name"=>$_SESSION["auth"]["name"]]));
   $redirect->go();
  }
 $id=$params["id"];
 $token=$params["token"];
$db=new Getpdo();
$pdo=$db::connect();
$prepare = $pdo->prepare("SELECT * FROM users WHERE id=:id AND token=:token");
$prepare->execute([
    "id"=>$id,
    "token"=>$token
]);
$results=$prepare->fetch(PDO::FETCH_ASSOC);
if($results){
    $name = $results["name"];
     $newdb= new Getpdo();
     $newpdo= $newdb::connect();
     $base=$newpdo->prepare("UPDATE users SET token=NULL,token_at=NULL WHERE name=:name");
     $base->execute(["name"=>$name]);
     $Sdb=new Getpdo();
     $Spdo=$Sdb::connect();
$Sprepare = $Spdo->prepare("SELECT * FROM users WHERE id=:id");
$Sprepare->execute([
    "id"=>$id
]);
$Sresults=$Sprepare->fetch(PDO::FETCH_ASSOC);
     $connexion = new connexion($Sresults);
     $connexion->init();
    header("Location:" . $router->generate("compte",["name"=>$name]));
}else{
    require "404.php";
}
 ?>


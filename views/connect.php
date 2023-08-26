<?php
 require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
 use App\Getpdo;
 global $params;
  global $router;
 $id=$params["id"];
 $token=$params["token"];
$db=new Getpdo();
$pdo=$db::connect();
$prepare = $pdo->prepare("SELECT * FROM users WHERE id=:id AND token=:token");
$prepare->execute([
    "id"=>$id,
    "token"=>$token
]);
$results=$prepare->fetch(PDO::FETCH_OBJ);
if($results){
    dd($results);
}else{
    require "404.php";
}
 ?>


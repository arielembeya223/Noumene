<?php 
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Getpdo;
use App\Session;
global $router;
$pdo= Getpdo::connect();
$query=$pdo->query("SELECT * FROM admin")->fetch(PDO::FETCH_OBJ);
$success=null;
$error=null;
if(!empty($_POST)){
    $mom=$_POST["nom"];
    $password=$_POST["password"];
    if(($mom === $query->name) && (password_verify($password,$query->password))){
        $success= "bienvenue " . $query->name;
    }else{
       $error=" nom ou mot de passe incorect"; 
    }
}
if($success !== null){
  $_SESSION["dashbord"]="ok";
  header("Location:" . $router->generate("dashbord"));
}
require "nav.php"?>
<div class="container">
<?php if ($error !== NULL):?>
        <div class="alert alert-danger" role="alert">
            <?=$error?>
        </div>
<?php endif ?>
<?php if ($success !== NULL):?>
        <div class="alert alert-success" role="alert">
            <?=$success ?>
        </div>
<?php endif ?>
<form action="" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">nom</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="nom"  placeholder="votre nom" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="mot de passe" required>
  </div>
  <button type="submit" class="btn  btn-success mt-2">Submit</button>
</form>
</div>
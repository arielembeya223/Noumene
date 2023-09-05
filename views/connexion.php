<?php 
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Getpdo;
use App\connexion;
use App\Redirect;
global $router;
$error=null;
if(!empty($_GET)){
$email_name=$_GET["email"];
$password=$_GET["password"];
$db=new Getpdo;
$pdo=$db::connect();
$prepare=$pdo->prepare("SELECT * FROM users WHERE name=:input OR email=:input");
$prepare->execute(["input"=>$email_name]);
$fetch=$prepare->fetch(PDO::FETCH_ASSOC);
if($fetch){
    $real_password=$fetch["password"];
    if(password_verify($password,$real_password)){
        $connexion = new connexion($fetch);
        $connexion->init();
        if(!empty($_GET["remember"])){
          $lettre = "abcdefghijklmnopqrstuvABCDEFGHIJQLMNOPQRSTUVWXYZ";
        $repeat = str_repeat($lettre,30);
        $shuffle=str_shuffle($repeat);
        $first = substr($shuffle,1,15);
        $second= str_shuffle($first);
        $valeur = $first . ';' . $fetch["id"] . ';' . $three;
          setcookie("secret",$valeur,time()+60*60*4);
        }  
        }
        $redirect=new Redirect("" . $router->generate("compte",["name"=>$_SESSION["auth"]["name"]]));
        $redirect->go();
    }else{
        $error="nom ou mot de passe incorrect";   
    }
}
?>
       <?php if($error):?>
        <div class="alert alert-danger" role="alert"><?=$error?></div>
       <?php endif ?>
<div class="container">
<form action="" method="GET">
  <div class="form-group">
    <label for="exampleInputEmail1">adress email ou pseudo</label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="email"  placeholder="votre adresse email ou votre pseudo">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="mot de passe">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
    <label class="form-check-label" for="exampleCheck1">se rappeller de moi</label>
  </div>
  <div class="form-group mb-2">
   <a href="<?=$router->generate("forgot")?>" class="text-success">Mot de passe oublie</a>
  </div>
  <button type="submit" class="btn  btn-success">Submit</button>
</form>
</div>
<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Getpdo;
use App\Hash;
global $params;
$reset=$params["reset"];
$success=NULL;
if(!empty($_GET["password"])){
$db= new Getpdo();
$pdo = $db->connect();
$p=new Hash();
$password = $p::crypte($_GET["password"]);
$prepare =$pdo->prepare("UPDATE users SET password=:password WHERE reset_token=:reset_token");
$prepare->execute([
"password"=>$password,
"reset_token"=>$reset
]);
$success = " votre mot de passe vient d'etre modifie veuillez essayer de vous connecter maintenant";
}
?>
<div class="container">
<?php if($success !== NULL):?>
    <div class="alert alert-success" role="alert">
        <?php echo $success?>
    </div>
<?php endif ?>
<h1>modifier votre mot de passe</h1>
<form>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="nouveau mot de passe" name="password">
  </div>
  <button type="submit" class="btn btn-success mt-2">enregistrer</button>
</form>
</div>
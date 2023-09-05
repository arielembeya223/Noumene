<?php 
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Forgot;
use App\Getpdo;
global $router;
$error= NULL;
$success= NULL;
$lien="http://localhost:8000" . $router->generate("modif");
if(!empty($_GET['email'])){
    $db= new Getpdo;
    $pdo = $db->connect();
    $forgot = new Forgot($_GET['email'],$pdo);
    $verify= $forgot->verify();
    if($verify ===  true){
       $id = $forgot->get($lien);
       $success = "un message vous a ete envoye";
    }else{
     $error = $verify;
    }
}

?>
<?php if($error !== NULL):?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error?>
    </div>
<?php endif ?>
<?php if($success !== NULL):?>
    <div class="alert alert-success" role="alert">
        <?php echo $success?>
    </div>
<?php endif ?>
<div class="container">
    <form action="" method="GET">
      <div class="form-group">
         <label for="exampleInputEmail1">Entrer votre adresse email</label>
         <input type="email" class="form-control" laceholder="exemple@gmail.com" name="email">
         <small id="emailHelp" class="form-text text-muted">un email vous sera envoye pour pouvoir changer de mot de passe</small>
      </div>
      <button type="submit" class="btn btn-success">envoyer l'email</button>
    </form>
</div>
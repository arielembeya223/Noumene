<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Redirect;
use App\Getpdo;
use App\Users;
use App\Session;
global $router;
$session = new Session();
$session->start();
$var = null;
if(!empty($_SESSION["auth"])){
$redirect=new Redirect("" . $router->generate("compte",["name"=>$_SESSION["name"]]));
$redirect->go();
}
if(!empty($_POST)){
    $name=$_POST['username'];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $confirme=$_POST["comfirme"];
    $db=new Getpdo();
    $pdo=$db::connect();
    $users= new Users($pdo,$name,$email,$password,$confirme);
    $users->flashMessage($users->verify());
     if($_SESSION["flash"]["type"] === "success"){
        $users->insert("users");
        $users->mail();
        if(!empty($_GET["remember"])){
            $valeur = $users->cookie();
           setcookie("secret",$valeur,time()+60*60*4);
         }
     }
}
?>
<?php if (!empty($_SESSION["flash"])):?>
           <div class="alert alert-<?=$_SESSION["flash"]["type"]?>" role="alert">
                  <ul>
                      <?php foreach($_SESSION["flash"] as $type => $message):?>
                         <?php if(($message === "success") || ($message === "danger")):?>
                            <div class="d-none"><?=$message?></div>
                         <?php else:?>
                            <li><?=$message?></li>
                         <?php endif ?>
                      <?php endforeach ?>
                 </ul>
           </div>
<?php endif ?>
<?php unset($_SESSION["flash"])?>
<div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="POST">
                            <h3 class="text-center text-success">s'inscrire</h3>
                            <div class="form-group">
                                <div class=" d-none text-danger regex-ajout">mauvais format de nom veuillez le changer, evitez de mettre des espaces</div>
                                <label for="username" class="text-success">Nom:</label><br>
                                <input type="text" name="username" id="username" class="form-control regex-nom" placeholder="pseudo"   required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-success">email:</label><br>
                                <input type="text" name="email" id="email" class="form-control" placeholder="exemple@gmail.com" required>
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-success">mot de passe:</label><br>
                                <input type="password" name="password" id="password" class="form-control" required>
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label for="confirme" class="text-success">confirmer votre  mot de passe</label><br>
                                <input type="password" name="comfirme" id="confirme" class="form-control" required>
                                <div class="text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-success"><span>se rappeller de moi   </span><span><input id="remember-me" name="remember" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn btn-success btn-md" value="creer un compte">
                                <div class="text-success"></div>
                            </div>                  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
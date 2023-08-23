<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Getpdo;
use App\Users;
$errors= null;
if(!empty($_GET)){
    $name=$_GET['username'];
    $email=$_GET["email"];
    $password=$_GET["password"];
    $confirme=$_GET["comfirme"];
    $db=new Getpdo();
    $pdo=$db::connect();
    $users= new Users($pdo,$name,$email,$password,$confirme);
    $users->verify();
}



?>
<?php if(!empty($users->verify())):?>
<div class="alert alert-danger" role="alert">
  This is a danger alert—check it out!
</div>
<?php endif ?>
<div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="GET">
                            <h3 class="text-center text-success">s'inscrire</h3>
                            <div class="form-group">
                                <div class=" d-none text-danger regex-ajout">mauvais format de nom veuillez le changer</div>
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
                                <label for="remember-me" class="text-success"><span>se rappeller de moi   </span><span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn btn-success btn-md" value="creer un compte">
                                <div class="text-success"></div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
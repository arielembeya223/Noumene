<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
use App\Getpdo;
global $router;
global $params;
$pdo=new  Getpdo;
$db=$pdo::connect();
$auteur=$params["auteur"];
$name=$params["name"];
$instance=$db->prepare("SELECT * FROM article WHERE name=:name AND auteur=:auteur");
$instance->execute([
    'name'=>$name,
    'auteur'=>$auteur
]);
$resolutions=$instance->fetchAll(PDO::FETCH_OBJ);
if(empty($resolutions)){
    require "404.php";
    die("aucun article ne correspond a cette requete");
}
?>
<?php foreach($resolutions as $resolutions):?>
    <h1><?=$resolutions->name?></h1>
    <P><?=$resolutions->content?></P>
<?php endforeach ?>




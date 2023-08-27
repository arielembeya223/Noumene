<?php 
global $params;
$name=$params["name"];
if(!empty($_SESSION["auth"])){
    if($_SESSION["auth"]["name"] !== $name){
        require "404.php";
       die();  
    }
}else{
    require "404.php";
    die();
}
?>
<h1>mon compte<h1>

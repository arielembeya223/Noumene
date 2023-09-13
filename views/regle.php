<?php 
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
global $router;
require "nav.php"
?>
<div class="container">
  <h1 class="text-center">Noumene</h1>
  <p class="text-center">Noumene est un site qui permet de lire et partager des articles facilement </p>
  <h1 class="text-center">utilisation</h1>
  <p class="text-center">
    Pour pouvoir creer des articles il faut premierement vous creez un <a href="<?=$router->generate("login")?>">compte</a> si vous avez deja un compte 
   <br> il suffit de vous <a href="<?=$router->generate("connexion")?>">connecter</a>
   une fois connecte vous pouvez :
     <div class="text-center"> Editer des articles</div>
     <div class="text-center"> Modifier des articles</div>
  </p>
  <div class="text-center">Et en prime vous pourrez commenter vos articles et ceux des autres auteurs</div>
</div>
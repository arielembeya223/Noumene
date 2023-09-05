<?php
namespace App;
use App\Mail;
use PDO;
class Forgot{
    private $email;
    private $pdo;
    private $fetch;
    public function __construct(string $email,PDO $pdo)
    {
        $this->email=$email;
        $this->pdo=$pdo;
    }
    public function verify()
    {
        $error=[];
        $prepare = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
         $prepare->execute(["email"=>$this->email]);
         $fetch=$prepare->fetch(PDO::FETCH_ASSOC);
        if(!filter_var($this->email)){
         return $error[]="email invalide";
        }elseif(!$fetch){
          return  $error[]="aucun email ne correspond";
        }elseif($fetch["token"] !== NULL){
          return $error[]= "utilisateur non identifie";
        }
        else{
            $this->fetch=$fetch;
           return  true;
        }
    }
    public function get(string $lien)
    {
     $fetch = $this->fetch;
     $id = $fetch['id'];
     $reset = str_shuffle("AEJKLMNTahijklqwwz");
     $prepare=$this->pdo->prepare("UPDATE users SET reset_token=:reset_token WHERE id=:id");
     $prepare->execute(["reset_token"=>$reset,"id"=>$id]);
     $url = $lien . $reset;
     $to = $this->fetch["email"];
     $subject = "modification de votre mot de passe Noumene";
     $content = "<h1>afin de reinitialiser votre mot de passe il est important de suivre les instructions ci-apres<h1>
     <ul>
     <li>cliques sur ce lien  <a href='{$url}''>ici</a><li>
     <li>ensuite modifier votre mot de passe </li>
     </ul>";
     $mail = new Mail($to,$subject,$content);
     $mail->send();
    }
}
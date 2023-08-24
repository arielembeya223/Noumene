<?php
namespace App;
use App\Hash;
use PDO;
use App\Session;
use PHLAK\StrGen;
use DateTime;
class Users{
    public $pdo;
    public $name;
    public $email;
    public $password;
    public $password_confirm;
    public $token;
    public $token_at;
    public function __construct(PDO $pdo, string $name, string $email,string $password,string $password_confirm)
    {
        $this->pdo=$pdo;
        $this->name=$name;     
        $this->email=$email;
         $this->password=$password;
         $this->password_confirm=$password_confirm;
         $this->token=new StrGen\Generator();
         $this->token_at=new DateTime();
    }
    public function verify():array{
        $error=[];
        $sucess=[];
        if(preg_match("#[^AZa-z0-9_\.]#", $this->name)){
        $error["username"] = "veuillez changer le format de votre nom";
        }
        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            $error["email"]="email invalide";
        }
        if($this->password !== $this->password_confirm){
            $error["password"]="le mot passe que vous avez confirme ne  correspond pas au mot de passe que vous avez ecrit";
        }
         if(!empty($error)){
            $error["type"]="danger";
            return $error;
         }else{
            $sucess["type"]="success";
            $sucess["message"]="un email vient de vous etre envoyes pour pouvoir confirmer le compte";
            return $sucess;
         }
        }
        public function insert(string $table){
            $new_password= new Hash();
            $password=$new_password::crypte($this->password);
            $token=$this->token->length(30)->generate();
            $token_at=$this->token_at->format('Y-m-d H:i:s');
            $req=$this->pdo->prepare("INSERT INTO $table SET name=:name,email=:email,password=:password,token=:token,token_at=:token_at");
            $req->execute([
                "name"=>$this->name,
                "email"=>$this->email,
                "password"=>$password,
                "token"=>$token,
                "token_at"=>$token_at
            ]);
            return $req;
        }
        public function mail(string $lien){
            $to=$this->email;
             
        }
    public function flashMessage(array $array=[]){
        $session = new Session();
        $session->start();
       $_SESSION["flash"]=$array;
       return $_SESSION["flash"];
    }
}
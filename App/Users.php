<?php
namespace App;
use PDO;
class Users{
    public $pdo;
    public $name;
    public $email;
    public $password;
    public $password_confirm;
    public function __construct(PDO $pdo, string $name, string $email,string $password,string $password_confirm)
    {
        $this->pdo=$pdo;
        $this->name=$name;     
        $this->email=$email;
         $this->password=$password;
         $this->password_confirm=$password_confirm;
    }
    public function verify():array{
        $error=[];
        if(preg_match("#[^AZa-z0-9_\.]#", $this->name)){
        $error["username"] = "format non respecte";
        }
        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            $error["email"]="email invalide";
        }
        if($this->password !== $this->password_confirm){
            $error["password"]="le mot passe que vous avez confirme ne  correspond pas au mot de passe que vous avez ecrit";
        }
         return $error;
}
}
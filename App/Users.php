<?php
namespace App;
use SecurityLib;
use RandomLib;
use App\Hash;
use PDO;
use App\Session;
use PHLAK\StrGen;
use DateTime;
use App\Mail;
class Users{
    public $pdo;
    public $name;
    public $email;
    public $password;
    public $password_confirm;
    public $token;
    public $token_at;
    public $token_lien;
    public $lastId;
    public $site="http://localhost:8000/";
    public function __construct(PDO $pdo, string $name, string $email,string $password,string $password_confirm)
    {
        $this->pdo=$pdo;
        $this->name=$name;     
        $this->email=$email;
         $this->password=$password;
         $this->password_confirm=$password_confirm;
         $this->token= new RandomLib\Factory;
         $this->token_at=new DateTime();
    }
    public function flashMessage(array $array=[]){
        $session = new Session();
        $session->start();
       $_SESSION["flash"]=$array;
       return $_SESSION["flash"];
    }
    public function verify():array{
        $error=[];
        $sucess=[];
        $name=$this->name;
        $query=(int)($this->pdo->query("SELECT count(id) FROM users")->fetch()[0]);
        if($query>=1){
        $offset=$query;
        }else{
            $offset=0;
        }
        $pdo=$this->pdo->query("SELECT name FROM users LIMIT $offset OFFSET 0");
        $fetchS=$pdo->fetchAll(PDO::FETCH_NUM);
        foreach($fetchS as $fetch){
        if(in_array($name,$fetch)){
            $error["username"]="ce nom est deja utilise veuillez le changer";
         }
        }
        if(preg_match("#[^AZa-z0-9_\.\-]i#", $this->name)){
        $error["username"] = "veuillez changer le format de votre nom";
        }
        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            $error["email"]="email invalide";
        }
        if($this->password !== $this->password_confirm){
            $error["password"]="le mot  de passe que vous avez confirme ne  correspond pas au mot de passe que vous avez ecrit";
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
            $newtoken=$this->token->getGenerator(new SecurityLib\Strength(SecurityLib\Strength::MEDIUM));
            $this->token_lien=$newtoken->generateString(40, 'abcdeffghijkmnopqrstuvwxxyz');
            $token_at=$this->token_at->format('Y-m-d H:i:s');
            $req=$this->pdo->prepare("INSERT INTO $table SET name=:name,email=:email,password=:password,token=:token,token_at=:token_at");
            $req->execute([
                "name"=>$this->name,
                "email"=>$this->email,
                "password"=>$password,
                "token"=>$this->token_lien,
                "token_at"=>$token_at
            ]);
            $this->lastId=$this->pdo->lastInsertId();
            return $req;
        }
         public function getUrl(){
         $liens=$this->site . $this->lastId . "-" . $this->token_lien;
         return $liens;
        }
        public function mail(){
            $url= $this->getUrl();
            $to=$this->email;
            $msg ="
            <h1>Noumene<h1>\n
             <p>afin de s'assurer que s est bien vous qui avez essaye de vous connecter clickez sur ce lien <p>\n
             <a href='$url'>cliquez ici <a>\n
            ";
            $email=new Mail($to,"demande d'inscription au site Noumene",$msg);
             $email->send();
        }
        private function generate(){
        $lettre = "abcdefghijklmnopqrstuv";
        $repeat = str_repeat($lettre,30);
        $shuffle=str_shuffle($repeat);
        $subs = substr($shuffle,1,15);
        return $subs;
        }
        public function cookie(){
            $three= str_shuffle("afghjiklonmg");
           $first= $this->generate();
            $finaly = $first . ';' . $this->lastId . ';' . $three;
            return $finaly;
        }
}
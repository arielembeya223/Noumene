<?php 
namespace App;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Mail{
    private $to;
    private $username='noumene6@gmail.com';
    private $secret = 'yqqidbfuvjumsptv';
    public $subject;
    public $content;
    public function __construct(string $to,string $subject,string $content)
    {
     $this->to=$to;
     $this->subject=$subject;
     $this->content=$content;
    }
    public function send(){
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
            $mail->isSMTP();
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->SMTPDebug = 0;                          
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = $this->username;                     
            $mail->Password   = $this->secret;                            
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                                   
            $mail->setFrom($this->username);
            $mail->addAddress($this->to);         
            $mail->isHTML(true);                                  
            $mail->Subject = $this->subject;
            $mail->Body    = $this->content;
           $mail->send();
        } catch (Exception $e) {
            echo "impossible d'envoyer le mail : {$mail->ErrorInfo}";
        }
    }
}

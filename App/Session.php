<?php
namespace App;
class Session{
     public function start(){
        if(session_status()=== PHP_SESSION_NONE){
            session_start();
        }
     }
}
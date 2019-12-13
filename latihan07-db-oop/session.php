<?php
session_start();

class Session{
    public function set($nama, $nilai){
        return $_SESSION[$nama] = $nilai; 
    }

    public function remove($nama){
        unset($_SESSION[$nama]); 
        return true;
    }

    public function read($nama){
        return $_SESSION[$nama]; 
    }

    public function check($nama){
        if (strlen($_SESSION[$nama]) > 0 ){
            return true;
        }

        return false;
    }

    public function destroy(){
        return session_destroy();
    }
}
?>
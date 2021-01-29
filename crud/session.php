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
        if($this->check($nama)){
            return $_SESSION[$nama]; 
        }

        return false;
    }

    public function check($nama){
        if(isset($_SESSION[$nama])):
            if (strlen($_SESSION[$nama]) > 0 ) return true;
        endif;   

        return false;
    }

    public function destroy(){
        return session_destroy();
    }
}
?>
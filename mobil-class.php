<?php
class Mobil{
    var $merek;
    var $cc;
     
    /*
    -"set" untuk merepresentasikan fungsi "memberi nilai" data melalui function
    -"get" untuk merepresentasikan "mengambil" data
    - kalimat ini hanya kebiasaan umum programmer anda bisa menggunakan kalimat lain.
    */

    function setMerek($m){
        $this->merek = $m;
    }

    function setCc($c){
        $this->cc = $c;
    }

    function getMerek(){
        return $this->merek;
    }

    function getCc(){
        return $this->cc;
    }
}
?>
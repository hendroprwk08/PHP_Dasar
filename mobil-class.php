<?php
class Mobil{
    var $merek;
    var $cc;

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
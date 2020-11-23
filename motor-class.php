<?php
class Motor{
    var $merek;
    var $cc;

    public function __construct($m, $c) {
        $this->merek = $m;
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
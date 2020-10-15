<?php
include "mobil-class.php"; 

$m = new Mobil(); //inisiasi / dibentuk

$m->setMerek("Audi");
$m->setCc(2400);

print 'Merek <b>'. $m->getMerek() . '</b> dengan tenaga <b>'. $m->getCc(). '</b>cc';
?>
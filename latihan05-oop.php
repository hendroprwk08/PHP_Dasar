<?php
include "mobil-class.php"; 

$mobil = new Mobil();

$m->setMerek("Audi");
$m->setCc(2400);

print 'Merek <b>'. $m->getMerek() . '</b> dengan tenaga <b>'. $m->getCc(). '</b>cc';
?>
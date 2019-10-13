<?php
include "mobil-class.php"; 

$mobil = new Mobil();

$mobil->setMerek("Audi");
$mobil->setCc(2400);

print 'Merek <b>'. $mobil->getMerek() . '</b> dengan tenaga <b>'. $mobil->getCc(). '</b>cc';
?>
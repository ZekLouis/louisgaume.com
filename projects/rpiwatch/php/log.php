<?php
$tab = file('/home/pi/RaspiWatch/bin/log.txt');
$der_ligne = $tab[count($tab)-1];
echo $der_ligne;
?>
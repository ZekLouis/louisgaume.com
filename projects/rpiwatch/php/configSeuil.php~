
<?php

	$monfichier = fopen('/home/pi/RaspiWatch/bin/config.cfg', 'r+');

        if($monfichier == NULL){
   	     echo "Problème d'ouverture du fichier";
        }
        $i = 0;
        while ($i < 2){
        	$temp = fgets($monfichier);
                $i++;
        }
        $temp = substr($temp,-(strlen($temp)-13));
        
        echo '"'+$temp+'"';
        
        fclose($monfichier);
?>  
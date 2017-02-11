
<?php

	$monfichier = fopen('/home/pi/RaspiWatch/bin/config.cfg', 'r+');

        if($monfichier == NULL){
   	     echo "Problème d'ouverture du fichier";
        }
        $i = 0;
        while ($i < 6){
        	$temp = fgets($monfichier);
                $i++;
        }
        $temp = substr($temp,-(strlen($temp)-8));
        
        echo '"'+$temp+'"';
        
        fclose($monfichier);
?>  
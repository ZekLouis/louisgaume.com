
<?php

	$monfichier = fopen('/home/pi/RaspiWatch/bin/config.cfg', 'r+');

        if($monfichier == NULL){
   	     echo "Problème d'ouverture du fichier";
        }
        $i = 0;
        while ($i < 11){
        	$temp = fgets($monfichier);
                $i++;
        }
        $temp = substr($temp,-(strlen($temp)-6));
        
        echo $temp;
        
        fclose($monfichier);
?>  
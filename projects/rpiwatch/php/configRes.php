
<?php

	$monfichier = fopen('/home/pi/RaspiWatch/bin/config.cfg', 'r+');

        if($monfichier == NULL){
   	     echo "Problème d'ouverture du fichier";
        }
        $i = 0;
        while ($i < 9){
        	$temp = fgets($monfichier);
                $i++;
        }
        $temp = substr($temp,-(strlen($temp)-10));
        
        if(intval($temp)==1920){
         echo '"1"';
        }
        if(intval($temp)==1280){
         echo '"2"';
        }
        if(intval($temp)==640){
         echo '"3"';
        }
        fclose($monfichier);
?>  
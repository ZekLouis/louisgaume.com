
<?php

	$monfichier = fopen('/home/pi/RaspiWatch/bin/config.cfg', 'r+');

        if($monfichier == NULL){
   	     echo "Problème d'ouverture du fichier";
        }
        $i = 0;
        while ($i < 5){
        	$temp = fgets($monfichier);
                $i++;
        }

        echo "Etat de la détection : ";
        if($temp == "enmarche = False\n"){
                echo '<p class="etat" style="color:red">Inactive</p>';
        }
        else{
                echo '<p class="etat" style="color:green">Active</p>';
        }
        fclose($monfichier);
?>  
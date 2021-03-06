<?php

/**
* Script pour récupérer le code HTML nécéssaire à l'affichage des vidéos avec miniature
*
* Ce script ouvre le répertoire contenant les vidéos, et crée un tableau avec la totalité
* des noms des fichiers vidéo. Ca génère ensuite le code HTML nécéssaire pour chaque miniature
* entouré d'une balise <li>.
*
*/

// On append tous les noms de fichier dans un tableau
$videoPath="/home/pi/RaspiWatch/video";
$videoDirectory = opendir($videoPath);
while($filename = readdir($videoDirectory)) {
    $videoArray[] = $filename;
}
closedir($videoDirectory);

sort($videoArray);
$videoArray = array_reverse($videoArray);

$nbVideo = count($videoArray);

$nbVideo = $nbVideo / 2;
//Boucle principale, pour chaque fichier, si c'est une vidéo, alors on génère le code pour télécharger la vidéo (<a>) et la miniature (<img>)
for($index=0; $index < $nbVideo; $index++) {
    $vidName = $videoArray[$index];
    $miniName= substr($vidName,0, strlen($vidName)-3).'jpg';
    $extension = substr($vidName, -3);
    if ($extension == 'mp4'){
        echo '<li><a href="javascript:;" onclick="supprVideo($(this).parent().children(\'.nomVideo\').text());" class="lienSupprimer" style="color:red; display:none;">Supprimer</a> <a class="nomVideo" href="video/'.$vidName.'" target="_blank"><img src="video/miniatures/'.$miniName.'" alt="'.$miniName.'" /><span>'. $vidName.'</span></a></li>';
    }
}
if($nbVideo > 30){
    echo '<script> alert(\'Vous avez plus de 30 vidéos sur votre Raspberry, nous vous conseillons de supprimer des vidéos\') </script>';
}
?>

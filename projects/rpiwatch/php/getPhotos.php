<?php

/**
* Script pour récupérer le code HTML nécéssaire à l'affichage des photos
*
* Ce script ouvre le répertoire contenant les photos, et crée un tableau avec la totalité
* des noms des fichiers photos. Ca génère ensuite le code HTML nécéssaire pour chaque image
* entouré d'une balise <li>.
*
*/

// On append dans un tableau tous les fichiers/dossiers qui sont dans "photos". Le tri se fait après
$photoPath="/home/pi/RaspiWatch/photo";
$photoDirectory = opendir($photoPath);
while($filename = readdir($photoDirectory)) {
    if(substr($filename,0,5)=="photo"){
        $photoArray[] = $filename;
    }
}
closedir($photoDirectory);

//Deux lignes suivantes servent à trier les photos (récent à ancien)
sort($photoArray);
$photoArray = array_reverse($photoArray);

$nbPhoto = count($photoArray);

//Boucle principale. Pour chaque fichier, si c'est .jpg, alors on génére le code html nécéssaire
for($index=0; $index < $nbPhoto; $index++) {
    $name = $photoArray[$index];
    $extension = substr($name, -3);
    if ($extension == 'jpg'){
        echo '<li><a href="javascript:;" onclick="supprPhoto($(this).parent().children(\'.nomPhoto\').text());" class="lienSupprimer" style="color:red; display:none;">Supprimer</a><a class="nomPhoto" href="photo/'. $name.'" target="_blank"><img src="photo/'. $name .'" alt="'.$name.'" /><span>' . $name . '</span></a></li>';
    }
}
if ($nbPhoto>30){
    echo '<script> alert(\'Vous avez plus de 30 photos sur votre Raspberry, nous vous conseillons de supprimer des photos\') </script>';
}
?>

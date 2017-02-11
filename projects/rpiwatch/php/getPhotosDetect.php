<?php


$photoPath="/home/pi/RaspiWatch/photo";
$photoDirectory = opendir($photoPath);
while($filename = readdir($photoDirectory)) {
	if(substr($filename,0,15)=="Image_Mouvement"){
		$photoDetectArray[] = $filename;
	}

}
closedir($photoDirectory);

sort($photoDetectArray);
$photoDetectArray = array_reverse($photoDetectArray);

$nbPhoto = count($photoDetectArray);

//Boucle principale. Pour chaque fichier, si c'est .jpg, alors on genere le code html necessaire
for($index=0; $index < $nbPhoto; $index++) {
    $name = $photoDetectArray[$index];
    $extension = substr($name, -3);
    if ($extension == 'jpg'){
        echo '<li><a href="javascript:;" onclick="supprPhoto($(this).parent().children(\'.nomPhoto\').text());" class="lienSupprimer" style="color:red; display:none;">Supprimer</a><a class="nomPhoto" href="photo/'. $name.'" target="_blank"><img src="photo/'. $name .'" alt="'.$name.'" /><span>' . $name . '</span></a></li>';
    }
}
?>

<?php
                //Ce premier script met en place des tableaux avec les noms de fichiers

                        $photoPath="/home/pi/RaspiWatch/photo";
                        $videoPath="/home/pi/RaspiWatch/video";

                        $photoDirectory = opendir($photoPath);
                        $videoDirectory = opendir($videoPath);

                        while($filename = readdir($photoDirectory)) {
                                $photoArray[] = $filename;
                        }
                         
                        while($filename = readdir($videoDirectory)) {
                                $videoArray[] = $filename;
                        }

                         
                        closedir($photoDirectory);
                        closedir($videoDirectory);

                        $nbPhoto = count($photoArray);
                        $nbVideo = count($videoArray);

			echo json_encode($photoArray);
?>


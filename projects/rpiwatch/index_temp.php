<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<title>RaspiWatch</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	</head>

	<body onload="ajax();">
		<header>
			<img id = "logo" src = "images/logoRaspiWatch.png" alt="logo raspiWATCH">
			<h1>RaspiWATCH</h1>
		</header>


		<nav>
		
			<div id = "voyant">
			</div>
			
			<p id = "etat">Etat de la détection</p>
			
			<div id = "menu">
				<ul id = "onglets">
					<li id = "onglet0" class = "active" onclick ="changeOnglet(0)"> Configuration </li>
					<li id = "onglet1" onclick ="changeOnglet(1)"> Photos </li>
					<li id = "onglet2" onclick ="changeOnglet(2)"> Vidéos </li>
				</ul>
			</div>
		</nav>

			<section>
				<form action="cgi-bin/raspiwatch.cgi" method="GET" target="_blank">
					<legend>Que souhaitez-vous faire ?</legend>
					<fieldset>
					<input type = "submit" name = "on" value = "Démarrer">
					<input type = "submit" name = "off" value = "Arrêter">
					<input type = "submit" name = "photo" value = "Photo">
					<input type = "submit" name = "video" value = "Vidéo">
					</fieldset>
				</form>
			</section>

		
		<section id = "contenuOnglet0">
			<h2> Configuration </h2>
			<form id="config" action="cgi-bin/raspiwatch.cgi" method="GET" target="_blank">
				<fieldset>
					<legend>Résolution</legend>
					<input type = "radio" name = "res" value = "1" checked>1900x1080<br>
					<input type = "radio" name = "res" value = "2">1280x720<br>
					<input type = "radio" name = "res" value = "3">640x480<br>
					
					<legend>Images par seconde</legend>
					<input type = "radio" name = "ips" value = "30" checked>30<br>
					<input type = "radio" name = "ips" value = "25">25<br>
					<input type = "radio" name = "ips" value = "20">20<br>
					<input type = "radio" name = "ips" value = "15">15<br>
					
					
					<legend>Seuil de détection</legend>
					<input type="range"  id = "seuil" name = "seuil" min="0" max="100" value="50" step = "5" oninput="document.getElementById('AfficheRange1').textContent=value" />
					<span id="AfficheRange1">50</span>%
					
					
					<legend>Luminosité</legend> 
					<input type="range"  id = "lum" name = "lum" min="0" max="100" value="50" step = "5" oninput="document.getElementById('AfficheRange2').textContent=value" />
					<span id="AfficheRange2">50</span>%
					
					<input type = "submit" name = "submit" value = "Valider">
				</fieldset>
			</form>
		</section>
		
		<section id = "contenuOnglet1">
			<h2>Photos</h2>
		<script type="text/javascript">
		 function ajax() {
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                        alert(xhttp.responseText);
                        }
                };
                xhttp.open("GET", "temp/ajax.php", true);
                xhttp.send();
                }

		</script>
		
		<ul id="photos">
			<div id = "loadMore1">Charger plus...</div>
			<div id = "showLess1">Voir moins...</div>
			<div id = "photodiv"></div>
			<!-- <?php
			//Ce deuxième script affiche tous les photos dans le tableau photoArray et les affiches, s'ils sont sous format .jpg
			
				for($index=0; $index < 5; $index++) {
					$extension = substr($photoArray[$index], -3);
						if ($extension == 'jpg'){
							echo '<li><a href="photo/'. $photoArray[$index].'"><img src="photo/'. $photoArray[$index] .'" alt="'.$photoArray[$index].'" /><span>' . $photoArray[$index] . '</span></a></li>';
						}
			    	}
			?> -->

		</ul>	
		</section>

		<section id = "contenuOnglet2">
			<h2>Vidéos</h2>	

		<ul id="videos">
			<div id = "loadMore2">Charger plus...</div>
			<div id = "showLess2">Voir moins...</div>
			<?php
			//Ce troisème script crée des liens pour télécharger les vidéos, et, si elle exite, affiche la photo correspondante comme miniature
			
				for($index=0; $index < $nbVideo; $index++) {
					$extension = substr($videoArray[$index], -4);
						if ($extension == 'h264'){
							$miniName= substr($videoArray[$index],0, strlen($videoArray[$index])-4).'jpg';
							echo '<li><a href="video/'.$videoArray[$index].'"><img src="video/miniatures/'. $miniName .'" alt="'.$miniName.'" /><span>' . $videoArray[$index] . '</span></a></li>';
						}
			    	}
			?>

		</ul>
		</section>
		
		<footer>
		Site en construction.
		</footer>


		<script type="text/javascript">
		      var nombreOnglets = 3;
		      function changeOnglet(numero)
		      {
			// On commence par tout masquer
			for (var i = 0; i < nombreOnglets; i++){
				document.getElementById("contenuOnglet" + i).style.display = "none";
				document.getElementById("onglet" + i).className = '';
			
			}
			// Puis on affiche celui qui a été sélectionné
			document.getElementById("contenuOnglet" + numero).style.display = "block";
			document.getElementById("onglet" + numero).className = 'active';
		      }
			  
			  
			//Pour charger + ou - de photos/vidéos sur le site
			$(document).ready(function (){
				//télecharger les 3 premières photos
				$('#photos li:lt(3)').show();
				$('#loadMore1').click(function (){
					$('#photos li:lt(10)').show();
				});
				$('#showLess1').click(function (){
					$('#photos li').not(':lt(3)').hide();
				});
			});	
			
			
			$(document).ready(function (){
				//télecharger les 3 premières vidéos
				$('#videos li:lt(3)').show();
				$('#loadMore2').click(function (){
					$('#videos li:lt(10)').show();
				});
				$('#showLess2').click(function (){
					$('#videos li').not(':lt(3)').hide();
				});
			});
		</script>
	</body>
</html>

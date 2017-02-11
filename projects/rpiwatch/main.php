<?php
        if($_POST["p"]!="raspberry")
        {
                die("Accès non autorisé.");
        }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>RaspiWATCH</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css">
		<link rel="icon" type="image/png" href="./images/RaspiWATCH-Logo-V2.png">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	</head>

	<body onload="init()">
		<header>
			<a href="."><p><img src="./images/door-exit.png">Déconnexion</p></a>
			<img id="logo" src="./images/RaspiWATCH-Logo-V2.png" alt="logo raspiWATCH">
			<h1>RaspiWATCH</h1><a href="#" class="close">

			</a>
		</header>

		<!-- Retour avec lecture dans fichier en php -->
		<div class="act retourmain">
				<div id="retour">

				</div>
				<a href="/bin/log.txt" target="blank"><p>Consulter les logs</p></a>
		</div>
		
		<p class="act etat" id="etat"> </p>
	    <center>
	    <div id="ajaxloader"></div>
		<div id="ctrl">
			<form>
				<!-- <legend>Que souhaitez-vous faire ?</legend> -->
				<!-- J'ai modifié les values, il faut vérifier que le get fonctionne toujours 
				J'ai aussi supprimé fieldset-->
				<?php
				include('./php/bouton.php');
				?>
				<!--<button class="ctrl" type="button" name="on" onclick="launchDetect()" value="Démarrer">Démarrer la détection</button>	
				<button class="ctrl" type="button" name="off" onclick="stopDetect()"  value="Arrêter">Arrêter la détection</button>
				<button class="ctrl" type="button" name="photo" onclick="takePhoto()" value="Photo">Prendre une photo</button>
				<button class="ctrl" type="button" name="video" onclick="takeVideo()" value="Vidéo">Prendre une vidéo</button>
				Durée de la vidéo <input id="duree" type="number" min="1" max="60" name="duree" value="5"> sec.-->
			</form>
		</div>
		</center>
		<nav>
			<!-- <div id = "voyant">
			</div> -->       <!-- utiliser php pour faire changer la couleur du voyant de détection-->
			<div id="menu">
				<div id="menuTitre">Menu</div>
				<ul id="onglets">
					<li id="onglet0" class="active" onclick="changeOnglet(0)"> Configuration </li>
					<li id="onglet1" onclick="changeOnglet(1)"> Photos </li>
					<li id="onglet2" onclick="changeOnglet(2)"> Vidéos </li>
					<li id="onglet3" onclick="changeOnglet(3)"> Photos Détection </li>
					<li id="onglet4" onclick="changeOnglet(4)"> Aides / Infos </li>
				</ul>
			</div>
		</nav>

		<section id="contenuOnglet0">
			<h2> Configuration Vidéo / Photo</h2>
			<form id="config">
				<center>
				<div class="conf" id="gauche">
					<legend>Résolution</legend>
					<input type="radio" name="res" value="1" checked>1920x1080<br>
					<input type="radio" name="res" value="2">1280x720<br>
					<input type="radio" name="res" value="3">640x480<br>
				</div>

				<div class="conf" id="centre">
					<legend>Images par seconde</legend>
					<input type="radio" name="ips" value="30" checked>30<br>
					<input type="radio" name="ips" value="25">25<br>
					<input type="radio" name="ips" value="20">20<br>
					<input type="radio" name="ips" value="15">15<br>
				</div>
				
				<div class="conf" id="droite">
					<legend>Seuil de détection</legend>
					<input type="range"  id="seuil" name="seuil" min="0" max="100" value=<?php include 'php/configSeuil.php';?> step="5" oninput="document.getElementById('AfficheRange1').textContent=value" />
					<span id="AfficheRange1">50</span>%

					
					
					<legend>Luminosité</legend> 
					<input type="range"  id="lum" name="lum" min="0" max="100" value=<?php include 'php/configLumi.php';?> step="5" oninput="document.getElementById('AfficheRange2').textContent=value" />
					<span id="AfficheRange2">50</span>%
				</div>
				</center>
				<center><button class="btn btn-primary btn-block btn-large" type="button" onclick="changerConfig()"  name="submit" value="Valider">Valider</button></center>
			</form>
		</section>
		
		<section id="contenuOnglet1">
			<h2>Photos</h2>
			<ul id="photos">
				<div id="loadMore1">Charger plus...</div>
				<div id="showLess1">Voir moins...</div>
				<?php include 'php/getPhotos.php';?>
	        </ul>	
		</section>

		<section id="contenuOnglet2">
			<h2>Vidéos</h2>
			<ul id="videos">
				<div id="loadMore2">Charger plus...</div>
				<div id="showLess2">Voir moins...</div>
				<?php include 'php/getVideos.php';?>
			</ul>
                </section>
		
		<section id="contenuOnglet3">
			<h2>Photos issues de la détection</h2>
			<ul id="photosDetect">
			        <?php include 'php/getPhotosDetect.php';?>
            </ul>
		</section>

		<section id="contenuOnglet4">
			<h2>Aides / Informations</h2>
			<ul>
				<h3>Aide pour la configuration</h3>
				<li>Plus le seuil est élevé plus la détection sera sensible.</li>
				<li>Plus le nombre d'images par seconde est élevé plus la vidéo sera fluide.</li>
				<li>Plus la résolution est élevé, plus la qualité de la vidéo sera meilleure.</li>
				<li>Le réglage de la luminosité permet d'obtenir un meilleur rendu si par exemple la caméra se trouve dans une pièce sombre.</li>
				<h3>Aide pour les photos</h3>
				<li>Vous pouvez télécharger les photos en cliquant dessus.</li>
				<h3>Aide pour les vidéos</h3>
				<li>Vous pouvez télécharger les vidéos en format mp4 en cliquant dessus.</li>
				<h3>Aide pour les photos de la détection</h3>
				<li>Les photos présentent dans cette section on été prise automatiquement au moment ou un mouvement a été détecté.</li>
			</ul>
                </section>
		<script type="text/javascript" src="js/javascript.js"></script>
	</body>
</html>

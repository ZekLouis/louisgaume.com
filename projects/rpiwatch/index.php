<?php

        if($_POST["p"]!="raspberry"){
        	echo "<script>alert(\"Cette page n\'est qu\'un aperçu du projet qui n\'est en aucun cas fonctionnel : Pas de RaspiCam \\nPassword : raspberry\")</script>";
            include("./login.php");
        }else{
            include("./main.php");
        }
?>
<!DOCTYPE html>
<html>
	
	<head>
		<meta charset="utf-8">
		<title>Test Login</title>
		<link rel="stylesheet" type="text/css" href="./login.css">
	</head>

	<body>
		<div class="login">
  			<center><img src="./logoRaspiWatch.png" width="200px"></center>
  			<form action="." method="post">
    			        <input type="password" name="p" placeholder="Mot de passe" required="required" />
    			        <button type="submit" class="btn btn-primary btn-block btn-large">Accéder au site</button>
  			</form>
  			<?php
                                if(isset($_POST['p'])){
                                        echo '<p style="color:red;text-align:center;">Mot de passe incorrect !</p>';
                                }
                        ?>
		</div>
	</body>
</html>
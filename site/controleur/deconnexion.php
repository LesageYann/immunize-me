<?php 
	include "site/model/Identite.class.php";
	include "site/model/Bdd.class.php";
	session_start();
	session_destroy();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
	<meta charset="UTF-8"/>
	<meta name="Autor" content="Turtle Team" />
	<meta name="Keywords" content="Nuit, Info, PRojet, Humanitaire, Jeu, prévention"/>
	<meta name="Description" content="Jeu de prévention contre les épidémies."/>
	<meta http-equiv="refresh" content="5; index.php" />
	<link rel="stylesheet" type="text/css" href="../design/index.css"></link>
	<title>Deconnexion Immunize-Me</title>
</head>
<body>
	<?php
		if($_SESSION['log']) {
			include '../vue/header_log.html';
		}
		else{
			include'../vue/header_dc.html';
		}
	?>
	<div id="principal">
		<div  class="error">
			<p> Vous avez été deconnecté avec succé. </br> Vous allez être redirigé sur la page d'acceuil dans 5secondes.</p>
		</div>
	</div>
	<?php 
		include'../vue/footer.html';
	?>
	
</body>
</html>




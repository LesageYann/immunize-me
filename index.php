<?php 
	include "site/model/Identite.class.php";
	include "site/model/Bdd.class.php";
	session_start();
?>	
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
	<meta charset="UTF-8"/>
	<meta name="Autor" content="Turtle Team" />
	<meta name="Keywords" content="Nuit, Info, PRojet, Humanitaire, Jeu, prévention"/>
	<meta name="Description" content="Jeu de prévention contre les épidémies."/>
	<link rel="stylesheet" type="text/css" href="site/design/index.css"></link>
	<title>Immunize me !</title>
</head>
<body>
	<?php
		if($_SESSION['log']) {
			include 'site/vue/header_log.html';
		}
		else
		{
			include'site/vue/header_dc.html';
		}
	?>
	<div id="principal">
		<div id="marge">
			
		<h3> Un petit jeu ? </h3>
	
		</div>
	</div>
	<?php 
		include'site/vue/footer.html';
	?>
	
</body>
</html>

<?php 
	include "../model/Bdd.class.php";
	include "../model/Identite.class.php";
	session_start();
?>	
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
	<meta charset="UTF-8"/>
	<meta name="Autor" content="Turtle Team" />
	<meta name="Keywords" content="Nuit, Info, PRojet, Humanitaire, Jeu, prévention"/>
	<meta name="Description" content="Jeu de prévention contre les épidémies."/>
	<link rel=\"stylesheet\" type=\"text/css\" href=\"../design/index1.css\"></link>
	<title>Quizz</title>
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
		<h3 >Quizz</h3>
			<div class="sousdiv">
				<?php
					$bdd_kona = new Bdd();
					$bdd_kona->incKonami($_SESSION['log']->getIdent());
					header('Location: quizz.php');
				?>
			</div>
	</div>
	<?php 
		include'../vue/footer.html';
	?>
	
</body>
</html>

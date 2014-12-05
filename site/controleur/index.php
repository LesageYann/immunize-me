<?php 
	include "../model/Identite.class.php";
	include "../model/Bdd.class.php";
	session_start();
?>	
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
	<meta charset="UTF-8"/>
	<meta name="Autor" content="Turtle Team" />
	<meta name="Keywords" content="Nuit, Info, PRojet, Humanitaire, Jeu, prévention"/>
	<meta name="Description" content="Jeu de prévention contre les épidémies."/>
	<?php
		if($_SESSION['log']) {
			$bdd_kona = new Bdd();
			$kona = $bdd_kona-> getKonami($_SESSION['log']->getIdent());
			switch ($kona) {
				case 0:
					echo"<link rel=\"stylesheet\" type=\"text/css\" href=\"../design/index0.css\"></link>";
					break;
				case 1:
					echo"<link rel=\"stylesheet\" type=\"text/css\" href=\"../design/index1.css\"></link>";
					break;
				case 2:
					echo"<link rel=\"stylesheet\" type=\"text/css\" href=\"../design/index2.css\"></link>";
					break;
				case 3:
					echo"<link rel=\"stylesheet\" type=\"text/css\" href=\"../design/index3.css\"></link>";
					break;
				default:
					echo"<link rel=\"stylesheet\" type=\"text/css\" href=\"../design/index.css\"></link>";
					break;
			}
		}
		else
		{
			echo"<link rel=\"stylesheet\" type=\"text/css\" href=\"../design/index.css\"></link>";
		}
	?>
	<title>Immunize me !</title>
</head>
<body>
	<?php
		if($_SESSION['log']) {
			include '../vue/header_log.html';
		}
		else
		{
			include'../vue/header_dc.html';
		}
	?>
	<div id="principal">
		<div id="marge">
			
			<h3 id="titrejeu"> Un petit jeu ? </h3>
			<div class="sousdiv" id="jeu">
			 <iframe src="../../immunize-me/jeu/src/index.html"></iframe> 
			</div>
		</div>
		<h3> Description </h3>
			<div class="sousdiv">
				<h2> Description générale: </h2>
				<p>
					Bonjour ! </br>
					Ce petit jeu que vous avez (normalement) sous les yeux est une petite application développée dans un but préventif et informatif. Il vise les plus jeunes particulièrement et a pour objectif de leur apprendre quelques informations sur des virus qui frappes notre monde aujourd'hui et sur les moyens de prévention/de soin.</br>
					Pour ce faire ce petit jeu propose aux enfant d'aller combattre quelques virus emblématiques tel que Ebola ou le VIH tout en récoltant des informations pour les aider à comprendre de quoi ils ont besoin pour les combattres !</br>
				</p>
				<h2> Controles : </h2>
				<p> Les controles sont très simples : tout se fait à la souris. Il suffit de maintenir le clic gauche de souris pour envoyer vos attaques et bouger votre arme.</br></p>
				<h2> Le plus :</h2>
				<p> Participez à notre petit jeu ! Il suffit de vous créer un compte et de répondre à des petits quizz sur des maladies pour améliorer petit à petit le design du site !</br></p>
			
			</div>
	</div>
	<?php 
		include'../vue/footer.html';
	?>
	
</body>
</html>

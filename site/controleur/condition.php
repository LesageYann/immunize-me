<?php 
	include "../site/model/Bdd.class.php";
	include "../site/model/Identite.class.php";
	session_start();
?>	
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr" xml:lang="fr">
<head>
	<meta charset="UTF-8"/>
	<meta name="Autor" content="Turtle Team" />
	<meta name="Keywords" content="Nuit, Info, PRojet, Humanitaire, Jeu, prévention"/>
	<meta name="Description" content="Jeu de prévention contre les épidémies."/>
	<link rel="stylesheet" type="text/css" href="../design/index.css"></link>
	<title>Conditions</title>
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
		<h3 >Conditions d'Utilisation</h3>
			<div class="sousdiv">
	Ces Conditions d'Utilisation régissent vos accès et utilisation des services, en ce compris notamment, nos différents sites Internet, les SMS, les API, les applications, les boutons, les notifications e-mail et les widgets, et toute autre information, textes, graphiques, photos ou autres documents mis en ligne, téléchargés ou figurant dans les Services. Votre accès et votre utilisation des Services sont conditionnés à votre acceptation et le respect des présentes Conditions. En accédant aux Services ou en les utilisant, vous acceptez d'être lié par ces Conditions.</p>

	<h1> Conditions de base </h1>

	<p>Vous êtes responsable de votre utilisation des Services, des Contenus que vous publiez sur les Services, et de toute conséquence qui en découlerait. Les Contenus que vous soumettez, postez, ou affichez sont susceptibles d'être vus par d'autres utilisateurs des Services et au travers de services et sites web fournis par des tiers. Vous ne devriez fournir que des Contenus que vous souhaitez partager avec d'autres conformément aux présentes Conditions. </p>


	<h1> Confidentialité </h1>

	<p> Toute information que vous communiquez à Immunize-Me est soumise à notre politique de vie privée, qui régit la collecte et l'utilisation de vos informations. Vous comprenez qu'en utilisant nos Services, vous consentez à la collecte et l'utilisation (ainsi qu'il est énoncé dans la Politique de Vie Privée) de cette information, y compris le transfert de cette information en France et / ou dans d'autres pays à des fins de stockage, de traitement et d'utilisation par Rezozio. Dans le cadre de la fourniture des Services, nous pouvons être amenés à vous adresser certaines communications, telles que des annonces de service et des messages administratifs. Ces communications sont considérées comme partie intégrante des Services et de votre compte rezozio, de sorte qu'il n'est pas certain que vous puissiez vous opposer à leur réception.</p>


	<h1> Les mots de passe </h1>

	<p> Vous êtes responsable de la protection du mot de passe que vous utilisez pour accéder aux Services et pour toutes les activités ou les actions faites après authentification avec votre mot de passe. Nous vous encourageons à utiliser pour votre compte des mots de passe forts (mots de passe constitués d'une combinaison de lettres majuscules et minuscules, de chiffres et de caractères spéciaux). Immunize-Me ne saurait être responsable d'un quelconque dommage résultant d'un manquement de votre part sur ce qui précède.</p>
		</div>
	</div>
	<?php 
		include'../vue/footer.html';
	?>
	
</body>
</html>

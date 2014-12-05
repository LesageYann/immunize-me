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
	<link rel="stylesheet" type="text/css" href="../design/index.css"></link>
	<title>Connexion Immunize me !</title>
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
		<h3> Connexion </h3>
			<div class="sousdiv">
	<?php 		
	

	function print_form(){
		echo "<FORM METHOD=\"POST\" ACTION=\"connexion.php\" ENCTYPE=\"x-www-form-urlencoded\">\n";
		echo "  <INPUT type=\"text\" placeholder=\"Login\" name=\"login\">\n";
		echo "	<INPUT type=\"password\" placeholder=\"Mot de Passe\" name=\"mdp\"> \n</br></br>";
		echo "	<INPUT type=\"submit\" value=\"Valider\" name=\"valider\"> \n";
		echo "</FORM>\n ";
	}

	if($_SESSION['log']) {
			echo "<div class=\"error\"> Vous êtes déjà connecté.</div>";
		}
	else
	{	
		if (isset($_POST['login']) && isset($_POST['mdp'])){
			$bdd_connect = new Bdd();
			$keyword = $bdd_connect->getUser($_POST['login']);
			if($keyword['password'] ==md5( $_POST['mdp'])){
				$_SESSION['log']= new  Identite ($keyword['ident'], $keyword['name']);
				echo "<div  class=\"error\">Vous êtes bien connecté.</div>";
			} else {	
				echo "<div class=\"error\">Mot de passe incorrect</div></br>";
				print_form();
			}
		}else {
			print_form();
		}
	}
	?>
		</div>
	</div>
	<?php 
		include'../vue/footer.html';
	?>
	
</body>

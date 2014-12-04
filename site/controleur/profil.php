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
	<meta http-equiv="refresh" content="5; index.php" />
	<link rel="stylesheet" type="text/css" href="../design/index.css"></link>
	<title>Votre profil Immunize-Me</title> 
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
	<div id="principal" class="decal">	
		<h3> Profil </h3>
			<div class="sousdiv" id="prohib">
	<?php 		
	function print_prof(){
		echo "<table><tr>";
		echo "<FORM METHOD=\"POST\" ACTION=\"profil.php\" enctype=\"multipart/form-data\">\n";
		echo "<td><p> Mail: </p></td><td>";
		echo "  <INPUT type=\"text\" placeholder=\"Nouveau mail\" name=\"mail\" />\n</tr>\n<tr>";
		echo "<td><p> Ancien mot de passe : </p></td><td>";
		echo "	<INPUT type=\"password\" placeholder=\"Ancien mot de passe\" name=\"mdpold\" /> \n</td></tr>\n<tr>";
		echo "<td><p> Nouveau mot de passe : </p></td><td>";
		echo "	<INPUT type=\"password\" placeholder=\"Nouveau mot de passe\" name=\"mdp\" /> \n</td></tr>\n<tr>";
		echo "<td><p> Confirmation du nouveau mot de passe : </p></td><td>";
		echo "	<INPUT type=\"password\" placeholder=\"Repetez mot de passe\" name=\"mdp2\" /> </td></tr>\n<tr>\n";	
		echo "	<td><INPUT type=\"submit\" value=\"Valider\" name=\"valider\"  /> \n</br></br></td></tr>";
		echo "</FORM>\n </table>";
	}

	if($_SESSION['log']){
			$bdd_prof = new Bdd();
			//on vérifie si le champs de changement de mail est remplit
			if(!empty($_POST['mail'])){
				//on vérifie si le mail est bien alphanumérique.
				if(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',$_POST['mail'])){
					//changer le mail
					$bdd_prof -> setMail(($_SESSION['log']->getIdent()), $_POST['mail']);
					$id = $_SESSION['log'];
					$id->setMail($_POST['mail']);
				}
				else{
					echo "<div class=\"error\"> Format de mail incorrect. Veuillez recommencer. </div>";
				}
			}
		
			if (!empty($_POST['mdpold']) || !empty($_POST['mdp']) || !empty($_POST['mdp2'])){
				if (!empty($_POST['mdpold']) && !empty($_POST['mdp'])&& !empty($_POST['mdp2'])){
					//on test si l'ancien mot de passe est bon
					$mdpbdd = $bdd_prof-> getMdp($_SESSION['log']->getIdent());
					if(md5($_POST['mdpold']) == $mdpbdd){
						//on test si les deux mots de passe sont concordants
						if($_POST['mdp2'] == $_POST['mdp']) {
							//on test si le mdp a un format correct
							if(preg_match("#[a-zA-Z0-9]{4,}#",$_POST['mdp'] )){
								//on change le mot de passe
								$bdd_prof -> setMdp(($_SESSION['log']->getIdent()), md5($_POST['mdp']));
							}
							else{
								echo"<div class=\"error\">Le mot de passe doit être plus grand que 4 caractères alpha-numériques.</div>";
							}

						}
						else{
							echo "<div class=\"error\">Mot de passes différents</div>";
						}

					}
				}
				else{
					echo"<div class=\"error\"> Tous les champs requis ne sont pas remplis.</div>";
				}
			}

			print_prof();

	}
	else{
		echo "<div class=\"error\">Vous n'êtes pas connecté. Veuillez vous connecter pour accéder à cette page.</div>";
	}	

	?>
		</div>
	</div>
	<?php 
		include'../vue/footer.html';
	?>
	
</body>

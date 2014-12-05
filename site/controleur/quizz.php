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
	<?php
		if($_SESSION['log']) {
			$bdd_kona = new Bdd();
			$kona = $bdd_kona-> getKonami($_SESSION['log']->getIdent());
			switch ($kona) {
				case 0:
					echo"<link rel=\"stylesheet\" type=\"text/css\" href=\"../design/index0.css\"></link>";
					echo"<script src=\"konami.js\"></script><script>var easter_egg = new Konami('quizzsuccess.php');</script>  ";
					break;
				case 1:
					echo"<link rel=\"stylesheet\" type=\"text/css\" href=\"../design/index1.css\"></link>";
					echo"<script src=\"konami1.js\"></script><script>var easter_egg = new Konami('quizzsuccess.php');</script>  ";
					break;
				case 2:
					echo"<link rel=\"stylesheet\" type=\"text/css\" href=\"../design/index2.css\"></link>";
					echo"<script src=\"konami2.js\"></script><script>var easter_egg = new Konami('quizzsuccess.php');</script>  ";
					break;
				case 3:
					echo"<link rel=\"stylesheet\" type=\"text/css\" href=\"../design/index3.css\"></link>";
					echo"<script src=\"konami3.js\"></script><script>var easter_egg = new Konami('quizzsuccess.php');</script>  ";
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
					if($_SESSION['log']) {
						$bdd_kona = new Bdd();
						$kona = $bdd_kona-> getKonami($_SESSION['log']->getIdent());
						switch ($kona) {
							case 0:
								include "../vue/quizz1.html";
								break;
							case 1:
								include "../vue/quizz2.html";
								break;
							case 2:
								include "../vue/quizz3.html";
								break;
							case 3:
								include "../vue/quizz4.html";
								break;
							default:
								include "../vue/quizz.html";
								break;
						}
					}
					else
					{
						echo "<div class=\"error\">Vous n'êtes pas connecté. Veuillez vous connecter pour accéder à cette page.</div>";
					}
				?>
			</div>
	</div>
	<?php 
		include'../vue/footer.html';
	?>
	
</body>
</html>

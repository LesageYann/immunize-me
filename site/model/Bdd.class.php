<?php
class Bdd
{
    // déclaration d'une propriété
    private $connexion;

    public function __construct()
	{    
		try {
			$this->connexion = new PDO("pgsql:host=localhost;dbname=postgres",'jecisc','genji1&2');
		}catch (PDOException $e){
			echo "erreur connexion" . $e->getMessage() ;
			exit();
		}
    }
	
	//Test si un pseudo est déjà dans la base.
    public function existe( $pseudo){
		$stmt = $this->connexion->prepare(
			"SELECT COUNT(*) FROM users WHERE ident=:name") ;
		$stmt->bindValue(':name', $pseudo, PDO::PARAM_STR);
		$stmt->execute();
		$valeur_test = $stmt->fetch();
		return($valeur_test[0] == 1);
    }
	
	//Ajoute un nouvel utilisateur.
	public function ajouterUtilisateur( $id, $mdp, $mail){
		$stmt = $this->connexion->prepare(
			"INSERT INTO users (ident, password, mail)
			 VALUES (:name, :mdp, :mail)");
		$stmt->bindValue(':name', $id, PDO::PARAM_STR);
		$stmt->bindValue(':mdp', $mdp, PDO::PARAM_STR);
		$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
		$stmt->execute();
    }
	
	//Recupere un utilisateur avec son identifiant.
    public function getUser( $id){
		$stmt = $this->connexion->prepare(
			"SELECT ident, password, mail FROM users WHERE ident=:ident");
		$stmt->bindValue(':ident', $id, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
    }

	// Change le mail d'un utilisateur.
    public function setNom($id, $mail){
		$stmt = $this->connexion->prepare(
			"UPDATE users SET mail=:mail  WHERE ident=:ident");
		$stmt->bindParam(':name', $mail, PDO::PARAM_STR);
		$stmt->bindValue(':ident', $id, PDO::PARAM_STR);
		$stmt->execute();	
    }
	
	//Récupére le mot de passe. 
	public function getMdp($id){
		$stmt = $this->connexion->prepare(
			"SELECT password FROM users WHERE ident=:ident");
		$stmt->bindValue(':ident', $id, PDO::PARAM_STR);
		$stmt->execute();
		$tmp = $stmt->fetch(PDO::FETCH_ASSOC);
		return $tmp['password'];
    }
	
	//Change le mot de pass d'un utilisateur.
    public function setMdp($id, $mdp){
	$stmt = $this->connexion->prepare(
		"UPDATE users SET password=:password  WHERE ident=:ident");
	$stmt->bindParam(':password', $mdp, PDO::PARAM_STR);
	$stmt->bindValue(':ident', $id, PDO::PARAM_STR);
	$stmt->execute();	
    }
}
?>

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

    public function existe( $id){
	$stmt = $this->connexion->prepare(
		"SELECT COUNT(*) FROM users WHERE ident=:name") ;
	$stmt->bindValue(':name', $id, PDO::PARAM_STR);
	$stmt->execute();
	$valeur_test = $stmt->fetch();
	return($valeur_test[0] == 1);
    }


    public function ajouterUtilisateur( $id, $mdp){
	$flux = fopen('../design/image/avatar/Avatar.png', 'r');
	$stmt = $this->connexion->prepare(
		"INSERT INTO users (ident, password, name, picture, mimetype)
		 VALUES (:name, :mdp, :name2, :picture, :type)");
	$stmt->bindValue(':name', $id, PDO::PARAM_STR);
	$stmt->bindValue(':mdp', $mdp, PDO::PARAM_STR);
	$stmt->bindValue(':name2', $id, PDO::PARAM_STR);
	$stmt->bindValue(':type','image/png', PDO::PARAM_STR);
	$stmt->bindValue(':picture', $flux, PDO::PARAM_LOB );
	$stmt->execute();
    }

    
    public function setAvatar( $id, $img, $type){
	$flux = fopen($img, 'r');
	$stmt = $this->connexion->prepare(
		"UPDATE users SET picture=:pict, mimetype=:type  WHERE ident=:ident");
	$stmt->bindValue(':type',$type, PDO::PARAM_STR);
	$stmt->bindValue(':pict', $flux, PDO::PARAM_LOB );
	$stmt->bindValue(':ident', $id, PDO::PARAM_STR);
	$stmt->execute();
    }

    public function setMessage( $text, $id){
	$stmt = $this->connexion->prepare(
		"INSERT INTO messages (content, author)
		 VALUES (:text, :author)");
	$stmt->bindValue(':author', $id, PDO::PARAM_STR);
	$stmt->bindValue(':text', $text, PDO::PARAM_STR);
	$stmt->execute();
    }

    public function getAllMessage($start, $offset){
	$stmt= $this->connexion ->prepare(
		"SELECT encode(picture, 'base64'),* FROM messages, users WHERE author = ident ORDER BY date  DESC LIMIT :offset OFFSET :start ");
	$stmt->bindParam(':start', $start, PDO::PARAM_INT);
	$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
    }

    public function getListAbo($id){
	$stmt= $this->connexion ->prepare(
	"SELECT author FROM follow WHERE follower = :ident");
	$stmt->bindValue(':ident', $id, PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->fetchAll();
}   
    public function getMessage($start, $offset, $list){
	$chaine = "SELECT encode(picture, 'base64'),* FROM messages, users WHERE author = ident AND author IN (";
	$chaine = $chaine.$list.") ORDER BY date DESC LIMIT $offset OFFSET $start";
	$stmt= $this->connexion ->prepare($chaine);
	$stmt->execute();
	return $stmt->fetchAll();
	
    }

    public function countAllMessage(){
        $stmt= $this->connexion ->prepare(
		"SELECT COUNT (num) FROM messages");
	$stmt->execute();
	$tmp = $stmt->fetch();
	return $tmp[0];
    }

    public function countAllMessageLog($list){
	$chaine = "SELECT COUNT (*) FROM messages, users WHERE author = ident AND author IN (";
	$chaine = $chaine.$list.")";
        $stmt= $this->connexion ->prepare(
		$chaine);
	$stmt->execute();
	$tmp = $stmt->fetch();
	return $tmp[0];
    }
    
    public function getNbabonne($id){
	$stmt = $this->connexion->prepare(
		"SELECT COUNT (*) FROM follow WHERE author=:name") ;
	$stmt->bindValue(':name', $id, PDO::PARAM_STR);
	$stmt->execute();
	$tmp= $stmt->fetch();
	return $tmp[0];
    }

    public function getNbabo($id){
	$stmt = $this->connexion->prepare(
		"SELECT COUNT(*) FROM follow WHERE follower=:name") ;
	$stmt->bindValue(':name', $id, PDO::PARAM_STR);
	$stmt->execute();
	$tmp= $stmt->fetch();
	return $tmp[0];
    }

    public function getNom($id){
	$stmt = $this->connexion->prepare(
		"SELECT name FROM users WHERE ident=:name") ;
	$stmt->bindValue(':name', $id, PDO::PARAM_STR);
	$stmt->execute();
	$tmp= $stmt->fetch();
	return $tmp[0];
    }
	
    public function setNom($id, $nom){
	$stmt = $this->connexion->prepare(
		"UPDATE users SET name=:name  WHERE ident=:ident");
	$stmt->bindParam(':name', $nom, PDO::PARAM_STR);
	$stmt->bindValue(':ident', $id, PDO::PARAM_STR);
	$stmt->execute();	
    }

    public function setMdp($id, $mdp){
	$stmt = $this->connexion->prepare(
		"UPDATE users SET password=:password  WHERE ident=:ident");
	$stmt->bindParam(':password', $mdp, PDO::PARAM_STR);
	$stmt->bindValue(':ident', $id, PDO::PARAM_STR);
	$stmt->execute();	
    }
    
    public function getMdp( $id){
	$stmt = $this->connexion->prepare(
		"SELECT password FROM users WHERE ident=:ident");
	$stmt->bindValue(':ident', $id, PDO::PARAM_STR);
	$stmt->execute();
	$tmp = $stmt->fetch(PDO::FETCH_ASSOC);
	return $tmp['password'];
    }

    public function getUser( $id){
	$stmt = $this->connexion->prepare(
		"SELECT ident, password,name, picture FROM users WHERE ident=:ident");
	$stmt->bindValue(':ident', $id, PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getImg($id){
	$stmt= $this->connexion->prepare("SELECT encode(picture, 'base64'), mimetype FROM users WHERE ident=:id");
	$stmt->bindValue(':id', $id, PDO::PARAM_STR);
 	$stmt->execute();
	$stmt->bindColumn('mimetype', $mimetype);
        $stmt->bindColumn('encode', $image, PDO::PARAM_LOB);
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return '<img alt="Avatar" src="data:'.$mimetype.';base64,'.$image.'"/>';
    }

    public function searchUser($id){
	$stmt = $this->connexion->prepare(
		"SELECT * FROM users WHERE name ILIKE :name OR ident ILIKE :ident");
	$stmt->bindValue(':name', "%".$id."%", PDO::PARAM_STR);
	$stmt->bindValue(':ident', "%".$id."%", PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->fetchAll();
    }

    public function estAbonne($author, $follow){
	$stmt = $this->connexion->prepare(
		"SELECT COUNT (*) FROM follow WHERE follower= :follow AND author=:author");
	$stmt->bindValue(':follow', $follow, PDO::PARAM_STR);
	$stmt->bindValue(':author', $author, PDO::PARAM_STR);
	$stmt->execute();
	$valeur_test = $stmt->fetch();
	return($valeur_test[0] == 1);
    }

    public function getAuteur($id){
	$stmt = $this->connexion->prepare(
		"SELECT * FROM follow, users WHERE author = ident AND follower= :id");
	$stmt->bindValue(':id', $id, PDO::PARAM_STR);
	$stmt->execute();
	return $stmt->fetchAll();
    }

    public function getMessageAb($offset, $visiteur){
        $stmt= $this->connexion ->prepare(
	"SELECT encode(picture, 'base64'),* FROM messages, users WHERE author = ident AND author=:name ORDER BY date  DESC LIMIT :offset OFFSET :start");
	$stmt->bindValue(':name',  $visiteur, PDO::PARAM_STR);
	$stmt->bindValue(':start', 0, PDO::PARAM_INT);
	$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll();
    }

    public function addAbo($id, $foll){
	$stmt = $this->connexion->prepare(
		"INSERT INTO follow (follower, author)
		 VALUES (:ident, :follower)");
	$stmt->bindValue(':ident', $id, PDO::PARAM_STR);
	$stmt->bindValue(':follower', $foll, PDO::PARAM_STR);
	
	$stmt->execute();
    }

    public function delAbo($id, $foll){
	$stmt = $this->connexion->prepare(
		"DELETE FROM follow 
		 WHERE follower=:ident AND author=:follower");
	$stmt->bindValue(':ident', $id, PDO::PARAM_STR);
	$stmt->bindValue(':follower', $foll, PDO::PARAM_STR);
	$stmt->execute();
    }

}
?>

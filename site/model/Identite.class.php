<?php
class Identite
{
    // déclaration d'une propriété
    private $ident ;
    private $nom ;
    private $avatar ;
    
    public function __construct( $ident, $nom, $avatar)
          {
		$this->ident = $ident;
		$this->nom = $nom;
		$this->avatar = $avatar;
          } 

    // déclaration des méthodes
    public function getIdent() {
	return $this->ident;
    }

    public function getNom() {
	return $this->nom;
    }

    public function setNom($newNom){
	$this->nom = $newNom;
    }

    public function getAvatar() {
	return $this->avatar;
    }
    

}
?>

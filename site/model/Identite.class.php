<?php
class Identite
{
    // déclaration d'une propriété
    private $ident ;
    private $nom ;
    
    public function __construct( $ident, $nom)
          {
		$this->ident = $ident;
		$this->nom = $nom;
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

}
?>

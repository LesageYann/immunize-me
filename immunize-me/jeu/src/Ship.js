/** Constructeur de l'objet vaisseau
*weapon doit être un objet de type weapon :D
* name est le nom du joueur
*/
function Ship(name, weapon) {
  this.name = name;
  this.score = 0;
  this.weapon = weapon;
}

function _setWeapon(weapon){
    this.weapon=weapon;
}
Ship.setWeapon = _setWeapon;

function _addScore(score){
    this.score += score;
}
Ship.addScore = _addScore;


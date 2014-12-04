/** Constructeur de l'objet arme
* damage : dégat de base
* type : sert dans les calculs d'efficacité de l'arme 
* contre les virus
* 
*/
function Weapon(damage, type){
    this.damage = damage;
    this.type = type;
}

function _getDamage(VirusType){
    return this.damage;
}
Weapon.getDamage = _getDamage;



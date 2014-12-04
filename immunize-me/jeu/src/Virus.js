/** Constructeur de l'objet virus
* type rensigne sur les faiblesses depuis weapon
* pv : point de vie du virus
*/
function Virus(type, pv){
    this.type = type;
    this.pv = pv;
}

function _getPV(){
    return this.pv;
}
Virus.getPV = _getPV;

function _getDamage(damage){
    this.pv = this.pv - damage;
}
Virus.getDamage = _getDamage;

function _getType(){
    return this.type;
}
Virus.getType = _getType;

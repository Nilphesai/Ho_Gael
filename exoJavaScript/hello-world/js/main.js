console.log("Hello JS!");
let animal = "dog";//initialisation variable
const deux = 2;//valeurs fixe
let isAdult = true;//par convention, les booleen commence par "is"

{// début du bloc où age est déclarer
    let age = 37;//début de la portée (n'est utilisable qu'à l'intérieur)
    {
        {
        }
    }
}// fin du bloc, donc fin de portée

//la concaténation c'est "+", tant que les deux valeurs ne sont pas 2 nombres

/* opérateur ternaire
condition?siVrais:siFaux

condition : condition testé
siVrais : ce qui est retourné si condition True
siFaut : ce qui est retourné si condition False
*/

/* tableau associatif
let tabAssocVide = {};
tabAssocVide.prenom = "Bryan";
tabAssocVide.age = 27;

Console.log("tabAssocVide =", tabAssocVide);
// tabAssocVide = >{prenom: 'Bryan', age: 27}

*/
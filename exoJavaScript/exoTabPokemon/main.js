let pikachu = {
    id:25,
    name: "Pikachu",
    weightKg: 6.0,
    hpMax: 80,
    attacks: [
        {
            name: "vive-attaque",
            damages: 10,
        },
        {
            name: "Boule Elek",
            damages: 20,
        },
    ],
};

let miaouss = {
    id:52,
    name: "Miaouss",
    weightKg: 6.0,
    hpMax: 80,
    attacks: [
        {
            name: "vive-griffe",
            damages: 10,
        },
        {
            name: "charge",
            damages: 20,
        },
    ],
};

function listerAttaquesPokémon(pokemon) {
    console.log(`${pokemon.name} possède ${pokemon.attacks.length} attaques :`);

    for (let i=0; i< pokemon.attacks.length; i++){
        const attaque = pokemon.attacks[i];
        console.log(`\t"${attaque.name}" (puissance ${attaque.damages})`);
    }
}

listerAttaquesPokémon(pikachu);
listerAttaquesPokémon(miaouss);
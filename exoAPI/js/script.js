// Sélectionne l'élément HTML avec la classe "cp"
const inputCP = document.querySelector(".cp")
//selectionne l'élément HTML avec la classe "ville"
const selectVille = document.querySelector(".ville")

//ajouter un écouteur d'évènement "input (pendant la saisie) au champ de code postal
inputCP.addEventListener("input", () => {
    //Récupère la valeur entrée dans le champ de code postal
    let value = inputCP.value
    // Vide le cpntenue actuel de la liste de sélection de ville
    selectVille.innerText = null
    //Effectue une requête fetch vers l'API de géolocalisation avec le code postal saisi
    fetch(`https://geo.api.gouv.fr/communes?codePostal=${value}&fields=region,nom,code,codesPostaux,codeRegion&format=json&geometry=centre`)
        //Convertit la réponse en format JSON
        .then((response) => response.json())
        //Une fois que les données JSON sont disponibles
        .then((data) => {
            //affiche les données dans la console (pour débug si besoin)
            console.log(data)
            //Parcours chaque objet "ville" dans les données récupérées
            data.forEach((ville) => {
                //Crée un nouvel élément d'option HTML
                let option = document.createElement("option")
                //définit la valeur de l'option comme le code de la ville
                option.value = `${ville.code}`
                //définit le texte affiché de l'option comme le nom de la ville
                option.innerHTML = `${ville.nom}`
                //Ajoute l'option à la liste de sélection de ville
                selectVille.appendChild(option)
            })
        })
})

//ajouter un écouteur d'évènement "change (modification du champs) au champ de ville
selectVille.addEventListener("change", () => {
    //vérifie si le conteneur n'est pas vide, si non vide, le vidé
    var container = L.DomUtil.get('map');
    if(container != null){
        container._leaflet_id = null;
    }
    //initialisé map
    var map = L.map('map')
    //récup code postal et ville
    let value = inputCP.value
    var ville = selectVille.options[selectVille.selectedIndex].text;
    //récupéré coordonée de la ville et du codepostal entrée en paramètre 
    fetch(`https://api-adresse.data.gouv.fr/search/?q=${ville}&postcode=${value}`)
    .then(response => response.json())
    .then(data => {
        //si il y a des donnée, récupéré les donnée qui nous interesse (latitude et longitude)
        if (data.features && data.features.length > 0) {
            var coordinates = data.features[0].geometry.coordinates;
            var latitude = coordinates[1];
            var longitude = coordinates[0];
            map.setView([latitude, longitude], 13);
            //affichage map
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
        //si pas de donnée
        } else {
            console.error("Aucune coordonnée trouvée pour cette adresse.");
        }
    })
    
    console.log(ville);
});
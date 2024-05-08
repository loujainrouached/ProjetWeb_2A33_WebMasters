var message_valeur = document.querySelector(".information").children[1];
var id_voyage, nombre_personnes, numero_personne;
var valeur = "Aucune valeur";

// Fonction appelée lorsque la page est chargée
window.onload = () => {
    message_valeur.innerHTML = valeur;
}

// Événement déclenché lorsqu'un champ de formulaire change
document.forms[0].onchange = () => {
    console.log("Changement détecté dans le formulaire");
}

// Initialisation du QR code
var qr = new QRious({
    element: document.querySelector('.qrious'),
    size: 250,
    value: valeur
});

// Fonction appelée lorsqu'un champ de formulaire change
function change(element) {
    switch (element.name) {
        case "id_voyage":
            id_voyage = element.value;
            break;

        case "nombre_personnes":
            nombre_personnes = element.value;
            break;

        case "numero_personne":
            numero_personne = element.value;
            break;
    }

    // Construction de la valeur pour le QR code
    valeur = id_voyage + '-' + nombre_personnes + '-' + numero_personne;

    // Mise à jour de la valeur du QR code et de l'affichage
    qr.value = valeur;
    message_valeur.innerHTML = qr.value;
}

// Fonction pour générer le QR code lorsque le client souhaite faire une réservation
function genererQRCode(id_voyage, nombre_personnes, numero_personne) {
    // Construction de la valeur pour le QR code
    var valeur = id_voyage + '-' + nombre_personnes + '-' + numero_personne;

    // Mise à jour de la valeur du QR code et de l'affichage
    qr.value = valeur;
    message_valeur.innerHTML = qr.value;
}
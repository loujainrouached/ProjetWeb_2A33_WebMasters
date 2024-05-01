var message_valeur=document.querySelector(".information").children[1];
var id_voyage,nombre_personnes,numero_personne;
var valeur;
//CECI NOUS PERMET DE SELECTIONNER LE 2 EME PARAGRAHPE DANS LA DIV AYANT LA CLASS INFORMATION
window.onload=()=>{
    valeur="Aucune valeur"
    message_valeur.innerHTML=valeur;
}
document.forms[0].onchange=()=>{
    console.log("change");
}
var qr = new QRious({
    element: document.querySelector('.qrious'),
    size: 250,
    value: valeur
  });
function change(element) {
switch (element.name) {
    case "id_voyage":
        id_voyage=element.value;
      break;

      case "nombre_personnes":
        nombre_personnes=element.value;    
    break;
    
    case "numero_personne":
        numero_personne=element.value
     break;
   
    
}

valeur=id_voyage+'-'+nombre_personnes+'-'+numero_personne;
qr.value=valeur;
message_valeur.innerHTML=qr.value;


  
   
}



  
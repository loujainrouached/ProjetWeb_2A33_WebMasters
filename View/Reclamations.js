function verifTitre()
{
   var Titre=document.getElementById("titre_reclamation").value;
   if(Titre.length==0 || !/^[a-zA-Z]/.test(Titre) )
       alert("veuillez entrer un nom valide!!!(lettres uniquement)");   
}
function verifIdClient()
{
   var IdClient=document.getElementById("id_client").value;
   if(IdClient.length == 0 || !/^[0-9]+$/.test(IdClient))
       alert("veuillez entrer un Id  valide(l nombres uniquement)");   
}

/*function validateForm() {
    var nom = document.getElementById('nom').value;
    var test = true; // Initialisez test à true
    var prenom = document.getElementById('prenom').value;
    var email = document.getElementById('email').value;
    var nomRegExp = /^[A-Za-z]+$/; // Expression régulière pour vérifier que le nom et le prénom ne contiennent que des lettres
    var emailRegExp = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expression régulière pour vérifier le format de l'email
    
    // Vérifier le nom
    if (!nomRegExp.test(nom)) {
        nomError.textContent = "Nom incorrect";
        test = false; // Modifier test à false si la validation échoue
    }

    // Vérifier le prénom
    if (!nomRegExp.test(prenom)) {
        prenomError.textContent = "Prénom incorrect";
        test = false; // Modifier test à false si la validation échoue
    }

    // Vérifier l'email
    if (!emailRegExp.test(email)) {
        emailError.textContent = "mail incorrect";
        test = false; // Modifier test à false si la validation échoue
    }

    return test; // Autoriser la soumission du formulaire si toutes les validations sont réussies
}*/
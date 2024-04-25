<?php
include '../Controller/VoyageC.php'; 
include '../Model/Voyage.php';

$voyageC = new VoyageC(); 

if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST['type'], $_POST['destination'], $_POST['dateDepart'], $_POST['dateRetour'])) {

    // Vérifiez si un fichier a été téléchargé
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "upload/"; // Chemin où enregistrer l'image (assurez-vous que le dossier existe)
        $targetFile = $targetDir . basename($_FILES['image']['name']);

        // Déplacez le fichier téléchargé vers le dossier cible
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Créez une nouvelle instance de Voyage avec le chemin de l'image
            $voyage = new Voyage(
                null, 
                $_POST['type'], 
                $_POST['destination'], 
                $_POST['dateDepart'], 
                $_POST['dateRetour'], 
                $targetFile  // Chemin de l'image
            );
            $voyageC->ajoutVoyage($voyage);
            echo "Voyage ajouté avec succès.";
        } else {
            echo "Une erreur s'est produite lors du téléchargement de l'image.";
        }
    } else {
        echo "Veuillez sélectionner une image à télécharger.";
    }
} else {
    echo "Tous les champs du formulaire sont obligatoires.";
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>PHP CRUD Application</title>
</head>
</head>

<body>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
     
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New User</h3>
         <p class="text-muted">Complete the form below to add a new user</p>
      </div>
  
   

     
         <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;"enctype="multipart/form-data"id="form">
        <div class="row mb-3">

        <div class="col">
   <label class="form-label">Type</label>
   <input type="text" class="form-control" name="type" id="type"> <!-- Ajout de l'attribut id -->
   <label id="typeerror" style="color: red;"></label>
   <label id="typecorrect" style="color: green;"></label>
</div>


   

          <div class="col">
            
            <label class="form-label">Destination</label>
            <input type="text" class="form-control" name="destination" id="destination" > 
            <label id="destinationerror" style="color: red;"></label>
   <label id="destinationcorrect" style="color: green;"></label>
          </div>
          </div>
      
        
        <div class="mb-3">
          <label class="form-label">Date Depart</label>
          <input type="date" class="form-control" name="dateDepart" >
        </div>

        <div class="mb-3">
          <label class="form-label">Date Retour</label>
          <input type="date" class="form-control" name="dateRetour" >
          
        </div>
        <div class="mb-3">

        <label class="form-label">Image:</label>
        <input type="file" name="image" class="form-control" id="image">
        <label id="imageError" style="color: red;"></label>
   <label id="imageCorrect" style="color: green;"></label>


        <br>
       </div>
        
    <div>
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="element.php" class="btn btn-danger">Cancel</a>
            </div>
      </form>



      <script>
    document.getElementById("form").addEventListener("submit", function(e)
     {
      e.preventDefault();
   
      var type = document.getElementById("type").value;
      var typeerror = document.getElementById("typeerror");
      var typecorrect = document.getElementById("typecorrect");


      
   
      typecorrect.textContent = '';
      typeerror.textContent = '';
      

      if (type !== "bateau" && type !== "vol") {
        typeerror.textContent = "Le type doit être 'bateau' ou 'vol'.";
    } else {
        typecorrect.textContent = "Correct.";
    }
 // Validation de l'image
 var image = document.getElementById("image");
var imageError = document.getElementById("imageError");
var imageCorrect = document.getElementById("imageCorrect");

imageCorrect.textContent = '';
imageError.textContent = '';

var fileName = image.value;
var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
if (fileName && (fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png')) {
    imageCorrect.textContent = "Correct.";
} else {
    imageError.textContent = "Le format de l'image doit être JPEG ou PNG.";
}   

var destination = document.getElementById("destination").value;
      var destinationerror = document.getElementById("destinationerror");
      var destinationcorrect = document.getElementById("destinationcorrect");


      
   
      destinationcorrect.textContent = '';
      destinationerror.textContent = '';
      
      
if (destination === "") {
    destinationerror.textContent = "La destination ne doit pas être vide.";
} else {
    destinationcorrect.textContent = "Correct.";
}



      

      
    });
  </script>
    </div>
   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>

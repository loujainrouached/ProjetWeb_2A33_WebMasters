<?php

include '../Controller/ReclamationsC.php';
include '../Model/Reclamations.php';


$error = "";
$Reclamations = null;


$ReclamationsC = new ReclamationsC();

if (
    isset($_POST["id_client"]) &&
    isset($_POST["date_reclamation"]) &&
    isset($_POST["titre_reclamation"]) &&
    isset($_POST["contenu"])
) {
    if (
        !empty($_POST['id_client']) &&
        !empty($_POST["date_reclamation"]) &&
        !empty($_POST["titre_reclamation"]) &&
        !empty($_POST["contenu"])
    ) {
        $Reclamations = new Reclamations(
            null,
            $_POST['id_client'],
            $_POST['date_reclamation'],
            $_POST['titre_reclamation'],
            $_POST['contenu']
            
        );
        $ReclamationsC->addReclamations($Reclamations);
        header('Location:listReclamations.php');
    } else
        $error = "Missing information";
}

?>
<!-- template add kdima -->

<!DOCTYPE html> 
 <html lang="en"> 

 <head> 
     <meta charset="UTF-8"> 
     <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     <title>Reclamations</title> 

    


 <body> 
 <button><a href="listReclamations.php">Back to list</a></button> 
     <hr> 

     <div id="error"> 
          <?php echo $error;?> 
     </div> 

     <form action="" method="POST"> 
         <table> 
             <tr> 
                 <td><label for="id_client">Id client:</label></td> 
                 <td> 
                     <input type="number" id="id_client" name="id_client" /> 
                     <span id="erreurIDClient" style="color: red"></span> 
                 </td> 
             </tr> 
             <tr> 
                 <td><label for="date_reclamation">date de la reclamation :</label></td> 
                 <td> 
                     <input type="date" id="date_reclamation" name="date_reclamation" /> 
                     <span id="erreurDate" style="color: red"></span> 
                 </td> 
             </tr> 
             

             <tr> 
                 <td><label for="titre_reclamation">Titre :</label></td> 
                 <td> 
                     <input type="text" id="titre_reclamation" name="titre_reclamation" /> 
                     <span id="erreurTitre" style="color: red"></span> 
                 </td> 
             </tr> 
             <tr> 
                 <td><label for="contenu">Contenu :</label></td> 
                 <td> 


                     <input type="text" id="contenu" name="contenu" /> 
                     <span id="erreurContenu" style="color: red"></span> 


                 </td> 
             </tr> 

             <td> 
                 <input type="submit" value="Save"> 
             </td> 
             <td> 
                 <input type="reset" value="Reset"> 
             </td> 
         </table> 
     </form> 
    </body>

</html>



    <script>const textarea = document.getElementById('id_client'); 

// Add an input event listener to the textarea
textarea.addEventListener('input', function(event) {
  // Get the current textarea value
  const value = event.target.value;
  
  // Remove any non-numeric characters from the textarea value
  const newValue = value.replace(/\D/g, '');
  
  // Update the textarea value with the filtered value
  event.target.value = newValue;
});
</script>


  
</body>

</html>

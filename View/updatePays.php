<?php
include "../controller/PaysC.php";
require_once "../Model/Pays.php";

$error = "";
$pays = null;
$paysc = new functions();

$ID_guide=$_POST["ID_pays"];

if (
    isset($_POST["NomP"]) &&
    isset($_POST["Capital"])&&
    isset($_POST["monuments"])&&
    isset($_POST["ID_guide"])
   
    
    )
 ) {
    if (
        !empty($_POST['NomP']) &&
        !empty($_POST['Capital'])&&
        !empty($_POST['monuments'])&&
        !empty($_POST['ID_guide'])
       
        

    ) 
   
        // Create the blog object
        $pays = new payss(
            null,
            $_POST['NomP'],
            $_POST['Capital'],
            $_POST['monuments'],
            $_POST['ID_guide']
           
          
            
        );
        $NomP= $_POST['NomP'];
        $nomRegExp = "/^[A-Za-z]+$/"; // Expression régulière pour vérifier que le nom et le prénom ne contiennent que des lettres
       

        // Vérifier le nom
        if (!preg_match($nomRegExp, $NomP)) {
            echo '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; background-color: #ffe6e6; padding: 20px; border: 1px solid #ff0000; color: #ff0000; font-size: 20px; border-radius: 5px;">Verifier Nom  !!!!</div>';
            die(); // Arrête l'exécution du script après l'affichage du message
            //die(" verifier le Nom !!!! ");
        }
        $Capital= $_POST["Capital"];
        $nomRegExp = "/^[A-Za-z]+$/"; // Expression régulière pour vérifier que le nom et le prénom ne contiennent que des lettres
       

        // Vérifier le Prenom
        if (!preg_match($nomRegExp, $Capital)) {
            echo '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; background-color: #ffe6e6; padding: 20px; border: 1px solid #ff0000; color: #ff0000; font-size: 20px; border-radius: 5px;">Verifier Prenom !!!!</div>';
            die(); // Arrête l'exécution du script après l'affichage du message
            // die(" verifier le Nom  !!!! ");
        }
       


       
        $paysc->updatePays($pays,$ID_pays);
        echo"guide information updated successfully";
        header('Location:button.php');
        exit(); // Ensure to terminate execution after redirect
    } else {
        $error = "Please fill in all required fields.";
    }
    $db = config::getConnexion();
    // Prépare la requête SQL avec un paramètre de placeholder (:id)
    $sql = "SELECT * FROM pays WHERE ID_pays = :ID_pays ";
    $query = $db->prepare($sql);
    
    // Lie le paramètre :id à la valeur de $id
    $query->bindParam(':ID_pays', $ID_pays, PDO::PARAM_INT);
    
    // Exécute la requête préparée
    $query->execute();
    
    // Récupère le résultat de la requête
    $row = $query->fetch(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GUIDE UPDATE</title>
    <style>
        /* Full body covering pastel orange background */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #25BDC4;
        }

        form {
            margin: 0 auto;
            width: 60%;
            max-width: 600px;
            text-align: center; /* Align text elements within the form */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        /* Orange color for input fields */
        input[type="text"],
        textarea {
            border: 1px solid orange;
            padding: 15px;
            width: calc(100% - 32px); /* Adjusted width to accommodate borders */
            box-sizing: border-box;
            margin-bottom: 20px;
            font-size: 18px; /* Increased font size */
        }
        input[type="number"],
        textarea {
            border: 1px solid orange;
            padding: 15px;
            width: calc(100% - 32px); /* Adjusted width to accommodate borders */
            box-sizing: border-box;
            margin-bottom: 20px;
            font-size: 18px; /* Increased font size */
        }

        /* Orange Submit and Reset buttons */
        input[type="submit"],
        input[type="reset"] {
            background-color: orange;
            color: white;
            border: none;
            padding: 15px 28px;
            border-radius: 6px;
            cursor: pointer;
            margin-right: 10px;
            font-size: 18px; /* Increased font size */
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #FFA500;
        }

        /* Error message style */
        #erreurtitre,
        #erreurcontenu {
            color: red;
            display: none;
            margin-bottom: 20px;
            font-size: 18px; /* Increased font size */
        }

        /* Position the "Back to list" link */
        a {
            position: absolute;
            top: 20px;
            left: 20px;
            text-decoration: none;
            color: black;
            font-size: 20px;
            background-color: orange;
            padding: 15px 24px;
            border-radius: 6px;
        }

        a:hover {
            background-color: #FFA500;
        }
    </style>
</head>

<body>
    <a href="button.php">Back to list</a>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="NomP">NomP :</label></td>
                <td>
                    <input type="text" id="NomP" name="NomP" value="<?php echo $row['NomP'] ?>" />
                    <span id="erreurNom" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="Capital">Capital :</label></td>
                <td>
                    <input type="text" id="Capital" name="Capital" value="<?php echo $row['Capital'] ?>" />
                    <span id="erreurPrenom" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="monuments">monuments :</label></td>
                <td>
                    <input type="number" id="monuments" name="monuments" value="<?php echo $row['monuments'] ?>" />
                    <span id="erreurAge" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="ID_guide">ID_guide :</label></td>
                <td>
                    <input type="number" id="ID_guide" name="ID_guide" value="<?php echo $row['ID_guide'] ?>" />
                    <span id="erreurtitre" style="color: red"></span>
                </td>
            </tr>
           
            

                <td>
                    <input type="submit" value="Save">
                    <input type="hidden" value="<?php echo $_POST["ID_Pays"] ?> "name="ID_Pays">

                </td>

                <td>
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
    <script>
        
/*  const nameInput = document.getElementById("Nom");
const nameError = document.getElementById("erreurNom");

nameInput.addEventListener("input", function () {
    if (!/^[A-Za-z\s]+$/.test(nameInput.value)) {
    nameError.innerText = "Please enter only letters.";
    nameError.style.display = "block"; // Display the error message
  } else {
    nameError.innerText = ""; // Clear error message
    nameError.style.display = "none"; // Hide the error message
  }
});
     // Get the textarea element
     const textarea = document.getElementById('Nom');

// Add an input event listener to the textarea
textarea.addEventListener('input', function(event) {
  // Get the current textarea value
  const value = event.target.value;
  
  // Remove any numbers from the textarea value
  const newValue = value.replace(/\d/g, '');
  
  // Update the textarea value with the filtered value
  event.target.value = newValue;
});
// Get the textarea element
const textarea = document.getElementById('Prenom');

// Add an input event listener to the textarea
textarea.addEventListener('input', function(event) {
  // Get the current textarea value
  const value = event.target.value;
  
  // Remove any numbers from the textarea value
  const newValue = value.replace(/\d/g, '');
  
  // Update the textarea value with the filtered value
  event.target.value = newValue;
});*/
// Get the textarea element
const textarea = document.getElementById('monuments');

// Add an input event listener to the textarea
textarea.addEventListener('input', function(event) {
  // Get the current textarea value
  const value = event.target.value;
  
  // Remove any non-numeric characters from the textarea value
  const newValue = value.replace(/\D/g, '');
  
  // Update the textarea value with the filtered value
  event.target.value = newValue;
});
// Get the textarea element
const textarea = document.getElementById('ID_guide');

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

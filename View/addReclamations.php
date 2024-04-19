<?php

include '../Controller/ReclamationsC.php';
include '../Model/Reclamations.php';

$error = "";

// create client


// create an instance of the controller
$ReclamationsC = new ReclamationsC();

if (
    isset($_POST["id_client"]) &&
    isset($_POST["date_reclamation"]) &&
    isset($_POST["titre_reclamation"])&&
    isset($_POST["contenu"])
) {
    if (
        !empty($_POST['id_client']) &&
        !empty($_POST["date_reclamation"]) &&
        !empty($_POST["titre_reclamation"])&&
        !empty($_POST["contenu"])
    ) {
        $Reclamations = new Reclamations(
            $_POST['id_client'],
            $_POST['date_reclamation'],
            $_POST['titre_reclamation'],
            $_POST['contenu']
        );

        if ($Reclamations instanceof Reclamations) {
            $ReclamationsC->addReclamations($Reclamations);
            
            // Redirect to the listReclamations.php page
            header('Location: listReclamations.php');
            exit();
        } else {
            echo 'Failed to create a valid Reclamation object.';
        }
    } 
    else {
        $error = "Missing information";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamations</title>

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
        #erreurIdClient,
        #erreurPrenom,
        #erreurAge,
        #erreurnumTel,
        #erreurEmail,
        #erreurnbvoyages
        {
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
<button><a href="listReclamations.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
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
            <!-- <div class="mb-3"> -->
    <!-- <label for="date_de_reclamation" class="form-label">Choisir une date :</label> -->
    <!-- <input type="date" class="form-control" id="date-de_reclamation" name="date_de_reclamation"> -->
<!-- </div> -->

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


  
</body>

</html>

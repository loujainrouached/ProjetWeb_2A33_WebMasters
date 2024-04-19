<?php
include "../controller/GuideC.php";
require_once "../Model/Guide.php";

$error = "";
$guides = null;
$guidec = new functions();

$ID_guide=$_POST["ID_guide"];

if (
    isset($_POST["Nom"]) &&
    isset($_POST["Prenom"])&&
    isset($_POST["Age"])&&
    isset($_POST["numTel"])&&
    isset($_POST["Email"])&&
    (isset($_POST["nbvoyages"])
    
    )
 ) {
    if (
        !empty($_POST['Nom']) &&
        !empty($_POST['Prenom'])&&
        !empty($_POST['Age'])&&
        !empty($_POST['numTel'])&&
        !empty($_POST['Email'])&&
        !empty($_POST['nbvoyages'])
        

    ) 
   
        // Create the blog object
        $guides = new guides(
            null,
            $_POST['Nom'],
            $_POST['Prenom'],
            $_POST['Age'],
            $_POST['numTel'],
            $_POST['Email'],
            $_POST['nbvoyages']
          
            
        );

       
        $guidec->updateGuide($guides,$ID_guide);
        echo"guide information updated successfully";
        header('Location:listGuide.php');
        exit(); // Ensure to terminate execution after redirect
    } else {
        $error = "Please fill in all required fields.";
    }


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
    <a href="listGuide.php">Back to list</a>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>
    <form action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="Nom">Nom :</label></td>
                <td>
                    <input type="text" id="Nom" name="Nom" />
                    <span id="erreurNom" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="Prenom">Prenom :</label></td>
                <td>
                    <input type="text" id="Prenom" name="Prenom" />
                    <span id="erreurPrenom" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="Age">Age :</label></td>
                <td>
                    <input type="text" id="Age" name="Age" />
                    <span id="erreurAge" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="numTel">numTel :</label></td>
                <td>
                    <input type="text" id="numTel" name="numTel" />
                    <span id="erreurtitre" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="Email">Email :</label></td>
                <td>
                    <input type="text" id="Email" name="Email" />
                    <span id="erreurEmail" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="nbvoyages">nbvoyages :</label></td>
                <td>
                    <input type="text" id="nbvoyages" name="nbvoyages" />
                    <span id="erreurnbvoyages" style="color: red"></span>
                </td>
            </tr>
            

                <td>
                    <input type="submit" value="Save">
                    <input type="hidden" value="<?php echo $_POST["ID_guide"] ?> "name="ID_guide">

                </td>

                <td>
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
    <script>
        
  const nameInput = document.getElementById("Nom");
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

</script>
</body>

</html>



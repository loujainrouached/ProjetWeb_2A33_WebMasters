<?php
include "../Controller/GuideC.php";


$error = "";
$guides=null;
$guidec = new functions();

if (
    isset($_POST["ID_guide"]) &&
    isset($_POST["Nom"]) &&
    isset($_POST["Prenom"]) &&
    isset($_POST["Age"]) &&
    isset($_POST["numTel"]) &&
    isset($_POST["Email"]) &&
    isset($_POST["nbvoyages"])
) {
    if (
        !empty($_POST['ID_guide']) &&
        !empty($_POST['Nom']) &&
        !empty($_POST['Prenom']) &&
        !empty($_POST['Age']) &&
        !empty($_POST['numTel']) &&
        !empty($_POST['Email']) &&
        !empty($_POST['nbvoyages'])
    ) {
        // Create the guide object
        $guides = new guides(
            $_POST['ID_guide'],
            $_POST['Nom'],
            $_POST['Prenom'],
            $_POST['Age'],
            $_POST['numTel'],
            $_POST['Email'],
            $_POST['nbvoyages']
        );
        $Nom= $_POST['Nom'];
        $nomRegExp = "/^[A-Za-z]+$/"; // Expression régulière pour vérifier que le nom et le prénom ne contiennent que des lettres
       

        // Vérifier le nom
        if (!preg_match($nomRegExp, $Nom)) {
            echo '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; background-color: #ffe6e6; padding: 20px; border: 1px solid #ff0000; color: #ff0000; font-size: 20px; border-radius: 5px;">Verifier Nom  !!!!</div>';
            die(); // Arrête l'exécution du script après l'affichage du message
            //die(" verifier le Nom !!!! ");
        }
        $Prenom= $_POST["Prenom"];
        $nomRegExp = "/^[A-Za-z]+$/"; // Expression régulière pour vérifier que le nom et le prénom ne contiennent que des lettres
       

        // Vérifier le Prenom
        if (!preg_match($nomRegExp, $Prenom)) {
            echo '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; background-color: #ffe6e6; padding: 20px; border: 1px solid #ff0000; color: #ff0000; font-size: 20px; border-radius: 5px;">Verifier Prenom !!!!</div>';
            die(); // Arrête l'exécution du script après l'affichage du message
            // die(" verifier le Nom  !!!! ");
        }
       

$Email = $_POST['Email'];
$emailRegExp = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/"; // Regular expression to check the email format

// Validate the email
if (!preg_match($emailRegExp, $Email)) {
    echo '<div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; background-color: #ffe6e6; padding: 20px; border: 1px solid #ff0000; color: #ff0000; font-size: 20px; border-radius: 5px;">Verifier Email !!!!</div>';
    die();
}

        // Add the guide to the database
        $guidec->addGuide($guides);
        echo "Guide information added successfully.";
        header('Location: listGuide.php');
        exit(); // Ensure to terminate execution after redirect
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Display</title>
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
        #erreurNom,
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

</head>

<body>
    <a href="listGuide.php">Back to list</a>
    <hr>
    <div id="error">
        <?php echo $error; ?>
    </div>
    <form action="" method="POST">
        <table>
        <tr>
                <td><label for="ID_guide">ID_guide :</label></td>
                <td><input type="number" id="ID_guide" name="ID_guide" /></td>
            </tr>
            <tr>
                <td><label for="Nom">Nom :</label></td>
                <td><input type="text" id="Nom" name="Nom" /></td>
            </tr>
            <tr>
                <td><label for="Prenom">Prenom :</label></td>
                <td><input type="text" id="Prenom" name="Prenom" /></td>
            </tr>
            <tr>
                <td><label for="Age">Age :</label></td>
                <td><input type="number" id="Age" name="Age" /></td>
            </tr>
            <tr>
                <td><label for="numTel">numTel :</label></td>
                <td><input type="number" id="numTel" name="numTel" /></td>
            </tr>
            <tr>
                <td><label for="Email">Email :</label></td>
                <td><input type="text" id="Email" name="Email" /></td>
            </tr>
            <tr>
                <td><label for="nbvoyages">nbvoyages :</label></td>
                <td><input type="number" id="nbvoyages" name="nbvoyages" /></td>
            </tr>
            <tr>
                <td><input type="submit" value="Save"></td>
                <td><input type="reset" value="Reset"></td>
            </tr>
        </table>
    </form>
    <script>
      /* const nameInput = document.getElementById("Nom");
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

        // JavaScript validation script (name validation)
        const nameInput = document.getElementById("Prenom");
        const nameError = document.getElementById("erreurPrenom");

        nameInput.addEventListener("input", function () {
            if (!/^[A-Za-z\s]+$/.test(nameInput.value)) {
                nameError.innerText = "Please enter only letters.";
                nameError.style.display = "block"; // Display the error message
            } else {
                nameError.innerText = ""; // Clear error message
                nameError.style.display = "none"; // Hide the error message
            }
        });*/
        // Get the textarea element
// Get the textarea element
/*function validateForm() {
  var Nom = document.getElementById('Nom').value;
  var test = true; // Initialize test to true
  var Prenom = document.getElementById('Prenom').value;
  var Email = document.getElementById('Email').value;
  var nomRegExp = /^[A-Za-z]+$/; // Regular expression to check that the name and surname contain only letters
  var emailRegExp = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regular expression to check the email format
  
  // Get the error elements
  var nomError = document.getElementById('nomError');
  var prenomError = document.getElementById('prenomError');
  var emailError = document.getElementById('emailError');
  
  // Reset error messages
  nomError.textContent = '';
  prenomError.textContent = '';
  emailError.textContent = '';
  
  // Check the name
  if (!nomRegExp.test(Nom)) {
    nomError.textContent = 'Nom incorrect';
    test = false; // Set test to false if validation fails
  }

  // Check the surname
  if (!nomRegExp.test(Prenom)) {
    prenomError.textContent = 'Prénom incorrect';
    test = false; // Set test to false if validation fails
  }

  // Check the email
  if (!emailRegExp.test(Email)) {
    emailError.textContent = 'Email incorrect';
    test = false; // Set test to false if validation fails
  }

  return test; // Allow form submission if all validations pass
}
}*/
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
});
// Get the textarea element
const textarea = document.getElementById('Age');

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
const textarea = document.getElementById('numTel');

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
const textarea = document.getElementById('nbvoyages');

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




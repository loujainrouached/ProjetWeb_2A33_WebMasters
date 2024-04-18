<?php
include '../Controller/VoyageC.php'; // Supposons que VoyageC.php se trouve dans le répertoire Controller

$id = $_GET["id"];

if (isset($_POST["submit"])) {
    // Récupérer les valeurs du formulaire
    $type = $_POST['type'];
    $destination = $_POST['destination'];
    $dateDepart = $_POST['dateDepart'];
    $dateRetour = $_POST['dateRetour'];
    $targetFile = '';

    // Vérifier si une nouvelle image a été téléchargée
    if (isset($_FILES['new_image']) && $_FILES['new_image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "upload/";
        $targetFile = $targetDir . basename($_FILES['new_image']['name']);

        // Assurez-vous que c'est une vraie image
        $check = getimagesize($_FILES['new_image']['tmp_name']);
        if ($check === false) {
            echo "Le fichier n'est pas une image.";
            exit;
        }

        // Déplacer le fichier téléchargé vers le dossier cible
        if (!move_uploaded_file($_FILES['new_image']['tmp_name'], $targetFile)) {
            echo "Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
            exit;
        }
    }
    
    // Mettre à jour le voyage avec la nouvelles image si une a été téléchargée
    $voyageC = new VoyageC();
    $result = $voyageC->updateVoyage($id, $type, $destination, $dateDepart, $dateRetour, $targetFile);

    if ($result) {
        header("Location: element.php?msg=Données mises à jour avec succès");
        exit;
    } else {
        echo "Échec de la mise à jour des données.";
    }   
}


$db = config::getConnexion();
    // Prépare la requête SQL avec un paramètre de placeholder (:id)
    $sql = "SELECT * FROM Voyage WHERE id = :id LIMIT 1";
    $query = $db->prepare($sql);
    
    // Lie le paramètre :id à la valeur de $id
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    
    // Exécute la requête préparée
    $query->execute();
    
    // Récupère le résultat de la requête
    $row = $query->fetch(PDO::FETCH_ASSOC);

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP CRUD </title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #55566a;">
   Modifier un voyage?
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

   
    <div class="container d-flex justify-content-center">
    <form method="post" enctype="multipart/form-data" style="width:50vw; min-width:300px;">

        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Type</label>
            <input type="text" class="form-control" name="type" value="<?php echo $row['type'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Destination</label>
            <input type="text" class="form-control" name="destination" value="<?php echo $row['destination'] ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Date Depart</label>
          <input type="date" class="form-control" name="dateDepart" value="<?php echo $row['dateDepart'] ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Date Retour</label>
          <input type="date" class="form-control" name="dateRetour" value="<?php echo $row['dateRetour'] ?>">
        </div>

        <div class="mb-3">
        <label class="form-label">Image:</label>
        <input type="file" id="new_image" name="new_image" accept="image/*" class="form-control" value="<?php echo $row['image'] ?>">
    </div>
        
       

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="element.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>


<?php
include "../Controller/EmployeC.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    // Récupérer l'email soumis depuis le formulaire
    $email = $_POST["email"];

    // Créer une instance de la classe UserC
    $userC = new UserC();

    // Appeler la fonction userExists pour vérifier si l'utilisateur existe
    if ($userC->userExists($email)) {
        $message = "Cet utilisateur existe déjà.";
    } else {
        $message = "Cet utilisateur n'existe pas encore.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification de l'utilisateur</title>
</head>
<body>
    <h1>Vérification de l'utilisateur</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="email">Adresse e-mail :</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Vérifier</button>
    </form>
    
    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
</body>
</html>

<?php
require_once __DIR__."/../controller/commentaireC.php";

$commentaireC = new commentaireC();
$tab = $commentaireC->liste_commentaire();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Content Start -->
        <div class="content">


        
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Liste des commentaires</h6>
                        <form id="searchForm">
    <input type="text" id="searchInput" placeholder="Search...">
    <button type="submit">Search</button>
</form>
                        <a href="">Show All</a>
                    </div>

        <!--Liste des commentaire-->
                    <div class="tablecommentaires">
        <table width="70%" align="center" id="tablecom" class="table text-start align-middle table-bordered table-hover mb-0">
            <tr>
                <th>ID_commentaire</th>
                <th>contenu_commentaire</th>
                <th>date_de_publication_</th>
            </tr>
 

            <?php
            foreach ($tab as $commentaire){
            ?>
                <tr>
                    <td><?= $commentaire['ID_commentaire']; ?></td>
                    <td><?= $commentaire['contenu_commentaire']; ?></td>
                    <td><?= $commentaire['date_de_publication_']; ?></td>
                    <td align="center">
                                    <form method="POST" action="updatecommentaire.php">
                                        <input type="submit" name="update" value="Update">
                                        <input type="hidden" value=<?PHP echo $commentaire['ID_commentaire']; ?> name="ID_commentaire">
                                    </form>
                                </td>
                                <td>
                            <a href="deletecommentaire.php?ID_commentaire=<?= $commentaire['ID_commentaire']; ?>" onclick="return confirm('Are you sure you want to delete this ?')">Delete</a>
                                </td>
                </tr>
            <?php
            }
            ?>
        </table>
        </div>
                </div>
            </div>
            <!-- Recent Sales End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                  
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script>
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche la soumission du formulaire

        var searchTerm = document.getElementById('searchInput').value.toLowerCase(); // Récupère la valeur saisie dans le champ de recherche
        var tableRows = document.getElementById('tablecom').getElementsByTagName('tr'); // Récupère toutes les lignes du tableau

        // Parcours toutes les lignes du tableau sauf la première (en-têtes)
        for (var i = 1; i < tableRows.length; i++) {
            var row = tableRows[i];
            var rowData = row.getElementsByTagName('td'); // Récupère les données de chaque cellule de la ligne

            var rowVisible = false; // Indique si la ligne doit être affichée ou non

            // Parcours les données de chaque cellule de la ligne
            for (var j = 0; j < rowData.length; j++) {
                var cellData = rowData[j].textContent.toLowerCase(); // Récupère le texte de la cellule en minuscules

                // Si le texte de la cellule contient le terme de recherche, la ligne doit être affichée
                if (cellData.includes(searchTerm)) {
                    rowVisible = true;
                    break; // Sort de la boucle interne si le terme est trouvé dans une cellule
                }
            }

            // Affiche ou masque la ligne en fonction du résultat de la recherche
            if (rowVisible) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
</script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
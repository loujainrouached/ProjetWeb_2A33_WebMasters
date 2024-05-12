<?php

//require_once __DIR__."/../Controller/ReclamationsC.php";

//require_once __DIR__."/../Controller/ReponsesC.php";
//require_once __DIR__.'/../Controller/ReponsesC.php';

include "../Controller/ReclamationsC.php";
include "../Controller/ReponsesC.php";


// Establish database connection (replace with your connection details)





?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    
    
    
    
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   
    <title>DASHMIN - Bootstrap Admin Template</title>
    
    <link rel="stylesheet" href="css_todo/style.css">
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
    <link href="lib1/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib1/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css1/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css1/style.css" rel="stylesheet">

    <style>
        /* Orange pastel background color */
        body {
            background-color: #FFDAB9;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Styles for the table */
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto; /* Center the table */
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #FFA500;
        }

        /* Styles for the headings */
        h1,
        h2 {
            text-align: center;
            color: #25BDC4; /* Orange Red color for headings */
        }

        /* Link style for '' */
        a {
            text-decoration: none;
            color: #25BDC4;
        }

        /* Link style for ' */
        .delete-link {
            color: red;
            text-decoration: none;
        }

        /* Update button style */
        input[type="submit"] {
            background-color: #FFA500;
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .table {
    background-color: #F6E6D1;
}

.table th,
.table td {
    background-color: #F6E6D1;
}

.table th {
    border-color: #FFA500;
}

.table-bordered th,
.table-bordered td {
    border-color: #F6E6D1;
}
    </style>
        <style>
/* Style pour agrandir le champ de sélection */

#id_reclamation {
  width: 300px; /* Vous pouvez ajuster cette valeur selon vos besoins */
}
</style>
<style>
.rounded-label {
    border-radius:2em;   /* Pour arrondir les coins */
    background-color: #f0f0f0; /* Couleur de fond */
    padding: 5px 10px; /* Espacement intérieur pour le texte */
    display: inline-block; /* Pour que le padding s'applique correctement */
}

        </style>

</head>

<body>
    
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
         <!-- Sidebar Start -->
         <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html">
                    <h5 class="text-primary"><i class="fa fa-hashtag me-2"></i><img src="tayara.png" alt="VieXplore Logo" class="me-3"><br><center>VieXplore</center><br><br></h5>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                    <h6 class="mb-0">loj</h6>
                     
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                <a href="ListEmployes.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Voyage</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="voyage_back.php" class="dropdown-item">liste voyage</a>
                            <a href="reservation_back.php" class="dropdown-item">liste reservation</a>
                     
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>guide</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="button.html" class="dropdown-item">liste des guides</a>
                                <a href="typography.html" class="dropdown-item">liste des cv</a>
                         
                            </div>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Article de blog</a>
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="button.html" class="dropdown-item">liste ds article postes</a>
                                    <a href="typography.html" class="dropdown-item">liste des commentaires</a>
                             
                                </div>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Clients</a>
                                    <div class="dropdown-menu bg-transparent border-0">
                                        <a href="listReclamations.php" class="dropdown-item">liste reclamation</a>
                                        <a href="form.php" class="dropdown-item">liste reponse</a>
                                 
                                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        
                    <!-- Content Start -->
   
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">John Doe</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Typography Start -->

                 <!-- Content Start -->
           <div class="content">
            <!-- Recent Sales Start -->
        <div class="container-fluid contact bg-light py-5">
          <!-- <a href="searchReponse.php" class="btn btn-outline-success m-2">CHERCHER</a> -->
          <!-- <button type="button" class="btn btn-outline-success m-2">Success</button -->
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Liste des réclamations</h5>
                <a href="">Show All</a>
                
                <form id="searchForm">
                
    <input type="text" id="searchInput" class="rounded-label" placeholder="Search...">
    <button type="submit"class="btn btn-outline-success m-2">Search</button>
</form>
            </div>
            <div class="container">
    <div class="table-responsive">
        <table class="table text-start align-middle table-bordered table-hover mb-0" id="reponsesTable">
            <thead>
                <tr>
                    <th>Id réclamation</th>
                    <th>Id client</th>
                    <th>Date de réclamation</th>
                    <th>Titre de réclamation</th>
                    <th>Contenu</th>
                    <th>Delete</th>
                    <th>Réponses</th>
                    <th>Ajouter une réponse</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'censor.php';
                $c = new ReclamationsC();
                $tab = $c->listReclamationsAdmin();
                if (is_array($tab) || is_object($tab)) {
                    foreach ($tab as $Reclamations) {
                        $censoredWords = ['marzouk', 'mariem', 'bessem'];
                        $contenu_censored = censorReclamation($Reclamations['contenu'], $censoredWords);
                ?>
                        <tr>
                            <td><?= $Reclamations['id_reclamation']; ?></td>
                            <td><?= $Reclamations['id_user']; ?></td>
                            <td><?= $Reclamations['date_reclamation']; ?></td>
                            <td><?= $Reclamations['titre_reclamation']; ?></td>
                            <td><?= $contenu_censored; ?></td>
                            <td>
                                <a href="deleteReclamations.php?id_reclamation=<?= $Reclamations['id_reclamation']; ?>" onclick="return confirm('Are you sure you want to delete this ?')">Delete</a>
                            </td>
                            <td>
                                <?php
                                $reponses = new ReponsesC();
                                // Utilisation de la méthode getReponses() pour récupérer les réponses associées à cette réclamation
                                $reponses = $c->getReponsesForReclamation($Reclamations['id_reclamation']);
                                if ($reponses)
                                 {
                                    foreach ($reponses as $reponse) {
                                ?>
                                        <div style="color: orange;">Réponse : </div>
                                        <?= $reponse['rep']; ?>
                                        <div style="color: orange;">Date : </div>
                                        <?= $reponse['date_reponse']; ?>
                                <?php
                                    }
                                } else {
                                    echo "<div>Pas de réponse pour cette réclamation</div>";
                                }
                                ?>
                            </td>
                            <td><a href="addReponse.php?id_reclamation=<?= $Reclamations['id_reclamation']; ?>" onclick="return confirm('Are you sure you want to respond ?')">Ajouter une réponse</a></td>

                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> -->

       
                </table>
                </div>
               <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

               <?php
              $result = $c->getReponses();

             // Obtenez les labels et les données de réservation
             $labels = $result['labels'];
             $data = $result['data'];
             ?>
            <div style="width:30%">
              <canvas id="myChart"></canvas>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
                <script>
                
                    // Préparer les données pour le graphique
                    var labels = <?php echo json_encode($labels); ?>;
                    var data = <?php echo json_encode($data); ?>;

                    // Créer le graphique circulaire
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'NOMBRE DE REPONSES PAR RECLAMATION',
                                data: data,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            aspectRatio: 1, // Pour s'assurer que le graphique est un cercle
                            scales: {
                                y: {
                                    display: false
                                }
                            }
                            
                        }
                    });
                </script>
                


              
                  
        <script>
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche la soumission du formulaire

        var searchTerm = document.getElementById('searchInput').value.toLowerCase(); // Récupère la valeur saisie dans le champ de recherche
        var tableRows = document.getElementById('reponsesTable').getElementsByTagName('tr'); // Récupère toutes les lignes du tableau

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
<script>
    // Fonction pour trier le tableau en fonction de la colonne spécifiée
    function sortTable(columnIndex) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("reponsesTable");
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("td")[columnIndex];
                y = rows[i + 1].getElementsByTagName("td")[columnIndex];
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

    // Ajoute un gestionnaire d'événements à chaque en-tête de colonne
    window.onload = function() {
        var headers = document.querySelectorAll("#reponsesTable th");
        headers.forEach(function(header, index) {
            header.addEventListener("click", function() {
                sortTable(index);
            });
        });
    };
</script>


   

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib1/chart/chart.min.js"></script>
    <script src="lib1/easing/easing.min.js"></script>
    <script src="lib1/waypoints/waypoints.min.js"></script>
    <script src="lib1/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib1/tempusdominus/js/moment.min.js"></script>
    <script src="lib1/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib1/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js1/main.js"></script>
    </div>
    </div>  
</body>

</html>
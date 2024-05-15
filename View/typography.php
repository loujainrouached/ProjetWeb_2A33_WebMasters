<?php
include "../Controller/GuideC.php";

session_start();


  // Incluez votre classe ReclamationsC et tout autre fichier nécessaire
  function countUnreadReclamations()
  {
      $sql = "SELECT COUNT(*) AS count FROM reclamations WHERE vue_par_admin = 0";
      $db = config::getConnexion();
      try {
          $stmt = $db->query($sql);
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
          return $result['count'];
      } catch (Exception $e) {
          die('Error:' . $e->getMessage());
      }
  }

  $unreadCount=countUnreadReclamations();
  
  
  
  function listUnreadReclamationsAdmin()
  {
      $sql = "SELECT * FROM reclamations WHERE vue_par_admin = 0";
      $db = config::getConnexion();
      try {
          $stmt = $db->query($sql);
          $rec = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $rec;
      } catch (Exception $e) {
          die('Error:' . $e->getMessage());
      }
  }
$c = new functions();
$tab = $c->listGuide();

if(isset($_SESSION['id_user'])) {
    // Connexion à la base de données
    $db = config::getConnexion();

    // Récupérer les informations de l'utilisateur à partir de la base de données en utilisant l'ID stocké dans la session
    $userId = $_SESSION['id_user'];
    $sql = "SELECT prenom_user, nom_user FROM table_users WHERE id_user = :id_user";
    $query = $db->prepare($sql);
    $query->execute(['id_user' => $userId]);

    // Récupérer le prénom et le nom de l'utilisateur
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le prénom de l'utilisateur est défini avant de l'afficher dans le HTML
    if(isset($user['prenom_user']) && isset($user['nom_user'])) {
        $prenom_user = $user['prenom_user'];
        $nom_user = $user['nom_user'];
    }
}
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
    <link href="lib1/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib1/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css1/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css1/style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Guides</title>
    <style>
        /* Orange pastel background color */
       
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
        
        }

        /* Styles for the headings */
        h1,
        h2 {
            text-align: center;
            color: ##25BDC4; /* Orange Red color for headings */
        }

        /* Link style for 'Add a guide' */
        a {
            text-decoration: none;
            color: ##25BDC4;
        }

        /* Link style for 'Delete' */
        .delete-link {
            color: red;
            text-decoration: none;
        }

        /* Update button style */
        input[type="submit"] {
            
            border: none;
            color: black;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
    
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


    
   <!-- Sidebar Start -->
   <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="ListEmployes.php">
                    <h5 class="text-primary"><i class="fa fa-hashtag me-2"></i><img src="tayara.png" alt="VieXplore Logo" class="me-3"><br><center>VieXplore</center><br><br></h5>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">


                    <?php if(isset($prenom_user) && isset($nom_user)) : ?>
    <span class="mb-0"><?php echo $prenom_user . ' ' . $nom_user; ?></span>
<?php endif; ?>
 
                     
                    
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
                            <a href="button.php" class="dropdown-item">liste des pays</a>
                            <a href="typography.php" class="dropdown-item">liste des guides</a>
                            <a href="vexo.html" class="dropdown-item">vexo the chatbot</a>
                         
                            </div>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Article de blog</a>
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="ListeArticles.php" class="dropdown-item">liste ds article postes</a>
                                  
                                </div>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Clients</a>
                                    <div class="dropdown-menu bg-transparent border-0">
                                        <a href="listReclamations.php" class="dropdown-item">liste reclamation</a>
                                        
                                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
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
                                    
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                   
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                       
                            <i class="fa fa-bell me-lg-2 position-relative">
                            <span class="badge bg-danger rounded-circle position-absolute top-0 start-100 translate-middle"><?php echo $unreadCount; ?></span>
                        </i>
                        <span class="d-none d-lg-inline-flex">Notification</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                        <!-- Ajoutez ici les réclamations non lues -->
                        <?php
                        // Récupérer les réclamations non lues
                        $unreadReclamations =listUnreadReclamationsAdmin();
                        foreach ($unreadReclamations as $reclamation) {
                            echo '<a href="#" class="dropdown-item">';
                            echo '<h6 class="fw-normal mb-0">' . $reclamation["titre_reclamation"] . '</h6>';
                            echo '<small>' . $reclamation["date_reclamation"] . '</small>';
                            echo '</a>';
                            echo '<hr class="dropdown-divider">';
                        }
                        ?>
                            <a href="listReclamations.php" >See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                          <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
<?php if(isset($prenom_user) && isset($nom_user)) : ?>
    <span class="d-none d-lg-inline-flex"><?php echo $prenom_user . ' ' . $nom_user; ?></span>
<?php endif; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="profil.php" class="dropdown-item">My Profile</a>
                         
                            <a href="Connexion.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Typography Start -->
            <h1>Liste des guides</h1>
    <h2>
        <a href="addGuide.php">ajouter un guide</a>
    </h2>
    <?php
$tab = array();

// Check if the sorting form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['sorting_type'])) {
    $sortingType = $_GET['sorting_type'];

    // Create an instance of the controller
    $f = new functions();

    // Call the sorting function based on the sorting type
    if ($sortingType === 'age') {
        // Sorting by age
        $tri = $_GET['tri'];
        if ($tri === 'asc' || $tri === 'desc') {
            $tab = $f->tripAge(strtoupper($tri));
        } else {
            // Handle other sorting cases if necessary
        }
    } elseif ($sortingType === 'voyages') {
        // Sorting by number of voyages
        $triv = $_GET['triv'];
        if ($triv === 'asc' || $triv === 'desc') {
            $tab = $f->tripnbvoyages(strtoupper($triv));
        } else {
            // Handle other sorting cases if necessary
        }
    }
} else {
    // If no sorting is specified, display the unsorted list by default
    $f = new functions();
    $tab = $f->tripAge(); // For example, ascending sorting by default
}
?>
<form method="GET" action="typography.php">
    <!-- First form for sorting by age -->
    <input type="hidden" name="sorting_type" value="age">
    <label for="tri">Trier Age :</label>
    <select name="tri" id="tri">
        <option value="asc">Ascendant</option>
        <option value="desc">Descendant</option>
    </select>
    <button type="submit">Trier</button>
</form>
<form method="GET" action="typography.php">
    <!-- Second form for sorting by number of voyages -->
    <input type="hidden" name="sorting_type" value="voyages">
    <label for="triv">Trier nombre de voyages :</label>
    <select name="triv" id="triv">
        <option value="asc">Ascendant</option>
        <option value="desc">Descendant</option>
    </select>
    <button type="submit">Trier</button>
    
</form>
<a href="PDFGuides.php" target="_blank">Generate PDF</a>
    <table id="dataTable" border="1" align="center">
        <tr>
            <th>ID_guide</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Age</th>
            <th>numTel</th>
            <th>Email</th>
            <th>nbvoyages</th>
            <th>ID_pays</th>
           
            <th>Update</th>
            <th>Delete</th>
            
        </tr>
        <?php
        foreach ($tab as $guide) {
        ?>
        <tr>
            <td><?= $guide['ID_guide']; ?></td>
            <td><?= $guide['Nom']; ?></td>
            <td><?= $guide['Prenom']; ?></td>
            <td><?= $guide['Age']; ?></td>
            <td><?= $guide['numTel']; ?></td>
            <td><?= $guide['Email']; ?></td>
            <td><?= $guide['nbvoyages']; ?></td>
            <td><?= $guide['ID_pays']; ?></td>
            <td align="center">
            
            <form method="POST" action="updateguide.php">
    <button type="submit" name="update" class="update-button">
        <img src="update.png" alt="Update" class="me-3" style="width: 50px; height: 60px;">
    </button>
    <input type="hidden" value="<?= $guide['ID_guide']; ?>" name="ID_guide">
</form>
            </td>
            <td>
            <a href="deleteGuide.php?ID_guide=<?= $guide['ID_guide']; ?>" class="delete-link">
    <h5 class="text-primary">
        <img src="TRASH.png" alt="Trash" class="me-3" style="width: 70px; height: 60px;">
    </h5>
</a>
            </td>
           
        </tr>
        <?php
        }
        ?>
       
    </table>
  
  
<?php
    $functions = new functions();

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['guides']) && isset($_POST['search'])) {
        $ID_pays= $_POST['guides'];
        $list = $functions->afficheGuide($ID_pays);
        // Further processing here...
    }
}
?>
    <h3>Recherche de guides par pays </h3>
    
    <form action="" method="POST">
        <label for="guides">Sélectionnez un pays :</label>
        <select name="guides" id="guides">
        <?php
           $pays= $functions->affichePays();
            foreach ($pays as $pays) {
                echo '<option value="' . $pays['ID_pays'] . '">' . $pays['ID_pays']    . $pays['NomP']  . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Rechercher" name="search">
        <?php 
    if (isset($list)) { ?>
        <br>
        <h3>guides correspondants au pays sélectionné :</h3>
        <ul>
            <?php foreach ($list as $guides) { ?>
                <li>
                    <h6><?= $guides['Nom']  ?></h6>
                    <h6><?= $guides['Prenom'] ?></h6>
                    
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
    </form> 
    <form class="d-none d-md-flex ms-4" method="GET" action="typography.php">
    <input class="form-control border-0" type="search" name="Nom" placeholder="Saisir le nom du guide">
    <button type="submit" class="btn btn-primary">Search</button>
</form>

<?php
// Check if the form has been submitted
if (isset($_GET['Nom'])) {
    // Sanitize the input to prevent SQL injection
    $Nom = htmlspecialchars($_GET['Nom']);

    // Assuming functions is your class for database operations
    $functions = new functions();

    // Use prepared statements for better security
    $result = $functions->searchGuide($Nom);

    // Display results only if there are any
    if ($result) {
?>
        <table border="1" align="center">
            <tr>
                <th>ID_guide</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Age</th>
                <th>numTel</th>
                <th>Email</th>
                <th>ID_pays</th>
                <th>email</th>
                
    </tr>
            
                
    
<?php
        foreach ($result as $guide) {
?>
            <tr>
                <td><?= ($guide['ID_guide']); ?></td>
                <td><?= ($guide['Nom']); ?></td>
                <td><?= ($guide['Prenom']); ?></td>
                <td><?= ($guide['Age']); ?></td>
                <td><?= ($guide['numTel']); ?></td>
                <td><?= ($guide['Email']); ?></td>
                <td><?= ($guide['ID_pays']); ?></td>
                <td>
                <a href="traitement.php" class="email">
                    <img src="email.jpg" alt="email" class="me-3" style="width: 50px; height: 40px;">
                </a>
            </td>
            
           
    </tr>
            </tr>
<?php
        }
?>
        </table>
<?php
    } else {
        echo "<p>ce guide n'existe pas .</p>";
    }
}
?>


            <!-- Typography End -->


            <!-- Footer Start -->
            <?php
$result = $functions->getvoyages();

// Obtenez les labels et les données de réservation
$labels = $result['labels'];
$data = $result['data'];
?>
<div style="width: 30%">
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
                label: 'Nombre de voyages par guide',
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

                   
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">VieExplore</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

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
</body>

</html>
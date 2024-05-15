<?php



include "../Controller/EmployeC.php";
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



// Instancier votre classe ReclamationsC$reclamationsC = new ReclamationsC();

// Appeler la fonction pour compter les réclamations non lues$unreadCount = $reclamationsC->countUnreadReclamations();


$user1 = new UserC();


if (isset($_GET['action']) && $_GET['action'] == 'supp' && isset($_GET['id_user'])) {
    $user1->deleteuser($_GET['id_user']);
    header("Location: " . strtok($_SERVER["PHP_SELF"], '?'));
    exit;
}

// Si une recherche par e-mail est effectuée, récupérez l'e-mail saisi et affichez l'utilisateur correspondant
if (isset($_POST['searchEmail'])) {
    $email = $_POST['searchEmail'];
    $tab = $user1->afficherParEmail($email);
} else {
    // Sinon, affichez tous les utilisateurs
    $tab = $user1->listeEmploye();
}

// Vérifiez si la nature a été sélectionnée dans le formulaire
if (isset($_POST['nature']) && !empty($_POST['nature'])) {
    // Récupérez la valeur de la nature sélectionnée
    $nature = $_POST['nature'];
    if ($nature === 'Admin') {
        $tab = $user1->afficherParAdmin(); // Afficher les administrateurs
    } else if ($nature === 'Client') {
        $tab = $user1->afficherParClient(); // Afficher les clients
    }
}

// Si aucune nature n'a été sélectionnée et aucune recherche par e-mail n'a été effectuée, affichez tous les utilisateurs
if (!isset($_POST['searchEmail']) && (!isset($_POST['nature']) || empty($_POST['nature']))) {
    $tab = $user1->listeEmploye();
}


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


<style>
    /* Style pour rendre les icônes cliquables */
    .icon {
        cursor: pointer;
        margin-right: 5px;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VieXplore - Backoffice</title>
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
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                    <form method="POST" action="addEmploye.php">
                    <input type="submit" name="Ajouter un Admin" value="Ajouter un Admin">
                </form>
                    </div>
   <!-- Formulaire de recherche par e-mail -->
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="d-flex">
    <div class="me-2">
        <input type="text" class="form-control" id="searchEmail" name="searchEmail" placeholder="Taper un e-mail">
    </div>
    <button type="submit" class="btn btn-warning">Rechercher</button>
</form>

<!-- Formulaire de filtrage par nature -->
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="d-flex mt-2">
    <select class="form-select me-2" name="nature">
        <option value="Admin">Admin</option>
        <option value="Client">Client</option>
    </select>
    <button type="submit" class="btn btn-primary">Filtrer</button>
</form>
<script>
    document.getElementById("searchButton").addEventListener("click", function(event) {
        event.preventDefault(); // Empêche le comportement par défaut du bouton (envoi du formulaire)

        // Récupère la valeur de l'e-mail saisi
        var email = document.getElementById("searchEmail").value;

        // Soumet le formulaire
        document.getElementById("searchForm").submit();
    });
</script>





                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead> 






<tr class="text-dark">
    <th  scope="col">Id</th>
    <th  scope="col">Nom</th>
    <th  scope="col">Prénom</th>
    <th  scope="col">Email</th>
    <th  scope="col">Mot de passe</th>
    <th scope="col">Confirmation Mdp</th>
    <th  scope="col">Nature</th>
    <th  scope="col">Photo</th>
    <th  scope="col">delete</th>
    <th  scope="col">Update</th>
</tr>
</thead>
                            <tbody>
<?php foreach ($tab as $user): ?>
    <tr>
        <td><?= $user['id_user']; ?></td>
        <td><?= $user['nom_user']; ?></td>
        <td><?= $user['prenom_user']; ?></td>
        <td><?= $user['email_user']; ?></td>
        <td>******</td>
        <td>******</td>
        <td><?= $user['nature_user']; ?></td>
        <td><img src="<?= $user['photo_user']; ?>" width="100px" height="70px"></td>
        <td>
            <a href="javascript:void(0);" onclick="confirmDelete(<?= $user['id_user']; ?>);">
                <img src="TRASH111.PNG" alt="Supprimer" class="icon">
            </a>
        </td>
        <td align="center">
                <form method="POST" action="editUser.php">
                    <input type="submit" name="update" value="Update">
                    <input type="hidden" value=<?PHP echo $user['id_user']; ?> name="id_user">
                </form>
            </td>
    </tr>
<?php endforeach; ?>
</tbody>
                        </table>
                    </div>
                </div>
            </div>

 <!-- Widgets Start -->
 <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Calender</h6>
                                <a href="">Show All</a>
                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-4">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">To Do List</h6>
                                <a href="">Show All</a>
                            </div>
                            <div class="d-flex mb-2">
                                <input class="form-control bg-transparent" type="text" placeholder="Enter task">
                                <button type="button" class="btn btn-primary ms-2">Add</button>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox" checked>
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span><del>Short task goes here...</del></span>
                                        <button class="btn btn-sm text-primary"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-2">
                                <input class="form-check-input m-0" type="checkbox">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 align-items-center justify-content-between">
                                        <span>Short task goes here...</span>
                                        <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Widgets End -->


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

<script>
function confirmDelete(id_user) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
        window.location.href = "?action=supp&id_user=" + id_user;
    }
}
</script>




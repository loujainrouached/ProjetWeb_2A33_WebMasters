<?php
require_once('lib/tcpdf/tcpdf.php');

include "../Controller/EmployeC.php";
session_start();
$user1 = new UserC();
if (isset($_POST['searchEmail'])) {
    // Si une recherche par e-mail est effectuée, récupérez l'e-mail saisi et affichez l'utilisateur correspondant
    $email = $_POST['searchEmail'];
    $tab = $user1->afficherParEmail($email);
}else {
        $tab = $user1->listeEmploye();
    }
    /*
    if (isset($_POST['searchEmail'])) {
    // Si une recherche par e-mail est effectuée, récupérez l'e-mail saisi et affichez l'utilisateur correspondant
    $email = $_POST['searchEmail'];
    $tab = $user1->afficherParEmail($email);
}else {
        // Si aucune recherche par e-mail ni sélection de nature n'est effectuée, affichez tous les utilisateurs
        $tab = $user1->listeEmploye();
    }*/
   
if (isset($_GET['action']) && $_GET['action'] == 'supp' && isset($_GET['id_user'])) {
    $user1->deleteuser($_GET['id_user']);
    header("Location: " . strtok($_SERVER["PHP_SELF"], '?'));
    exit;
}
// Vérifiez si la nature a été sélectionnée dans le formulaire
if (isset($_POST['nature']) && !empty($_POST['nature'])) {
    // Récupérez la valeur de la nature sélectionnée
    $nature = $_POST['nature'];
    if ($nature === 'Admin') {
        $tab = $user1->afficherParAdmin(); // Assurez-vous que votre méthode dans UserC retourne la liste des administrateurs
    } 
    else if ($nature === 'Client') {
        $tab = $user1->afficherParClient(); // Assurez-vous que votre méthode dans UserC retourne la liste des administrateurs
    } 

} else {
    // Requête SQL pour récupérer tous les utilisateurs si aucune nature n'a été sélectionnée
    $tab = $user1->listeEmploye();
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
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                <a href="ListEmployes.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Voyage</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item">liste voyage</a>
                            <a href="typography.html" class="dropdown-item">liste reservation</a>
                     
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
                                        <a href="button.html" class="dropdown-item">liste reclamation</a>
                                        <a href="typography.html" class="dropdown-item">liste reponse</a>
                                 
                                    </div>
                </div>
            </nav>
        </div>
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
                  
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="d-flex">
    <div class="me-2">
        <input type="text" class="form-control" id="searchEmail" name="searchEmail" placeholder="taper un e-mail">
    </div>
    <button type="submit" class="btn btn-warning">Rechercher</button>
    <select class="form-select me-2" name="nature">
        <option value="Admin">Admin</option>

        
        <option value="Client">Client</option>
    </select>
    <button type="submit" class="btn btn-primary">Filtrer</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchEmail');

    searchInput.addEventListener('keyup', function() {
        // Récupérer la valeur saisie par l'utilisateur
        const searchTerm = searchInput.value.trim();

        // Envoyer une requête AJAX uniquement si le terme de recherche n'est pas vide
        if (searchTerm !== '') {
            // Créer une nouvelle requête AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'search.php?searchLetter=' + searchTerm, true);
            // Définir ce qui se passe lorsque la réponse est reçue
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Mettre à jour le contenu avec les résultats de la recherche
                    // Par exemple, vous pouvez mettre à jour un élément de liste, un tableau, etc.
                    // Voici un exemple pour mettre à jour une liste <ul> avec les résultats
                    const resultsList = document.getElementById('searchResults');
                    resultsList.innerHTML = xhr.responseText;
                }
            };

            // Envoyer la requête
            xhr.send();
        } else {
            // Effacer les résultats si le champ de recherche est vide
            const resultsList = document.getElementById('searchResults');
            resultsList.innerHTML = '';
        }
    });
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
                <img src="TRASH.PNG" alt="Supprimer" class="icon">
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
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Messages</h6>
                                <a href="">Show All</a>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center pt-3">
                                <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div>
                            </div>
                        </div>
                    </div>
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

<script>
function confirmDelete(id_user) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
        window.location.href = "?action=supp&id_user=" + id_user;
    }
}
</script>




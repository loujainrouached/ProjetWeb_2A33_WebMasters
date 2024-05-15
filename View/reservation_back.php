<?php
include "../Controller/ReservationC.php";
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


$reservation = new ReservationC();
$tab = $reservation->listeReservation();

$reservationData = $reservation->getMonthlyReservationData();

// Obtenez les labels et les données de réservation
$labels = $reservationData['labels'];
$data = $reservationData['data'];



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

            <!-- Button Start -->





   <br>
   <br>
 

    <table class="table table-hover text-center">
      <thead class="table-light">
        <tr>
          <th scope="col">ID</th>
          <th scope="col"> Id_voyage</th>
          <th scope="col"> Date</th>
          <th scope="col">Nombre de personne</th>
          <th scope="col">Numero tel</th>
          
        </tr>
      </thead>
      <tbody>
      <?php
    foreach ($tab as $Reservation){
    ?>
       <tr>
         <td><?php echo $Reservation["id"] ?></td>
         <td><?php echo $Reservation["id_voyage"] ?></td>
         <td><?php echo $Reservation["date_reservation"] ?></td>
         <td><?php echo $Reservation["nombre_personnes"] ?></td>
         <td><?php echo $Reservation["numero_personne"] ?></td>
         
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

   
              
                     
             
             
  
 
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js1/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>





            <!-- Button End -->


            <!-- Footer Start -->
         
       
        
            <!-- Footer End -->
     
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Template Javascript -->
    <script src="js1/main.js"></script>

    <div class="container">
    <div class="row">
        <div class="col-md-6">

        <div style="width: 100%">
                  <canvas id="myChart"></canvas>
              </div>
              
        </div>

        <div class="col-md-6">
    <div class="main-section">
         <div class="add-section">
            <form action="app/add.php" method="POST" autocomplete="off">
               <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                  <input type="text" 
                       name="title" 
                       style="border-color: #F97300"
                       placeholder="This field is required" />
                <button type="submit">Add &nbsp; <span>&#43;</span></button>
  
               <?php }else{ ?>
                <input type="text" 
                       name="title" 
                       placeholder="What do you need to do?" />
                <button type="submit">Add &nbsp; <span>&#43;</span></button>
               <?php } ?>
            </form>
         </div>
         <?php 
            // Utilisation de la classe config pour obtenir la connexion
            $conn = config::getConnexion();
  
            // Exécution de la requête SQL pour récupérer les tâches
            $stmt = $conn->query("SELECT * FROM todos ORDER BY id DESC");
         ?>
         <div class="show-todo-section">
              <?php if($stmt->rowCount() <= 0){ ?>
                  <div class="todo-item">
                      
                  </div>
              <?php } ?>
  
              <?php while($todo = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                  <div class="todo-item">
                      <span id="<?php echo $todo['id']; ?>"
                            class="remove-to-do">x</span>
                      <?php if($todo['checked']){ ?> 
                          <input type="checkbox"
                                 class="check-box"
                                 data-todo-id ="<?php echo $todo['id']; ?>"
                                 checked />
                          <h2 class="checked"><?php echo $todo['title'] ?></h2>
                      <?php }else { ?>
                          <input type="checkbox"
                                 data-todo-id ="<?php echo $todo['id']; ?>"
                                 class="check-box" />
                          <h2><?php echo $todo['title'] ?></h2>
                      <?php } ?>
                      <br>
                      <small>created: <?php echo $todo['date_time'] ?></small> 
                  </div>
              <?php } ?>
         </div>
      </div>
      
   
  
                <script src="js_todo/jquery-3.2.1.min.js"></script>

      <script>
          $(document).ready(function(){
              $('.remove-to-do').click(function(){
                  const id = $(this).attr('id');
                  
                  $.post("app/remove.php", 
                        {
                            id: id
                        },
                        (data)  => {
                           if(data){
                               $(this).parent().hide(600);
                           }
                        }
                  );
              });
  
              $(".check-box").click(function(e){
                  const id = $(this).attr('data-todo-id');
                  
                  $.post('app/check.php', 
                        {
                            id: id
                        },
                        (data) => {
                            if(data != 'error'){
                                const h2 = $(this).next();
                                if(data === '1'){
                                    h2.removeClass('checked');
                                }else {
                                    h2.addClass('checked');
                                }
                            }
                        }
                  );
              });
          });
      </script>   
    

   
     

  <script>
        // Récupérer les données JSON encodées depuis PHP
        var jsonData = <?php echo json_encode($reservationData); ?>;
        
        // Créer le graphique avec une ligne ou une courbe
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line', // Utiliser 'line' pour une ligne ou une courbe
            data: {
                labels: jsonData.labels,
                datasets: [{
                    label: 'Nombre de réservations par mois',
                    data: jsonData.data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>
            </div>
        </div>
    </div>
</div>
       
</body>

</html>
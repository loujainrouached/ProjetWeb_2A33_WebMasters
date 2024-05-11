<?php
session_start();
include '../Controller/ReservationC.php'; // Inclure le contrôleur de réservation
include '../Model/Reservation.php'; // Inclure le modèle de réservation
include 'qrCode.php';

$reservationC = new ReservationC(); // Créer une instance du contrôleur de réservation

// Vérifier si les données du formulaire sont définies
if (
    isset($_POST['id_voyage']) &&
    isset($_POST['date_reservation']) &&
    isset($_POST['nombre_personnes']) &&
    isset($_POST['numero_personne'])  &&
    isset($_SESSION['id_user'] )// Utilisation de l'ID de session ici
   

) {
    // Créer une nouvelle instance de réservation en récupérant les données du formulaire
    $reservation = new Reservation(
        null,
        $_POST['id_voyage'],
        $_POST['date_reservation'],
        $_POST['nombre_personnes'],
        $_POST['numero_personne'],
        $_SESSION['id_user'] // Utilisation de l'ID de session ici
    );

    // Ajouter la réservation
  
    // Appel de la fonction ajouterReservation en passant l'ID de l'utilisateur actuel
$reservationC->ajouterReservation($reservation, $_SESSION['id_user']);
}
$db = config::getConnexion();

$sql = "SELECT id AS id_voyage, destination FROM voyage";
$query = $db->prepare($sql);
$query->execute();
$voyages = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Travela - Tourism Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
   
        <link rel="stylesheet" href="./build/app.css">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">



        <style>
        /* Style pour la liste déroulante */
        .form-select {
            background-color: #343a40; /* Couleur de fond */
            color: #fff; /* Couleur du texte */
        }

        /* Style pour l'élément de sélection de langue de Google Translate */
        .translate {
            background-color: #343a40; /* Couleur de fond */
            color: #fff; /* Couleur du texte */
        }
    </style>
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

       
        
  <!-- Topbar Start -->
  <div class="container-fluid bg-primary px-5 d-none d-lg-block">
            <div class="row gx-0">
                <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-twitter fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-linkedin-in fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i class="fab fa-youtube fw-normal"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <a href="#"><small class="me-3 text-light"><i class="fa fa-user me-2"></i>Register</small></a>
                        <a href="#"><small class="me-3 text-light"><i class="fa fa-sign-in-alt me-2"></i>Login</small></a>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown"><small><i class="fa fa-home me-2"></i> My Dashboard</small></a>
                            <div class="dropdown-menu rounded">
                            <a href="profil.php" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> My Profile</a>
                                <a href="user.php" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i>Mes Reservations</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i> Notifications</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-cog me-2"></i> Account Settings</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

       
       <!-- Navbar & Hero Start -->
       <div class="container-fluid position-relative p-0">
                <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                    <a href="Reservation.php" class="navbar-brand p-0">
                        <h1 class="m-0"><img src="tayara.png" alt="VieXplore Logo" class="me-3">VieXplore</h1>
                    
    
                     
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav ms-auto py-0">
                            <a href="index.html" class="nav-item nav-link">Home</a>
                            <a href="destination.php" class="nav-item nav-link">Destination</a>
                            <a href="services.html" class="nav-item nav-link">Reclamation</a>
                            <a href="blog.html" class="nav-item nav-link">Blog</a>
                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                        </div>
                        <a href="Reservation.php" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Book Now</a>
                    </div>
                </nav>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Online Booking</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item active text-white">Online Booking</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->

        <!-- Tour Booking Start -->
        <div class="container-fluid booking py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <h5 class="section-booking-title pe-3">Booking</h5>
                        <h1 class="text-white mb-4">Online Booking</h1>
                        <p class="text-white mb-4">Vous êtes prêt à vivre une expérience inoubliable ? Ne cherchez pas plus loin ! Réservez dès maintenant votre prochain voyage avec VieXplore.
                        </p> 

                       
                        <?php if(isset($filename)): ?>
    <div class="flex justify-center" id="qrCodeContainer">
        <img id="qrCodeImage" src="<?= $filename; ?>" alt="Qrcode"  loading="lazy" class="w-60">
    </div>
    
    <!-- Placer le lien en dessous du code QR -->
    <div class="flex justify-center">
    <a id="downloadLink" href="<?= $filename; ?>" class="m-5 text-xl font-semibold text-center hover:text-purple-600 text-white" download> Télécharger votre qr code </a>
</div>

<?php endif ?>


<script>
    // Détecter le clic sur le lien de téléchargement
    document.getElementById('downloadLink').addEventListener('click', function() {
        // Masquer l'image du QR code
        document.getElementById('qrCodeContainer').style.display = 'none';
    });
</script>

            <?php if (isset($errors))  echo $errors; ?> 
                               
                    </div>
                    <div class="col-lg-6">
                        <h1 class="text-white mb-3">Book A Tour Deals</h1>
                        <form action="" method="post" id=form >
                            <div class="row g-3">
                            <div class="col-md-6">
    <div class="form-floating date" id="date3" data-target-input="nearest">
        <select id="destination" name="id_voyage" class="form-control bg-white border-0" oninput="change(this)">
            <option value="" disabled selected></option>
            <?php foreach ($voyages as $voyage) : ?>
                <option value="<?php echo $voyage['id_voyage']; ?>"><?php echo $voyage['destination']; ?></option>
                 <!-- La valeur de l'option est l'ID du voyage, le texte est la destination -->
            <?php endforeach; ?>
        </select>
        
        <label for="id_voyage">Choisissez votre destination:</label>
        <div>
        <label id="destinationerror" style="color: orange;"></label>
   <label id="destinationcorrect" style="color: white;"></label>
            </div>

    </div>

    
</div>



        <input type="hidden" id="date_reservation" name="date_reservation" value="<?php echo date('Y-m-d'); ?>">
                               
            <div class="col-md-6">
                                
            <div class="form-floating date" id="date3" data-target-input="nearest">
                                
                                    
             <input type="number" class="form-control bg-white border-0" oninput="change(this)" id="nombre_personnes"  name="nombre_personnes" placeholder="nombre_personnes" />
              <label for="nombre_personnes">Nombre de Personnes:</label>
                    <div>
    <label id="nombre_personneserror" style="color: orange;"></label>
   <label id="nombre_personnescorrect" style="color: white;"></label>
            </div>
            
                                    </div>
        </div>
                                <center>
  <div class="col-md-6">
 <div class="form-floating date" id="date3" data-target-input="nearest">
<input type="text" class="form-control bg-white border-0" id="numero_personne"  oninput="change(this)" name="numero_personne" placeholder="numero_personne" />

<label for="numero_personne">Numero de Personnes:</label>

                                   <div>
<label id="numero_personneerror" style="color: orange;"></label>
   <label id="numero_personnecorrect" style="color: white;"></label>
            </div>
                                        
                                        <br>
            
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary text-white w-100 py-3" type="submit">Reserver</button>
                                </div>
                            </div>
                            
          
        
                        </form>
                       

                    </div>
                </div>
            </div>
        </div>
        <!-- Tour Booking End -->

       
        <!-- Footer Start -->
        <div class="container-fluid footer py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Get In Touch</h4>
                            <a href=""><i class="fas fa-home me-2"></i> 123 Street, New York, USA</a>
                            <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                            <a href=""><i class="fas fa-phone me-2"></i> +012 345 67890</a>
                            <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +012 345 67890</a>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-share fa-2x text-white me-2"></i>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Company</h4>
                            <a href=""><i class="fas fa-angle-right me-2"></i> About</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Careers</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Blog</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Press</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Gift Cards</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Magazine</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Support</h4>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Contact</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Legal Notice</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Terms and Conditions</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Sitemap</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Cookie policy</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item">
                            <div class="row gy-3 gx-2 mb-4">
                                <div class="col-xl-6">
                                <form>
        <div class="form-floating">
            <div class="form-select bg-dark border translate" id="google_translate_element"></div>

            <script type="text/javascript">
                function googleTranslateElementInit() {  
                    new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                }
            </script>
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        </div>
    </form>

                                <!-- Translation Code here -->
					
					<!-- Translation Code End here -->
                                <div class="col-xl-6">
                                   
                                </div>
                            </div>
                            
                            <div class="footer-bank-card">
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-amex fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-visa fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fas fa-credit-card fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-mastercard fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-paypal fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-cc-discover fa-2x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- Copyright Start -->
        <div class="container-fluid copyright text-body py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-end mb-md-0">
                        <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All right reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-start">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
        <script src="qrious.js"></script>
<script src="script.js"></script>





<script>
    document.getElementById("form").addEventListener("submit", function(e) {
    var hasError = false; // Variable pour suivre si une validation a échoué


   

    var nombre_personnes = document.getElementById("nombre_personnes").value;
    var nombre_personneserror = document.getElementById("nombre_personneserror");
    var nombre_personnescorrect = document.getElementById("nombre_personnescorrect");

    nombre_personnescorrect.textContent = '';
    nombre_personneserror.textContent = '';

    if (nombre_personnes > 10) {
        nombre_personneserror.textContent = " Le nombre maximum de personnes est de 10.";
        hasError = true; // Définir hasError à true si la validation échoue
    } else {
        nombre_personnescorrect.textContent = "Correct.";
    }




    var numero_personne = document.getElementById("numero_personne").value;
    var numero_personneerror = document.getElementById("numero_personneerror");
    var numero_personnecorrect = document.getElementById("numero_personnecorrect");

    numero_personnecorrect.textContent = '';
    numero_personneerror.textContent = '';

    if (numero_personne === "") {
        numero_personneerror.textContent = "La numero ne doit pas être vide.";
        hasError = true; // Définir hasError à true si la validation échoue
    } else {
        numero_personnecorrect.textContent = "Correct.";
    }

    var destination = document.getElementById("destination").value;
    var destinationerror = document.getElementById("destinationerror");
    var destinationcorrect = document.getElementById("destinationcorrect");

    destinationcorrect.textContent = '';
    destinationerror.textContent = '';

    if (destination === "") {
        destinationerror.textContent = "La destination ne doit pas être vide.";
        hasError = true; // Définir hasError à true si la validation échoue
    } else {
        destinationcorrect.textContent = "Correct.";
    }

    

    // Empêcher la soumission du formulaire si une validation a échoué
    if (hasError) {
        e.preventDefault();
    }
});
  </script>









    </body>

</html>
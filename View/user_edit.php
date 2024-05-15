<?php
include "../Controller/ReservationC.php";
$id = $_GET["id"];
$reservation = new ReservationC();
$tab = $reservation->listeReservation();




if (isset($_POST["submit"])) {
    // Récupérer les valeurs du formulaire
    $id_voyage = $_POST['id_voyage'];
  
    $nombre_personnes = $_POST['nombre_personnes'];
    $numero_personne = $_POST['numero_personne']; // <-- Add a semicolon here

    // Mettre à jour le voyage avec la nouvelles image si une a été téléchargée
    $reservationC = new ReservationC();
    $result = $reservationC->updateReservation($id, $id_voyage,$nombre_personnes, $numero_personne);
    
    if ($result) {
        header("Location: user.php?msg=Données mises à jour avec succès");
        exit;
    } else {
        echo "Échec de la mise à jour des données.";
    }   
}


$db = config::getConnexion();
    // Prépare la requête SQL avec un paramètre de placeholder (:id)
    $sql = "SELECT * FROM Reservation WHERE id = :id ";
    $query = $db->prepare($sql);
    
    // Lie le paramètre :id à la valeur de $id
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    
    // Exécute la requête préparée
    $query->execute();
    
    // Récupère le résultat de la requête
    $row = $query->fetch(PDO::FETCH_ASSOC);


    $sql = "SELECT id AS id_voyage, destination FROM voyage";
$query = $db->prepare($sql);
$query->execute();
$voyages = $query->fetchAll(PDO::FETCH_ASSOC);










?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Votre profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    

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

<style type="text/css">
    	body{margin-top:20px;}
.card-style1 {
    box-shadow: 0px 0px 50px 0px rgb(89 75 128 / 9%);
}
.border-0 {
    border: 0!important;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.25rem;
}

section {
    padding: 120px 0;
    overflow: hidden;
    background: #fff;
}
.mb-2-3, .my-2-3 {
    margin-bottom: 2.3rem;
}

.section-title {
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 10px;
    position: relative;
    display: inline-block;
}
.text-primary {
    color: #ceaa4d !important;
}
.text-secondary {
    color: #15395A !important;
}
.font-weight-600 {
    font-weight: 600;
}
.display-26 {
    font-size: 1.3rem;
}


    .btn-dark-blue {
        background-color:  #274472; /* Couleur bleu foncé */
        border-color: #274472; /* Couleur de la bordure */
    }

    .btn-dark-blue:hover {
        background-color: #0000CD; /* Couleur bleu foncé au survol */
        border-color: #0000CD; /* Couleur de la bordure au survol */
    }

@media screen and (min-width: 992px){
    .p-lg-7 {
        padding: 4rem;
    }
}
@media screen and (min-width: 768px){
    .p-md-6 {
        padding: 3.5rem;
    }
}
@media screen and (min-width: 576px){
    .p-sm-2-3 {
        padding: 2.3rem;
    }
}
.p-1-9 {
    padding: 1.9rem;
}

.bg-secondary {
    background: #15395A !important;
}
@media screen and (min-width: 576px){
    .pe-sm-6, .px-sm-6 {
        padding-right: 3.5rem;
    }
}
@media screen and (min-width: 576px){
    .ps-sm-6, .px-sm-6 {
        padding-left: 3.5rem;
    }
}
.pe-1-9, .px-1-9 {
    padding-right: 1.9rem;
}
.ps-1-9, .px-1-9 {
    padding-left: 1.9rem;
}
.pb-1-9, .py-1-9 {
    padding-bottom: 1.9rem;
}
.pt-1-9, .py-1-9 {
    padding-top: 1.9rem;
}
.mb-1-9, .my-1-9 {
    margin-bottom: 1.9rem;
}
@media (min-width: 992px){
    .d-lg-inline-block {
        display: inline-block!important;
    }
}
.rounded {
    border-radius: 0.25rem!important;
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

             
   <!-- Topbar Start  -->
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
                    <a href="vexo.html"><small class="me-3 text-light"><i class="fa fa-user me-2"></i>Vexo Chat bot</small></a>
                        
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown"><small><i class="fa fa-home me-2"></i> Parametres</small></a>
                            <div class="dropdown-menu rounded">
                                <a href="profil.php" class="dropdown-item"><i class="fas fa-user-alt me-2"></i>votre Profile</a>
                                <a href="user.php" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> vos Reservations</a>
                                <a href="listereclamation.php" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Reclamations</a>
                                
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
                <a href="index.html" class="navbar-brand p-0">
                        <h1 class="m-0"><img src="tayara.png" alt="VieXplore Logo" class="me-3">VieXplore</h1>
                    
    
                     
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav ms-auto py-0">
                            <a href="index.html" class="nav-item nav-link">Home</a>
                            <a href="destination.php" class="nav-item nav-link">Destination</a>
                            <a href="guides.php" class="nav-item nav-link">Guides</a>
                            <a href="blog.php" class="nav-item nav-link">Blog</a>
                            <a href="contact.php" class="nav-item nav-link">Reclamation</a>
                        </div>
                        <a href="Reservation.php" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Reserver Maintenant</a>
                    </div>
                </nav>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Vos Reservations</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                  
                </ol>    
            </div>
        </div>
        <!-- Header End -->
        <form action="" method="post" id=form>
<section class="bg-light">


<div class="container">
<div class="row">
<div class="col-lg-12 mb-4 mb-sm-5">
<div class="card card-style1 border-0">
<div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
<div class="row align-items-center">

<div class="col-lg-6 px-xl-10">
<div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
<h5 class="h2 text-white mb-0">Your Reservation</h3>

</div>

<ul class="list-unstyled mb-1-9">
<li class="mb-2 mb-xl-3 display-28">
  
</li>
<select id="destination" name="id_voyage" class="form-control text-white border-15" oninput="change(this)" style="width: 300px; background-color: #2c3e50; color: white;">
    <option value="" disabled selected style="color: #41729F;">Choisissez une destination</option>
    <?php foreach ($voyages as $voyage) : ?>
        <option value="<?php echo $voyage['id_voyage']; ?>" style="background-color: #2c3e50; color: white;"><?php echo $voyage['destination']; ?></option>
    <?php endforeach; ?>
</select>
<div>
        <label id="destinationerror" style="color: orange;"></label>
   <label id="destinationcorrect" style="color: #274472;"></label>
            </div>
<br>

<li  class="mb-2 mb-xl-3 display-28" ><span class="display-26 text-secondary me-2 font-weight-600" >Date de creation:</span> <?php echo $row["date_reservation"] ?> </li>

<li class="mb-2 mb-xl-3 display-28">


    <span class="display-26 text-secondary me-2 font-weight-600">Nombre de personne:</span>
    
</li>

     <input type="number" class="form-control" style="width: 300px;" name="nombre_personnes" id="nombre_personnes" value="<?php echo $row['nombre_personnes'] ?>">

     <div>
    <label id="nombre_personneserror" style="color: orange;"></label>
   <label id="nombre_personnescorrect" style="color: #274472;"></label>
     </div>
            
<li class="display-28">
    <span class="display-26 text-secondary me-2 font-weight-600">Phone:</span>
</li>
<input type="number" class="form-control" style="width: 300px;" name="numero_personne" id="numero_personne"value="<?php echo $row['numero_personne'] ?>">
<div>
<label id="numero_personneerror" style="color: orange;"></label>
   <label id="numero_personnecorrect" style="color: #274472;"></label>
            </div>
        <br>
       
</ul>

<button type="submit" class="btn btn-primary btn-dark-blue" name="submit">Update</button>
<a href="user.php" class="btn btn-primary btn-dark-blue">Cancel</a>


<script>
    // Détecter le clic sur le lien de téléchargement
    document.getElementById('downloadLink').addEventListener('click', function() {
        // Masquer l'image du QR code
        document.getElementById('qrCodeContainer').style.display = 'none';
    });
</script>

            <?php if (isset($errors))  echo $errors; ?> 

    </form>

</div>
</div>
</div>
</div>
</div>
    </section>
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

                                </div>
                                <div class="col-xl-6">
                                    <form>
                                        <div class="form-floating">
                                            <select class="form-select bg-dark border" id="select1">
                                                <option value="1">USD</option>
                                                <option value="2">EUR</option>
                                                <option value="3">INR</option>
                                                <option value="3">GBP</option>
                                            </select>
                                            <label for="select1">$</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <h4 class="text-white mb-3">Payments</h4>
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

        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	
</script>

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
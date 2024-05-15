<?php

session_start();

//include_once (__DIR__."/../../Controller/ReclamationsC.php");

//require_once __DIR__."/..//";
include "../Controller/ReclamationsC.php";



$c = new ReclamationsC();
$tab = $c->listReclamations();
//include_once (__DIR__."/../Controller/");
include "../Controller/ReponsesC.php";
$reponseC = new ReponsesC();
$tab1 = $reponseC->listReponses();



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
    /* Styles généraux */
    body {
        font-family: Arial, sans-serif; /* Police de caractères */
        margin: 0;
        padding: 0;
    }

    /* Conteneur principal */
    .container-fluid.booking {
        padding-top: 5rem; /* Espace en haut */
        padding-bottom: 5rem; /* Espace en bas */
    }

    
    .row.g-5.align-items-center {
        margin-top: 5rem; /* Marge en haut */
        margin-bottom: 5rem; /* Marge en bas */
    }

    /* Styles pour les réclamations */
    .reclamation {
        margin-bottom: 2rem; /* Marge en bas */
        border: 1px solid #ccc; /* Bordure */
        border-radius: 8px; /* Coins arrondis */
        padding: 1rem; /* Espacement interne */
    }

    .reclamation-header {
        background-color: #f9a825; /* Couleur d'arrière-plan */
        padding: 0.5rem 1rem; /* Espacement interne */
        border-radius: 8px 8px 0 0; /* Coins arrondis seulement en haut */
        color: #fff; /* Couleur du texte */
        margin-bottom: 0.5rem; /* Marge en bas */
    }

    .reclamation-content {
        background-color: #fff; /* Couleur d'arrière-plan */
        padding: 1rem; /* Espacement interne */
        border-radius: 0 0 8px 8px; /* Coins arrondis seulement en bas */
        border: 1px solid #ccc; /* Bordure */
    }

    .tablereponses {
        margin-top: 1rem; /* Marge en haut */
    }

    .comment-list {
        list-style: none; /* Suppression de la liste */
        padding: 0; /* Réinitialisation de la marge */
    }

    .comment {
        border-bottom: 1px solid #ccc; /* Bordure inférieure */
        padding: 1rem 0; /* Espacement interne */
    }

    .comment-avatar {
        margin-right: 1rem; /* Marge à droite */
    }

    .comment-text {
        margin-top: 0.5rem; /* Marge en haut */
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
                        <a href="vexo.html"><small class="me-3 text-light"><i class="fa fa-user me-2"></i>Vexo Chat bot</small></a>
                        
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown"><small><i class="fa fa-home me-2"></i> My Dashboard</small></a>
                            <div class="dropdown-menu rounded">
                            <a href="profil.php" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> My Profile</a>
                                <a href="user.php" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i>Mes Reservations</a>
                                <a href="listereclamation.php" class="dropdown-item"><i class="fas fa-bell me-2"></i> Mes Reclamation</a>
                                
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
                            <a href="guides.php" class="nav-item nav-link">Guide</a>
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
                <h3 class="text-white display-3 mb-4">Vos Reclamations</h1>
                   
            </div>
        </div>
        <!-- Header End -->

        <!-- Tour Booking Start -->
        
                       




          
        
                       
                       

  <!-- Contact End  -->
    <!-- Tour Booking Start -->
    <div class="container-fluid booking py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                       

                       
                    <div class="container">
         <div class="tablereclamations">

    <?php
    if (is_array($tab) || is_object($tab)){
    foreach ($tab as $Reclamations) {
        if (isset($_SESSION["id_user"]) and $Reclamations["id_user"] == $_SESSION["id_user"]) {
        // if ($Reclamations["id_client"] == 45) {
    ?>
    <div class="reclamation">
                    <div class="reclamation-header">
                    <a 
                         class="btn btn-outline-success m-2" href="updateReclamations.php?id_reclamation=<?= $Reclamations['id_reclamation']; ?>" onclick="return confirm('Are you sure you want to update this ?')">Update
                        </a>
                         <a 
                         class="btn btn-outline-success m-2" href="deleteReclamations.php?id_reclamation=<?= $Reclamations['id_reclamation']; ?>" onclick="return confirm('Are you sure you want to delete this ?')">Delete</a>
                         <th></th>
                        <h3><?= $Reclamations['titre_reclamation']; ?></h3>
                        <h6><?= $Reclamations['date_reclamation']; ?></h6>
                        <h6>votre id <?= $Reclamations['id_user']; ?></h6>
                        
                    </div>
                    <div class="reclamation-content bubble">
                        <h5> Votre réclamation:</h5>        
                         <?= $Reclamations['contenu']; ?>

                        <!-- Disqus Comments Container -->
                        <div id="disqus_thread_<?= $Reclamations['id_reclamation']; ?>"></div>
                        <script>
                            var disqus_config = function () {
                                this.page.url = '<?= $_SERVER['REQUEST_URI']; ?>'; // Replace with your page URL
                                this.page.identifier = 'reclamation_<?= $tab['id_reclamation']; ?>'; // Replace with your reclamation identifier, e.g., reclamation ID or slug
                            };
                            (function () {
                                var d = document,
                                    s = d.createElement('script');
                                s.src = 'https://your-disqus-shortname.disqus.com/embed.js'; // Replace "your-disqus-shortname" with your Disqus shortname
                                s.setAttribute('data-timestamp', +new Date());
                                (d.head || d.body).appendChild(s);
                            })();
                        </script>
                        <noscript>
                            Please enable JavaScript to view the
                            <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a>
                        </noscript>
                        <!-- End Disqus Comments Container -->


                        <!-- Comments for the reclamation -->
                        <div class="tablereponses">
                            <h4>Réponses:</h4>
                            <ul class="comment-list">
                                <?php
                                if ($tab1 !== null){
                                foreach ($tab1 as $reponse) {
                                    if ($reponse['id_reclamation'] == $Reclamations['id_reclamation']) {
                                        
                                ?>
                                        <li class="comment">
                                            <div class="comment-avatar">
                                                <!-- Add code to display user avatar if available -->
                                            </div>
                                            <div class="comment-content">
                                                <div class="comment-author">
                                                    <!-- Add code to display user name if available -->
                                                </div>
                                                <div class="comment-text"><?=$reponse['date_reponse']; ?></div>
                                                <div class="comment-text"><?= $reponse['rep']; ?></div>
                                               
                                            </div>
                                            
                                        </li>
                                <?php
                                    }
                                }}
                                ?>
                            </ul>
                        </div>

                    </div>
                </div>
            <?php
            }}}
            ?>
        </div>
    </div>
   





            



          
        
                       
                       

                    </div>
                </div>
            </div>
        </div>
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















    </body>

</html>
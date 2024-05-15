<?php
session_start();

include "../Controller/commentaireC.php";
include "../Model/commentaireM.php";


$error = "";

// create client
$commentaire = null;

// create an instance of the controller
$commentaireC = new commentaireC();

if (
    isset($_SESSION['id_user'] ) &&// Utilisation de l'ID de session ici

    isset($_POST["contenu_commentaire"]) &&
    isset($_POST["date_de_publication_"])
) {
    if (
        !empty($_SESSION['id_user'] ) &&// Utilisation de l'ID de session ici
        !empty($_POST["contenu_commentaire"]) &&
        !empty($_POST["date_de_publication_"])
       
    ) {
        $commentaire = new commentaire(
            NULL,
            $_GET['id_article'],
            $_SESSION['id_user'], // Utilisation de l'ID de session ici
            $_POST['contenu_commentaire'],
            $_POST['date_de_publication_']
           
        );

            $commentaireC->add_commentaire($commentaire, $_SESSION['id_user']);
            // Redirect to the listcommentaire.php page
            header('Location: blog.php ');
            exit();
    } else {
        $error = "Missing information";
    }
    
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>bessem - VieExplore</title>
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


<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
         <!-- Spinner End  -->

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
                <h3 class="text-white display-3 mb-4">Ajouter un commentaire</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                   
                </ol>    
            </div>
        </div>
    <div class="container-xxl position-relative bg-white d-flex p-0">


        <!-- Content Start -->
   


        
            <!-- Recent Sales Start -->
           
            <!-- Recent Sales End -->
         
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Ajouter un commentaire</h5>
                    
                </div>
            <div class="col-lg-8">
                      
                        <p class="mb-4">Veuillez exprimer vos avis librements.</p>
                        <form action="" method="POST">
                            <div class="row g-3">
                              
                            <div class="col-12">
                                    <div class="form-floating">
                                    <textarea type="text" class="form-control border-2" id="contenu_commentaire" name="contenu_commentaire" ></textarea>
                                    <span id="erreur_contenu_commentaire" style="color: red"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                  
                                  
                                    <input type="date" id="date_de_publication_" class="form-control border-2" name="date_de_publication_" />
                                    <span id="erreur_date_de_publication_" style="color: red"></span>
                                    </div>
                                </div>
                                
                                </div>
                                <div class="col-12">
                                <div class="form-floating">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                                </div>
                                
                            </div>
                        </form>

                        
                    </div>

            <!-- Footer End -->
        </div>
</div>
        <!-- Content End -->
</div>

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

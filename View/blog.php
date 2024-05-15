<?php
include "../Controller/articleC.php";
include "../Model/articleM.php";
$articleC = new articleC();
$tab = $articleC->liste_article();

include "../Controller/commentaireC.php";
include "../Model/commentaireM.php";



$commentaireC = new commentaireC();
$tab1 = $commentaireC->liste_commentaire();

?>



<!-- template add jdida -->
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>VieXplore</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

         <!-- Google Web Fonts  -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

         <!-- Icon Font Stylesheet  -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

         <!-- Libraries Stylesheet  -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">


         <!-- Customized Bootstrap Stylesheet  -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

         <!-- Template Stylesheet  -->
        <link href="css/style.css" rel="stylesheet">
    </head>
    <style>
    /* Style pour encadrer le contenu dans un cadre orange */
.article {
    border: 2px solid orange;
    padding: 20px;
    margin-bottom: 20px;
}

.article-header {
    margin-bottom: 10px;
}

.article-header h3 {
    color: #333; /* Couleur de texte pour le titre de l'article */
}

.article-header span {
    color: #888; /* Couleur de texte pour la date de publication */
}

.article-content {
    position: relative; /* Position relative pour contenir les éléments enfants */
}

/* Style pour les boutons */
.lire-article {
    background-color: orange;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    margin-top: 10px;
    display: inline-block;
}

.lire-article:hover {
    background-color: #ff7f00; /* Couleur de survol du bouton */
}
</style>
    <body>
        

     <div id="error"> 
    </div> 

         <!-- Spinner Start  -->
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
                            <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown"><small><i class="fa fa-home me-2"></i> </small></a>
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
                            <a href="contact.php" class="nav-item nav-link">Contact</a>
                        </div>
                        <a href="Reservation.php" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Reserver Maintenant</a>
                    </div>
                </nav>
        </div>
        <!-- Navbar & Hero End -->
         <!-- Navbar & Hero End  -->

         <!-- Header Start  -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Blog</h1>
                
            </div>
        </div>
         <!-- Header End  -->

        
                    <!-- Wrapper container -->
    <div class="container">
        <!--Liste des articles-->
        <div class="tableArticles">
            <?php
            foreach ($tab as $article) {
            ?>
                <div class="article">
                    <div class="article-header">
                        <h3><?= $article['titre_article']; ?></h3>
                        <span><?= $article['date_de_publication']; ?></span>
                    </div>
                    <div class="article-content bubble">
                        <?= $article['contenu_article']; ?>

                        <!-- Disqus Comments Container -->
                        <div id="disqus_thread_<?= $article['id_article']; ?>"></div>
                        <script>
                            var disqus_config = function () {
                                this.page.url = '<?= $_SERVER['REQUEST_URI']; ?>'; // Replace with your page URL
                                this.page.identifier = 'article_<?= $article['id_article']; ?>'; // Replace with your article identifier, e.g., article ID or slug
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

                        <a href="addcommentaire.php?id_article=<?= $article['id_article']; ?>" class="btn lire-article">commentaire</a>


<!-- Comments for the article -->
<div class="tablecommentaires">
    <h4>Comments</h4>
    <ul class="comment-list">
        <?php
        // Assuming $tab1 contains the comments, $article contains the current article, and $censoredWords is an array of words to censor
        require_once 'censorship.php'; // Include the censorship function
        // Define the array of censored words
        $censoredWords = ['rude', 'sabee', 'bessem','loody'];
        foreach ($tab1 as $commentaire) {
            if ($commentaire['id_article'] == $article['id_article']) {
                // Censor the comment before displaying it
                $censoredComment = censorComment($commentaire['contenu_commentaire'], $censoredWords);
        ?>
                <li class="comment">
                    <div class="comment-bubble">
                        <div class="comment-avatar">
                            <!-- Add code to display user avatar if available -->
                        </div>
                        <div class="comment-content">
                            <div class="comment-author">
                                <!-- Add code to display user name if available -->
                            </div>
                            <div class="comment-text"><?= $censoredComment; ?></div> <!-- Display the censored comment -->
                            <div class="comment-actions">
                                <a class="btn btn-outline-dark btn-sm m-1" href="updatecommentaire.php?ID_commentaire=<?= $commentaire['ID_commentaire']; ?>" >update</a>
                                <a class="btn btn-outline-dark btn-sm m-1" href="deletecommentaire.php?ID_commentaire=<?= $commentaire['ID_commentaire']; ?>"  >Delete</a>
                            </div>
                        </div>
                    </div>
                </li>
        <?php
            }
        }
        ?>
    </ul>
</div>


                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>



         <!-- Subscribe Start  -->
        <div class="container-fluid subscribe py-5">
            <div class="container text-center py-5">
                <div class="mx-auto text-center" style="max-width: 900px;">
                    <h5 class="subscribe-title px-3">Subscribe</h5>
                    <h1 class="text-white mb-4">Our Newsletter</h1>
                    <p class="text-white mb-5">Explore the world with us  </p>
                    <div class="position-relative mx-auto">
                        <input class="form-control border-primary rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 px-4 mt-2 me-2">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
         <!-- Subscribe End  -->

         <!-- Footer Start  -->
        <div class="container-fluid footer py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Get In Touch</h4>
                            <a href=""><i class="fas fa-home me-2"></i> Esprit, New York, USA</a>
                            <a href=""><i class="fas fa-phone me-2"></i> +216 50 100 257</a>
                            <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +216 50 100 257</a>
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
                                            <select class="form-select bg-dark border" id="select1">
                                                <option value="1">Arabic</option>
                                                <option value="2">German</option>
                                                <option value="3">Greek</option>
                                                <option value="3">Frensh</option>
                                            </select>
                                            <label for="select1">English</label>
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
         <!-- Footer End  -->
        
         <!-- Copyright Start  -->
        <div class="container-fluid copyright text-body py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-end mb-md-0">
                        <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All right reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-start">
                        <!-- /*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/ -->
                        <!-- /*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/ -->
                        <!-- /*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/ -->
                        <!-- Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a> -->
                    </div>
                </div>
            </div>
        </div>
         <!-- Copyright End  -->

         <!-- Back to Top  -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
         <!-- JavaScript Libraries  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        

         <!-- Template Javascript  -->
        <script src="js/main.js"></script>
    </body>
</html>
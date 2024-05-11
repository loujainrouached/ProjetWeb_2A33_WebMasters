<?php
include_once (__DIR__."/../../Controller/ReclamationsC.php");
// require_once "/../../back/Model/Reclamations.php";
$reclamationsC = new ReclamationsC();
$tab = $reclamationsC->listReclamations();

include_once (__DIR__."//../../Controller/ReponsesC.php");
// require_once "/../../back/model/Reponses.php";
$reponseC = new ReponsesC();
$tab1 = $reponseC->listReponses();

?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>Liste des reclamations</title>
         
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des reclamations</title>
    <style>
   
    body {
        font-family: Arial, sans-serif; /* Update font-family as needed */
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Occupera toute la hauteur de la fenêtre */
    }

    .tablereclamations {
        display: flex;
        flex-wrap: wrap;
        margin-top: 50px; /* Ajout de la marge pour centrer les blocs */
    }

    /* Votre CSS existant */
    .reclamation {
        width: 48%; /* Ajustez la largeur selon vos besoins */
        margin-bottom: 20px;
    }

    .reclamation-header {
        background-color: #f9a825;
        padding: 10px;
        border-radius: 8px 8px 0 0;
        color: #fff;
    }

    .reclamation-content {
        background-color: #fff;
        padding: 10px;
        border-radius: 0 0 8px 8px;
        border: 1px solid #ccc;
    }

    /* Couleurs des bulles */
    .reclamation:nth-child(odd) {
        margin-left: 20px;
    }

    .reclamation:nth-child(odd) .reclamation-content {
        background-color: #ffe0b2;
    }

    .reclamation:nth-child(even) {
        margin-right: 20px;
    }

    .reclamation:nth-child(even) .reclamation-header {
        background-color: #03a9f4;
    }

    .reclamation:nth-child(even) .reclamation-content {
        background-color: #e1f5fe;
    }

    .tablereponses {
        width: 100%; /* Occupe toute la largeur de la ligne */
    }

    .comment-list {
        list-style: none;
        padding: 0;
    }

    .comment {
        border-bottom: 1px solid #ccc;
        padding: 10px 0;
    }

    .comment-avatar {
        margin-right: 10px;
    }

    .comment-text {
        margin-top: 5px;
    }
</style>

</style>

</head>

<body>
    <!-- Contenu de la page -->
    <!-- ... -->
</body>
<meta charset="utf-8">
        <title>VieXplore - Tourism Website </title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

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
                   
                        <a href="#"><small class="me-3 text-light"><i class="fa fa-sign-in-alt me-2"></i>Login</small></a>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown"><small><i class="fa fa-home me-2"></i> My Dashboard</small></a>
                            <div class="dropdown-menu rounded">
                                <a href="#" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> My Profile</a>
                              
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
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0"><img src="tayara.png" alt="VieXplore Logo" class="me-3">VieXplore</h1>
                

                 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="listereponse.php" class="nav-item nav-link">comments</a>
                        <a href="blog.php" class="nav-item nav-link">Blog</a>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Book Now</a>
                </div>
            </nav>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Our Blog</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-white">Blog</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->


        
    <!-- Wrapper container -->
    <div class="container">
        <!--Liste des reclamations-->
        <div class="tablereclamations">
            <?php
            foreach ($tab as $reclamations) {
            ?>
                <div class="reclamation">
                    <div class="reclamation-header">
                    <a 
                         class="btn btn-outline-success m-2" href="updateReclamations.php?id_reclamation=<?= $reponse['id_reclamation']; ?>" onclick="return confirm('Are you sure you want to update this ?')">Update
                        </a>
                         <a 
                         class="btn btn-outline-success m-2" href="deleteReclamations.php?id_reclamation=<?= $reponse['id_reclamation']; ?>" onclick="return confirm('Are you sure you want to delete this ?')">Delete</a>
                         <th></th>
                        <h3><?= $reclamations['titre_reclamation']; ?></h3>
                        
                        <h6><?= $reclamations['date_reclamation']; ?></h6>
                        <h6>votre id <?= $reclamations['id_client']; ?> </h6>
                        
                    </div>
                    <div class="reclamation-content bubble">
                        <h5> Votre réclamation:</h5>        
                         <?= $reclamations['contenu']; ?>

                        <!-- Disqus Comments Container -->
                        <div id="disqus_thread_<?= $reclamations['id_reclamation']; ?>"></div>
                        <script>
                            var disqus_config = function () {
                                this.page.url = '<?= $_SERVER['REQUEST_URI']; ?>'; // Replace with your page URL
                                this.page.identifier = 'reclamation_<?= $reclamations['id_reclamation']; ?>'; // Replace with your reclamation identifier, e.g., reclamation ID or slug
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
                                // Assuming $tab1 contains the comments, $reclamations contains the current reclamation, and $censoredWords is an array of words to censor
                                //require_once 'censor.php'; // Include the censorship function
                                // Define the array of censored words
                                //$censoredWords = ['rude', 'sabee', 'bessem','loody'];
                                foreach ($tab1 as $reponse) {
                                    if ($reponse['id_reclamation'] == $reclamations['id_reclamation']) {
                                        // Censor the comment before displaying it
                                        //$censoredComment = censorComment($reponse['rep'], $censoredWords);
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
    </body>
</html>
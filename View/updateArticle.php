<?php


include "../Controller/articleC.php";
include "../Model/articleM.php";

$error = "";

// create client
$article = null;

// create an instance of the controller
$articleC = new articleC();

if (
    isset($_POST["titre_article"]) &&
    isset($_POST["contenu_article"]) &&
    isset($_POST["date_de_publication"])
) { 
    if (
        !empty($_POST['titre_article']) &&
        !empty($_POST["contenu_article"]) &&
        !empty($_POST["date_de_publication"])
    ) {
        $article = new article(
            $_POST['titre_article'],
            $_POST['contenu_article'],
            $_POST['date_de_publication'],
            NULL
        );

        $articleC->updatearticle($article, $_POST['id_article']);

        // Redirect to the listarticles.php page after the update
        header('Location:listeArticles.php');
        exit(); // Make sure to exit after header to avoid further execution
    } else {
        $error = "Missing information";
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
                <a href="index.php">
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
                    <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Voyage</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="listeArticles.php" class="dropdown-item">liste voyage</a>
                            <a href="addArticle.php" class="dropdown-item">liste reservation</a>
                     
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>guide</a>
                            <div class="dropdown-menu bg-transparent border-0">
                                <a href="listeArticles.php" class="dropdown-item">liste des guides</a>
                                <a href="addArticle.php" class="dropdown-item">liste des cv</a>
                         
                            </div>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Article de blog</a>
                                <div class="dropdown-menu bg-transparent border-0">
                                    <a href="listeArticles.php" class="dropdown-item">liste ds article postes</a>
                                    <a href="addArticle.php" class="dropdown-item">ajouter un article</a>
                             
                                </div>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Clients</a>
                                    <div class="dropdown-menu bg-transparent border-0">
                                        <a href="listeArticles.php" class="dropdown-item">liste reclamation</a>
                                        <a href="addArticle.php" class="dropdown-item">liste reponse</a>
                                 
                                    </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->




        
            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">mettez à jour</h6>
                        <a href="listeArticles.php">Show All</a>
                    </div>
                    <div class="table-responsive">
                        <!-- table class="table text-start align-middle table-bordered table-hover mb-0" -->
                        <?php
                        if (isset($_POST['id_article'])) {
                            $article = $articleC->showarticle($_POST['id_article']); 
                            
                        ?>
                        <form action="" method="POST">
                            <table>
                                <tr>
                                    <td><label for="titre_article">titre_article :</label></td>
                                    <td>
                                        <input type="text" id="titre_article" name="titre_article" value="<?php echo $article['titre_article'] ?>" />
                                        <span id="erreurtitre_article" style="color: red"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="contenu_article">contenu_article :</label></td>
                                    <td>
                                        <textarea type="text" id="contenu_article" name="contenu_article" value="<?php echo $article['contenu_article'] ?>"></textarea>
                                        <span id="erreurcontenu_article" style="color: red"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="date_de_publication">date_de_publication :</label></td>
                                    <td>
                                        <input type="date" id="date_de_publication" name="date_de_publication" value="<?php echo $article['date_de_publication'] ?>" />
                                        <span id="erreurdate_de_publication" style="color: red"></span>
                                    </td>
                                </tr>

                                
                                <td>
                                    <input type="submit" value="Save">
                                </td>
                                <td>
                                    <input type="reset" value="Reset">
                                </td>
                            </table>

                        </form>
                    <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->


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
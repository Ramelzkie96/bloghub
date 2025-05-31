<?php require_once __DIR__ . '/../config/config.php'; ?>
<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Clean Blog - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?php echo BASE_URL; ?>css/styles.css" rel="stylesheet" />
        <!-- Toastr CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


        <!-- jQuery (required by Toastr) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand d-flex align-items-center" href="../index.php">
    <i class="bi bi-journal-richtext me-2"></i> BlogHub
</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">

                    <div class="input-group ps-5">
                            <div id="navbar-search-autocomplete" class="w-100">
                                <form method="POST" action="<?php echo BASE_URL; ?>search.php">
                                    <input name="search" type="search" id="form1" class="form-control mt-3" placeholder="search" />                            
                                </form>
                            </div>                
                    </div>

                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo BASE_URL; ?>index.php">Home</a></li>

                    <?php if(isset($_SESSION['username'])) : ?>

                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo BASE_URL; ?>posts/create.php">create</a></li>
                        <li class="nav-item dropdown mt-3">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['username']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>users/profile.php?prof_id=<?php echo $_SESSION['user_id']; ?>">Profile</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>auth/logout.php">logout</a></li>
                               
                            </ul>
                        </li>
                    <?php else : ?>    
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo BASE_URL ?>auth/login.php">login</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo BASE_URL ?>auth/register.php">register</a></li>

                    <?php endif; ?>    
                       
                      
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="<?php echo BASE_URL ?>contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
<?php require_once __DIR__ . '/../../config/config.php'; ?>
<?php 

    session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Admin Panel</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
     <link href="<?php echo BASE_URL; ?>admin-panel/styles/style.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
      <div class="container">
      <a class="navbar-brand" href="#"><i class="bi bi-journal-richtext me-2"></i> BlogHub</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <?php if(isset($_SESSION['adminname'])) : ?>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav side-nav" >
          <li class="nav-item">
            <a class="nav-link text-white" style="margin-left: 20px;" href="<?php echo BASE_URL; ?>admin-panel/index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>admin-panel/admins/admins.php" style="margin-left: 20px;">Admins</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>admin-panel/categories-admins/show-categories.php" style="margin-left: 20px;">Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>admin-panel/posts-admins/show-posts.php" style="margin-left: 20px;">Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>admin-panel/comments-admins/show-comments.php" style="margin-left: 20px;">Comments</a>
          </li>
          <?php endif; ?>
         
        </ul>
        <ul class="navbar-nav ml-md-auto d-md-flex">
        <?php if(isset($_SESSION['adminname'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>admin-panel/index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
        
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <?php echo $_SESSION['adminname']; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo BASE_URL; ?>admin-panel/admins/logout.php">Logout</a>
            </div>
          </li>
           <?php else : ?> 
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL; ?>admin-panel/admins/login-admins.php">login
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php endif;  ?> 
            
          
        </ul>
      </div>
    </div>
    </nav>
    <div class="container">
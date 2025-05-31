<?php require_once __DIR__ . '/../../config/config.php'; ?>
<?php require "../../config/config.php"; ?>


<?php 


    if(!isset($_SESSION['adminname'])) {
        header("location: " . BASE_URL . "admin-panel/admins/login-admins.php");
    }

    if(isset($_GET['comment_id']) AND isset($_GET['status_comment'])) {
      $id = $_GET['comment_id'];
      $status = $_GET['status_comment'];

     

            if($status == 0) {
                
            
                    $update = $conn->prepare("UPDATE comments SET status_comment = 1  WHERE id = '$id'");

                    $update->execute();

                    header("location: " . BASE_URL . "admin-panel/comments-admins/show-comments.php");
                    

            } else {
                    $update = $conn->prepare("UPDATE comments SET status_comment = 0  WHERE id = '$id'");

                    $update->execute();

                    header("location: " . BASE_URL . "admin-panel/comments-admins/show-comments.php");
            
            }



      } else {
        header("location: " . BASE_URL . "404.php");
      
      }




?>
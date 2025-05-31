<?php require_once __DIR__ . '/../../config/config.php'; ?>
<?php require "../../config/config.php"; ?>


<?php 

    if(isset($_GET['comment_id'])) {
        $id = $_GET['comment_id'];

        $delete = $conn->prepare("DELETE FROM comments WHERE id = :id");
        $delete->execute([
                ':id' => $id
        ]);
     

       header("location: " . BASE_URL . "admin-panel/comments-admins/show-comments.php");
        
    }  else {
        header("location: " . BASE_URL . "404.php");
       
    }  

?>
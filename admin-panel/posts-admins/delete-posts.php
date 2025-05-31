<?php require_once __DIR__ . '/../../config/config.php'; ?>
<?php require "../../config/config.php"; ?>


<?php 

    if(isset($_GET['po_id'])) {
        $id = $_GET['po_id'];

        $delete = $conn->prepare("DELETE FROM posts WHERE id = :id");
        $delete->execute([
                ':id' => $id
        ]);
    
       header("location: " . BASE_URL . "admin-panel/posts-admins/show-posts.php");

        
    }  else {
        header("location: " . BASE_URL . "404.php");
       
    }  

?>
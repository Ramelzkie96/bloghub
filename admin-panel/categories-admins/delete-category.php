<?php require_once __DIR__ . '/../../config/config.php'; ?>
<?php //require "../includes/navbar.php"; ?>


<?php require "../../config/config.php"; ?>

<?php 

    if(isset($_GET['de_id'])) {
        $id = $_GET['de_id'];

        $delete = $conn->prepare("DELETE FROM categories WHERE id = :id");
        $delete->execute([
            ':id' => $id
        ]);
       

       

       header("location: " . BASE_URL . "admin-panel/categories-admins/show-categories.php");

        
    }  else {
        header("location: " . BASE_URL . "404.php");
       
    }  

?>
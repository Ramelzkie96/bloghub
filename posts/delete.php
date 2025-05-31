<?php require_once __DIR__ . '/../config/config.php'; ?>
<?php 
session_start();
require "../config/config.php";

if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];

    $select = $conn->prepare("SELECT * FROM posts WHERE id = :id");
    $select->execute([':id' => $id]);
    $post = $select->fetch(PDO::FETCH_OBJ);

    if (!$post) {
        header("location: " . BASE_URL . "404.php");
        exit;
    }

    if ($_SESSION['user_id'] != $post->user_id) {
        header("location: " . BASE_URL . "index.php");
        exit;
    }

    if (!empty($post->img) && file_exists("images/" . $post->img)) {
        unlink("images/" . $post->img);
    }

    $delete = $conn->prepare("DELETE FROM posts WHERE id = :id");
    $delete->execute([':id' => $id]);

    $_SESSION['toastrSuccess'] = "Post deleted successfully!";
    header("location: " . BASE_URL . "index.php");
    exit;
    
} else {
    header("location: " . BASE_URL . "404.php");
    exit;
}

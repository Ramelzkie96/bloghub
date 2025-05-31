<?php require_once __DIR__ . '/../../config/config.php'; ?>
<?php 

    session_start();
    session_unset();
    session_destroy();
    header("location: " . BASE_URL . "admin-panel/admins/login-admins.php");


?>
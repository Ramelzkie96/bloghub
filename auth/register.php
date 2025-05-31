<?php require_once __DIR__ . '/../config/config.php'; ?>
<?php
session_start(); // Always first

require "../config/config.php";

if (isset($_SESSION['username'])) {
    header("location: " . BASE_URL . "index.php");
    exit;
}

$errorMessage = '';

if (isset($_POST['submit'])) {
    if ($_POST['email'] == '' || $_POST['username'] == '' || $_POST['password'] == '') {
        $errorMessage = "Please fill in all fields.";
    } else {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $insert = $conn->prepare("INSERT INTO users (email, username, mypassword) VALUES (:email, :username, :mypassword)");
        $insert->execute([
            ':email' => $email,
            ':username' => $username,
            ':mypassword' => $password
        ]);

        header("Location: login.php");
        exit;
    }
}
?>

<?php require "../includes/header.php"; ?>

<div class="container py-5">
    <?php if (!empty($errorMessage)) : ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= htmlspecialchars($errorMessage) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="register.php">
        <div class="form-outline mb-4">
            <input type="email" name="email" class="form-control" placeholder="Email" />
        </div>

        <div class="form-outline mb-4">
            <input type="text" name="username" class="form-control" placeholder="Username" />
        </div>

        <div class="form-outline mb-4">
            <input type="password" name="password" class="form-control" placeholder="Password" />
        </div>

        <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Register</button>

        <div class="text-center">
            <p>Already a member? <a href="login.php">Login</a></p>
        </div>
    </form>
</div>

<?php require "../includes/footer.php"; ?>


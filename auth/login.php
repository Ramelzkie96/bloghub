<?php require_once __DIR__ . '/../config/config.php'; ?>
<?php
session_start(); // Start the session
require "../config/config.php";

// ✅ Redirect to index if already logged in
if (isset($_SESSION['username'])) {
    header("location: " . BASE_URL . "index.php");
    exit();
}

// ✅ Handle login form submission
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = "Enter data into the inputs";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $login = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $login->execute(['email' => $email]);
        $row = $login->fetch(PDO::FETCH_ASSOC);

        if ($login->rowCount() > 0 && password_verify($password, $row['mypassword'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];

            // ✅ Successful login, redirect now
            header("location: " . BASE_URL . "index.php");
            exit();
        } else {
            $error = "The email or password is wrong";
        }
    }
}
?>

<?php require "../includes/header.php"; ?>

<!-- Show error if any -->
<?php if (isset($error)): ?>
    <div class='alert alert-danger text-center' role='alert'>
        <?= $error ?>
    </div>
<?php endif; ?>

<form method="POST" action="login.php">
    <div class="form-outline mb-4">
        <input type="email" name="email" class="form-control" placeholder="Email" />
    </div>

    <div class="form-outline mb-4">
        <input type="password" name="password" class="form-control" placeholder="Password" />
    </div>

    <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Login</button>

    <div class="text-center">
        <p>A new member? Create an account <a href="register.php">Register</a></p>
    </div>
</form>

<?php require "../includes/footer.php"; ?>

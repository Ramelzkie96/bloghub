
<?php require_once __DIR__ . '/../config/config.php'; ?>
<?php
require_once __DIR__ . '/../config/config.php';

session_start();
require "../config/config.php";

// Fetch categories
$categories = $conn->query("SELECT * FROM categories");
$categories->execute();
$category = $categories->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {
    $title = $_POST['title'] ?? '';
    $subtitle = $_POST['subtitle'] ?? '';
    $body = $_POST['body'] ?? '';
    $category_id = $_POST['category_id'] ?? '';

    if ($title == '' || $subtitle == '' || $body == '') {
        $toastrError = "Please fill in all required fields.";
    } elseif ($category_id == '' || $category_id == 'Choose a category') {
        $toastrError = "Please select a valid category.";
    } else {
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['username'];

        if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
            $img = $_FILES['img']['name'];
            $tmpName = $_FILES['img']['tmp_name'];
            $mimeType = mime_content_type($tmpName);

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

            if (!in_array($mimeType, $allowedTypes)) {
                $toastrError = "Invalid file type. Please upload a valid image (JPG, PNG, GIF, or WEBP).";
            } else {
                $dir = 'images/' . basename($img);

                $insert = $conn->prepare("INSERT INTO posts (title, subtitle, body, category_id, img, user_id, user_name) 
                    VALUES (:title, :subtitle, :body, :category_id, :img, :user_id, :user_name)");

                $insert->execute([
                    ':title' => $title,
                    ':subtitle' => $subtitle,
                    ':body' => $body,
                    ':category_id' => $category_id,
                    ':img' => $img,
                    ':user_id' => $user_id,
                    ':user_name' => $user_name,
                ]);

                if (move_uploaded_file($tmpName, $dir)) {
                    $_SESSION['toastrSuccess'] = "Post submitted successfully! It needs to be approved by an admin before it appears.";
                    header("location: " . BASE_URL . "index.php");
                    exit();
                }

            }
        } else {
            $toastrError = "Please upload an image.";
        }
    }
}

?>

<?php require "../includes/header.php"; ?>

<?php if (isset($error)): ?>
    <div class='alert alert-danger text-center' role='alert'>
        <?= $error ?>
    </div>
<?php endif; ?>

<form method="POST" action="create.php" enctype="multipart/form-data">
    <div class="form-outline mb-4">
        <input type="text" name="title" class="form-control" placeholder="Title" />
    </div>

    <div class="form-outline mb-4">
        <input type="text" name="subtitle" class="form-control" placeholder="Subtitle" />
    </div>

    <div class="form-outline mb-4">
        <textarea name="body" class="form-control" placeholder="Body" rows="8"></textarea>
    </div>

    <div class="form-outline mb-4">
        <select name="category_id" class="form-select" aria-label="Select category" required>
            <option value="" selected disabled>Choose a category</option>
            <?php foreach ($category as $cat): ?>
                <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
            <?php endforeach; ?>
        </select>

    </div>

    <div class="form-outline mb-4">
        <input type="file" name="img" class="form-control" />
    </div>

    <button type="submit" name="submit" class="btn btn-primary mb-4">Create</button>
</form>

<?php if (isset($toastrError)): ?>
<script>
    $(document).ready(function() {
        toastr.options = {
            "positionClass": "toast-bottom-right", // 👈 ensures bottom right
            "closeButton": true,
            "progressBar": true,
            "timeOut": "5000"
        };
        toastr.error("<?= addslashes($toastrError) ?>");
    });
</script>
<?php endif; ?>


<?php require "../includes/footer.php"; ?>

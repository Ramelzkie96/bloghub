<?php require_once __DIR__ . '/../config/config.php'; ?>
<?php 
session_start();


require "../config/config.php";

if (isset($_GET['upd_id'])) {
    $id = $_GET['upd_id'];

    $select = $conn->query("SELECT * FROM posts WHERE id = '$id'");
    $select->execute();
    $rows = $select->fetch(PDO::FETCH_OBJ);

    if (!$rows) {
        echo "<div class='alert alert-danger text-center'>Post not found.</div>";
        exit();
    }

    if($_SESSION['user_id'] != $rows->user_id) {
        echo "Not allowed - user mismatch";
        exit();
    }


    if (isset($_POST['submit'])) {
    if ($_POST['title'] == '' || $_POST['subtitle'] == '' || $_POST['body'] == '') {
        echo "<div class='alert alert-danger text-center' role='alert'>
                Enter data into the inputs
              </div>";
    } else {
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $body = $_POST['body'];

        $img = $_FILES['img']['name'];

        // If a new image is uploaded
        if (!empty($img)) {
            // Delete old image
            if (file_exists("images/" . $rows->img)) {
                unlink("images/" . $rows->img);
            }

            $dir = 'images/' . basename($img);
            move_uploaded_file($_FILES['img']['tmp_name'], $dir);
        } else {
            // Keep the old image
            $img = $rows->img;
        }

        $update = $conn->prepare("UPDATE posts SET title = :title, subtitle = :subtitle, body = :body, img = :img WHERE id = '$id'");
        $update->execute([
            ':title' => $title,
            ':subtitle' => $subtitle,
            ':body' => $body,
            ':img' => $img
        ]);

        $_SESSION['toastrSuccess'] = "Post updated successfully!";

        header('location: ' . BASE_URL . 'index.php'); // ✅ redirect
        exit();

    }
}
} else {
    header("location: " . BASE_URL . "404.php");
    exit();
}
?>
<?php require "../includes/header.php"; ?>

            <form method="POST" action="update.php?upd_id=<?php echo $id; ?>" enctype="multipart/form-data">
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input type="text" name="title" value="<?php echo $rows->title; ?>" id="form2Example1" class="form-control" placeholder="title" />
               
              </div>

              <div class="form-outline mb-4">
                <input type="text" name="subtitle" value="<?php echo $rows->subtitle; ?>" id="form2Example1" class="form-control" placeholder="subtitle" />
            </div>

            <div class="form-outline mb-4">
                <textarea type="text" name="body" id="form2Example1" class="form-control" placeholder="body" rows="8"><?php echo $rows->body; ?></textarea>
            </div>
            <img id="previewImage" src="images/<?php echo $rows->img; ?>" width="900" height="300" style="object-fit: cover;">

              
            <div class="form-outline mb-4">
                <input type="file" name="img" id="imageInput" class="form-control" placeholder="image" accept="image/*" />

            </div>

              <!-- Submit button -->
              <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>
            </form>

            <script>
            document.getElementById('imageInput').addEventListener('change', function(event) {
                const [file] = event.target.files;
                if (file) {
                    const preview = document.getElementById('previewImage');
                    preview.src = URL.createObjectURL(file);
                }
            });
            </script>


 <?php require "../includes/footer.php"; ?>
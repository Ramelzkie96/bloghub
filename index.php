<?php
require_once __DIR__ . '/./config/config.php';
session_start();
require "includes/header.php";
require "config/config.php";

$toastrSuccess = '';
if (isset($_SESSION['success'])) {
    $toastrSuccess = $_SESSION['success'];
    unset($_SESSION['success']); // Show once only
}
?>




<?php 
    $posts = $conn->query("SELECT * FROM posts WHERE status = 1 ORDER BY created_at DESC");
    $posts->execute();
    $rows = $posts->fetchAll(PDO::FETCH_OBJ);

    $categories = $conn->query("SELECT * FROM categories");
    $categories->execute();
    $category = $categories->fetchAll(PDO::FETCH_OBJ);
?>
<style>
    .image-container {
    width: 100%;
    height: 200px; 
    overflow: hidden;
    }

    .fixed-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

</style>

<div class="container py-5">
    <?php if (count($rows) > 0): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php foreach($rows as $row) : ?>
    <div class="col">
        <div class="card h-100 shadow-sm border-0">
            <?php if (!empty($row->img)) : ?>
            <div class="image-container">
                <img src="posts/images/<?php echo htmlspecialchars($row->img); ?>" class="card-img-top fixed-img" alt="Post Image">
            </div>
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($row->title); ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars($row->subtitle); ?></h6>
                <p class="card-text small">
                    <?php echo substr(strip_tags($row->body), 0, 100) . '...'; ?>
                </p>
                <a href="<?php echo BASE_URL; ?>posts/post.php?post_id=<?php echo $row->id; ?>" class="btn btn-outline-primary btn-sm mt-2">Read More</a>
            </div>
            <div class="card-footer text-muted small">
                Posted by <strong><?php echo htmlspecialchars($row->user_name); ?></strong><br>
                on <?php echo date('F d, Y', strtotime($row->created_at)); ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

    <?php else: ?>
        <div class="text-center py-5">
            <h4 class="text-muted">No posts available at the moment.</h4>
        </div>
    <?php endif; ?>

    <hr class="my-5">

    <h3 class="mb-4 text-center">Categories</h3>

<?php if (count($category) > 0): ?>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($category as $cat) : ?>
        <div class="col">
            <a href="<?php echo BASE_URL; ?>categories/category.php?cat_id=<?php echo $cat->id; ?>" class="text-decoration-none">
                <div class="card h-100 shadow-sm border-0 hover-shadow">
                    <div class="card-body text-center bg-light">
                        <i class="bi bi-folder-fill text-primary mb-2" style="font-size: 2rem;"></i>
                        <h5 class="card-title mb-0 text-dark"><?php echo htmlspecialchars($cat->name); ?></h5>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="text-center py-5">
        <h4 class="text-muted">No categories available.</h4>
    </div>
<?php endif; ?>


</div>

<?php
$toastrSuccess = '';
if (isset($_SESSION['toastrSuccess'])) {
    $toastrSuccess = $_SESSION['toastrSuccess'];
    unset($_SESSION['toastrSuccess']);
}
?>

<?php if (!empty($toastrSuccess)): ?>
<script>
    $(document).ready(function() {
        toastr.options = {
            "positionClass": "toast-bottom-right",
            "closeButton": true,
            "progressBar": true,
            "timeOut": "5000"
        };
        toastr.success("<?= addslashes($toastrSuccess) ?>");
    });
</script>
<?php endif; ?>




<?php require "includes/footer.php"; ?>

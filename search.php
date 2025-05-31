<?php require_once __DIR__ . '/./config/config.php'; ?>
<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>

<?php 
if (isset($_POST['search'])) {
    if ($_POST['search'] == '') {
        header('location: index.php');
        exit();
    } else {
        $search = $_POST['search'];

        $data = $conn->query("SELECT * FROM posts WHERE title LIKE '%$search%' AND status = 1");
        $data->execute();
        $rows = $data->fetchAll(PDO::FETCH_OBJ);
    }
} else {
    header('location: index.php');
    exit();
}
?>

<div class="container mt-5">
    <?php if (count($rows) > 0): ?>
        <h4 class="mb-4 text-center">Search Results (<?php echo count($rows); ?>)</h4>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($rows as $row) : ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <?php if (!empty($row->img)) : ?>
                    <img src="posts/images/<?php echo htmlspecialchars($row->img); ?>" class="card-img-top" alt="Post Image">
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
        <div class="alert alert-danger bg-danger text-white text-center">
            No search results found for "<?php echo htmlspecialchars($_POST['search']); ?>"
        </div>
    <?php endif; ?>
</div>

<?php require "includes/footer.php"; ?>

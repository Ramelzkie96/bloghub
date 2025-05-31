<?php require_once __DIR__ . '/../config/config.php'; ?>
<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 


    if(isset($_GET['cat_id'])) {
        $id = $_GET['cat_id'];

        $posts = $conn->query("SELECT 
            posts.id AS id, 
            posts.title AS title, 
            posts.subtitle AS subtitle, 
            posts.body AS body, 
            posts.img AS img,
            posts.user_name AS user_name, 
            posts.created_at AS created_at, 
            posts.category_id AS category_id, 
            posts.status AS status
        FROM categories 
        JOIN posts ON categories.id = posts.category_id 
        WHERE posts.category_id = '$id' AND status = 1");

        $posts->execute();
        $rows = $posts->fetchAll(PDO::FETCH_OBJ);


    } else {
        header("location: " . BASE_URL . "404.php");
       
    }
   


?>
        <div class="container py-5">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach($rows as $row) : ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <?php if (!empty($row->img)) : ?>
                        <img src="../posts/images/<?php echo htmlspecialchars($row->img); ?>" class="card-img-top" alt="Post Image">
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
        </div>



<?php require "../includes/footer.php"; ?>
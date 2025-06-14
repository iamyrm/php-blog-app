<?php
include 'includes/header.php';
require 'config/config.php';

// Fetching posts
$posts = $conn->query("SELECT * FROM posts");
$posts->execute();
$rows = $posts->fetchAll(PDO::FETCH_OBJ);

?>

<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-7">

        <?php foreach ($rows as $row): ?>
            <!-- Post preview-->
            <div class="post-preview">
                <a href="http://localhost/ya/php/blog/posts/post.php">
                    <h2 class="post-title"><?php echo $row->title; ?></h2>
                    <h3 class="post-subtitle"><?php echo $row->subtitle; ?></h3>
                </a>
                <p class="post-meta">
                    Posted by
                    <a href="#!"><?php echo $row->user_name; ?></a>
                    on <?php
                        $date = $row->created_at;
                        if (is_string($date)) {
                            $date = new DateTime($date);
                        }
                        echo $date->format('F j, Y');
                        ?>
                </p>
            </div>
            <!-- Divider-->
            <hr class="my-4" />
        <?php endforeach; ?>
    </div>
</div>

<?php
include 'includes/footer.php';
?>
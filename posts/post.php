<?php
include '../includes/nav.php';
require '../config/config.php';

if (isset($_GET['p_id'])) {
    $id = $_GET['p_id'];

    $get_posts = $conn->query("SELECT * FROM posts WHERE id = '$id'");

    $get_posts->execute();
    $posts = $get_posts->fetch(PDO::FETCH_OBJ);
} else {
    echo "404";
}
?>
<!-- Page Header-->
<header class="masthead" style="background-image: url('images/<?php echo $posts->feature_image; ?>')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1><?php echo $posts->title; ?></h1>
                    <h2 class="subheading"><?php echo $posts->subtitle; ?></h2>
                    <span class="meta">
                        Posted by
                        <a href="#!"><?php echo $posts->user_name; ?></a>
                        on <?php
                            $date = $posts->created_at;
                            if (is_string($date)) {
                                $date = new DateTime($date);
                            }
                            echo $date->format('F j, Y');
                            ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p><?php echo $posts->body_content; ?></p>
                <a href="http://localhost/ya/php/blog/posts/delete.php?del_id=<?php echo $posts->id; ?>" class="btn btn-danger text-center float-end" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>

                <a href="update.php?upd_id=<?php echo $posts->id; ?>" class="btn btn-warning text-center">Update</a>
            </div>
        </div>
    </div>
</article>

<?php include '../includes/footer.php'; ?>
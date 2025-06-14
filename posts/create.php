<?php
include '../includes/header.php';
require '../config/config.php';

if (isset($_POST['create_blog_form'])) {
    if (empty($_POST['title']) || empty($_POST['subtitle']) || empty($_POST['body_content'])) {
        echo "Please enter all required text fields";
    } elseif (!isset($_FILES['feature_image']) || $_FILES['feature_image']['error'] === UPLOAD_ERR_NO_FILE) {
        echo "Please upload a feature image";
    } else {
        $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
        $subtitle = htmlspecialchars($_POST['subtitle'], ENT_QUOTES, 'UTF-8');
        $body_content = htmlspecialchars($_POST['body_content'], ENT_QUOTES, 'UTF-8');
        $user_id = $_SESSION['user_id'];
        $user_name = $_SESSION['username'];

        if ($_FILES['feature_image']['error'] === UPLOAD_ERR_OK) {
            $feature_image = $_FILES['feature_image']['name'];
            $dir = 'images/' . basename($feature_image);

            if (move_uploaded_file($_FILES['feature_image']['tmp_name'], $dir)) {
                $insert = $conn->prepare("INSERT INTO posts (title, subtitle, body_content, feature_image, user_id,user_name) VALUES (:title, :subtitle, :body_content, :feature_image, :user_id,:user_name)");

                $insert->execute([
                    ':title' => $title,
                    ':subtitle' => $subtitle,
                    ':body_content' => $body_content,
                    ':feature_image' => $feature_image,
                    ':user_id' => $user_id,
                    ':user_name' => $user_name
                ]);
                header("Location: http://localhost/ya/php/blog");
                exit;
            } else {
                echo "Failed to upload the image";
            }
        } else {
            echo "File upload error: " . $_FILES['feature_image']['error'];
        }
    }
}
?>

<form method="POST" action="create.php" enctype="multipart/form-data">
    <!-- Title input -->
    <div class="form-outline mb-4">
        <input type="text" name="title" id="title" class="form-control" placeholder="Title" />
    </div>

    <!-- Subtitle input -->
    <div class="form-outline mb-4">
        <input type="text" name="subtitle" id="subtitle" class="form-control" placeholder="Subtitle" />
    </div>

    <!-- Body content textarea -->
    <div class="form-outline mb-4">
        <textarea name="body_content" id="body_content" class="form-control" placeholder="Body" rows="8"></textarea>
    </div>

    <!-- File input -->
    <div class="form-outline mb-4">
        <input type="file" name="feature_image" id="feature_image" class="form-control" />
    </div>

    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Create</button>
    <input type="hidden" name="create_blog_form" value="1">
</form>

<?php include '../includes/footer.php'; ?>
<?php
include '../includes/header.php';
require '../config/config.php';

if (isset($_POST['reg_form'])) {
    if (empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])) {
        echo "Please fill all the input fields";
    } else {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $username = htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8');
        $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

        $insert = $conn->prepare("INSERT INTO users (email, uname, pwd) VALUES(:email, :uname,:pwd)");
        $insert->execute([
            ':email' => $email,
            ':uname' => $username,
            ':pwd' => $password
        ]);
        header("location: index.php");
    }
}
?>

<form method="POST" action="register.php">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required />
    </div>

    <div class="form-outline mb-4">
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required />
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" name="password" id="password" placeholder="Password" class="form-control" required />
    </div>

    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Register</button>

    <input type="hidden" name="reg_form">
    <!-- Register buttons -->
    <div class="text-center">
        <p>Aleardy a member? <a href="login.php">Login</a></p>
    </div>
</form>

<?php include '../includes/footer.php' ?>
<?php
include '../includes/header.php';
require '../config/config.php';

// Redirecting the user to homepage if the user is logged in

if (isset($_SESSION['username'])) {
    header("location: http://localhost/ya/php/blog/");
}


if (isset($_POST['login_submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo "Please enter datas into all the input fields";
    } else {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        $login = $conn->query("SELECT * FROM users WHERE email= '$email'");
        $login->execute();

        $row = $login->fetch(PDO::FETCH_ASSOC);

        if ($login->rowCount() > 0) {
            if (password_verify($password, $row['pwd'])) {
                $_SESSION['username'] = $row['uname'];
                $_SESSION['user_id'] = $row['id'];
                header("location: http://localhost/ya/php/blog/");
            } else {
                echo "Crdentials error";
            }
        } else {
            echo "Crdentials error";
        }
    }
}

?>

<form method="POST" action="login.php">
    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <input type="password" name="password" id="password" placeholder="Password" class="form-control" />
    </div>

    <!-- Submit button -->
    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>
    <input type="hidden" name="login_submit">

    <!-- Register buttons -->
    <div class="text-center">
        <p>a new member? Create an acount<a href="register.php"> Register</a></p>
    </div>
</form>

<?php include '../includes/footer.php'; ?>
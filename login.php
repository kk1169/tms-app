<?php
include "./config/config.php";
include "./config/db.php";



// On Login

if (isset($_POST['onLogin'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $LoginQueryResult = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
    $LoggedInUserRow =  $LoginQueryResult->num_rows;

    if ($LoggedInUserRow === 1) {
        $LoggedInUser =  $LoginQueryResult->fetch_assoc();

        session_start();
        $_SESSION['userId'] = $LoggedInUser['id'];
        $_SESSION['email'] = $LoggedInUser['email'];
        $_SESSION['name'] = $LoggedInUser['name'];
        $_SESSION['role'] = $LoggedInUser['role'];
        header('Location: ' . './dashboard.php');
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="<?= $base_url ?>assets/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $base_url ?>assets/css/style.css">
</head>

<body>

    <div class="card mx-auto mt-5" style="width: 26rem;">
        <div class="card-body">
            <h5 class="card-title">Login Here</h5>

            <div>
                <form method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary" name="onLogin">Login</button>

                    <p class="mt-3 mb-0">Don't have an account? <a href="./register.php">Register</a></p>
                </form>
            </div>
        </div>
    </div>

    <!-- scripts -->
    <script src="<?= $base_url ?>assets/lib/jquery/jquery.min.js"></script>
    <script src="<?= $base_url ?>assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
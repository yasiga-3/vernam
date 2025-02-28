<?php
session_start();
if(isset($_SESSION['id'])){
   session_unset();
   session_destroy();
}
ob_start();
include_once("connection.php");
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "insert into user(email,password) values('".$email."','".$password."')";
    $execute = mysqli_query($conn, $query);
    if($execute){
        header('Location: index.php');
        $_SESSION['id'] = $email;
    }else{
        header('Location: index.php');
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="login-dark">
        <form method="post" action="register.php">
            <div class="illustration">
                <i class="icon ion-ios-locked-outline"></i>
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <button name="submit" class="btn btn-primary btn-block" type="submit">Sign Up</button>
            </div>
            <div class="form-group">
                <span>If already you have an account? <a href="index.php">Log In</a></span>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
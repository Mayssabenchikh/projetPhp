<?php
 /*session_start();
 if (!isset($_SESSION['id'])) {
    header("Location: log.html");
    exit();
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Register Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">User</button>
                <button type="button" class="toggle-btn" onclick="register()">Admin</button>
            </div>
            <div class="social-icons">
                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                <i class="fa fa-instagram" aria-hidden="true"></i>
                <i class="fa fa-twitter-square" aria-hidden="true"></i>
            </div>
            <form action="verifexist.php" id="login" class="input-group" method="GET">
                <input type="text" class="input-field" placeholder="email" required name="email">
                <input type="password" class="input-field" placeholder="Password" required name="password">
                <a id="aa" href="loginuser.html" class="create-account">Create Account</a>
                <button type="submit" class="submit-btn">Log In</button>
            </form>
            <form action="" id="register" class="input-group">
                <input type="email" class="input-field" placeholder="Admin ID" required>
                <input type="password" class="input-field" placeholder="Password" required>
                <!--<input type="checkbox" class="check-box">-->
                <!--<span>I agree to the <a href="#" class="terms">Terms & Services</a></span>-->
                <button type="submit" class="submit-btn">Register</button>
            </form>
        </div>
    </div>
    <script>
        var log = document.getElementById("login");
        var reg = document.getElementById("register");
        var button = document.getElementById("btn");

        function register() {
            log.style.left = "-300px";
            reg.style.left = "50px";
            button.style.left = "110px";
        }
        function login() {
            log.style.left = "50px";
            reg.style.left = "450px";
            button.style.left = "0";
        }
    </script>
</body>
</html>

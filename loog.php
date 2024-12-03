<?php
session_start(); 

$message = "";
$messageType = "";

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $messageType = $_SESSION['message_type'];
    unset($_SESSION['message'], $_SESSION['message_type']); }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Register Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
        }

       
    </style>
</head>

<body>
    <div class="hero">
        <div class="form-box">
            <div>

                <!--<button type="button" class="toggle-btn" onclick="login()">User</button>-->
                <!-- <button type="button" class="toggle-btn" onclick="register()">Admin</button>-->

            </div>

            <div class="social-icons">
                <i class="fa fa-facebook-square" aria-hidden="true"></i>
                <i class="fa fa-instagram" aria-hidden="true"></i>
                <i class="fa fa-twitter-square" aria-hidden="true"></i>
            </div>
            <form action="verifexist.php" method="POST" id="login" class="input-group">
            <input type="text" class="input-field" placeholder="email" name="login" required>
<input type="password" class="input-field" placeholder="Password" name="password" required>
<br><br>
                <button type="submit" class="submit-btn">Log In</button><br><br><br>
                <a id="aa" href="user.php" class="create-account"> create account</a>
                <?php if (!empty($message)) : ?>
                <h3 class="<?= htmlspecialchars($messageType) ?>"><?= htmlspecialchars($message) ?></h3>
            <?php endif; ?>



            </form>
            <!--<form action="" id="register" class="input-group">
                <input type="email" class="input-field" placeholder="Admin ID" required>
                <input type="password" class="input-field" placeholder="Password" required>-->
            <!--<input type="checkbox" class="check-box">-->
            <!--<span>I agree to the <a href="#" class="terms">Terms & Services</a></span>-->
            <!-- <button type="submit" class="submit-btn" >Register</button>
            </form>-->
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
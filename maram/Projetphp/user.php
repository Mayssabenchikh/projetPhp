<?php
require("./menu.php");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styleloguser.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="loginBox">
        <img class="user" src="/assets/user.png" alt="User">
        <h3>Create Account</h3>
        <form action="adddeuser.php" method="GET" onsubmit="return verif()">
            <div class="inputBox">
                <span><i class="fa fa-user" aria-hidden="true"></i></span>
                <input type="text" required name="name" placeholder="Username" id="name">
                <br>
                <span><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                <input type="email" required name="email" placeholder="Email" id="email">
                <br>
                <span><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input type="password" required name="passwd" placeholder="Password" id="password">
                <br>
                <span><i class="fa fa-mobile" aria-hidden="true"></i></span>
                <input type="text" name="number" placeholder="Phone Number">
                <br>
                <input type="submit" value="Create"  >
            </div>
        </form>
    </div>
    <script>
        function verif() {
            const nom = document.getElementById("name");
            const password = document.getElementById("password");
            const specialChars = "!C#$%^&*()_-+=£}[]:;\"'<>,.?/~";

            if (nom.value.length > 20) {
                alert("Le nom ne doit pas dépasser 20 caractères.");
                return false;
            }

            for (let char of nom.value) {
                if (!/^[a-zA-Z]+$/.test(char)) {
                    alert("Le nom doit être composé uniquement de lettres alphabétiques.");
                    return false;
                }
            }

            if (password.value.length < 6) {
                alert("Le mot de passe doit contenir au moins 6 caractères.");
                return false;
            }

            let hasUppercase = /[A-Z]/.test(password.value);
            let hasNumber = /\d/.test(password.value);
            let hasSpecial = new RegExp(`[${specialChars}]`).test(password.value);

            if (!hasUppercase || !hasNumber || !hasSpecial) {
                alert("Le mot de passe doit contenir au moins une majuscule, un chiffre et un caractère spécial.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>

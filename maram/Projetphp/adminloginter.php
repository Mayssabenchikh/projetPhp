<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="hero">
        <div class="form-box">
            <div >
                
                <!--<button type="button" class="toggle-btn" onclick="login()">User</button>-->
               <!-- <button type="button" class="toggle-btn" onclick="register()">Admin</button>-->
            
            </div>

            <h2>Admin Interface</h2>
            <form action="verifadm.php" method="POST" id="login" class="input-group">
                <input type="text" class="input-field" placeholder="Adm kley identification" name="id" required><br><br>
                <input type="text" class="input-field" placeholder="Password" name="password" required> <br><br>
                <button type="submit" class="submit-btn">Log In</button><br><br><br>
                
            </form>
            <!--<form action="" id="register" class="input-group">
                <input type="email" class="input-field" placeholder="Admin ID" required>
                <input type="password" class="input-field" placeholder="Password" required>-->
                <!--<input type="checkbox" class="check-box">-->
                <!--<span>I agree to the <a href="#" class="terms">Terms & Services</a></span>-->
               <!-- <button type="submit" class="submit-btn" >Register</button>
            </form>-->
            <?php
  
                session_start();
                if(isset($_SESSION['message_erreur'] )){
                    echo "<p style='color:red;text-align:center;'>".$_SESSION['message_erreur'] ."<p>";
                    unset($_SESSION['message_erreur'] );
                }

                
            ?>
        </div>
    
    </div>
    
</body>
</html>

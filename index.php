<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/Login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main">
        <nav class = "nav">
            <a href="#" class="logo"><img src = 'Images/Backgrounds/bclogo.png'></a>
        </nav>
        <div class="main-content">           
            <div class="main-col-left">
                <h1>Integrated&nbspInventory Management.</h1>
                    <img src="Images/Backgrounds/Dash.svg" alt="dashboard-image" class="main-img">
            </div> 
            <div class="main-login">
                <h3> Sign In </h3>
                <form action = "auth.php" method="POST">
                    <?php
                        if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
                            echo "<p class='wrong'>Wrong Username / Password</p>";
                        }
                    ?>
                    <input type="text" name="username" placeholder="Username" id="username" autocomplete="off" required>
                    <input type="password" name="password" placeholder="Password" id="password" autocomplete="off" required>   
                    <input type = "submit" value="Sign-In" class="sign-in"> 
                </form> 
            </div>
        </div>
    </div> 
</body>
</html>

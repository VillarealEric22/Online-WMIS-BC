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
            <a href="#" class="logo">Baker's Craft</a>
        </nav>
        <div class="main-content">           
            <div class="main-col-left">
                <h1>Integrated&nbspInventory Management.</h1>
                    <img src="Images/Backgrounds/Dash.svg" alt="dashboard-image" class="main-img">
            </div> 
            <div class="main-login">
                <h3> Sign In </h3>
                <input type = "email" placeholder="Email">
                <input type = "password" placeholder="Password">
                <a href="Dashboard.php" class="sign-in">Sign-In</a>
                <label class="rememberme">
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
                <a href="#" class="forgot">Forgot Password?</a>
                
                <div class="contact">
                    <p>Having problems signing in?</p>
                    <a href="#" class="contact-admin"> Contact an Administrator</a>
                </div>
            </div>
          
        </div>

    </div> 
</body>
</html>
<?php
    session_start();
    //connection info.
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_inventory';
    //connect using data above.
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if ( mysqli_connect_errno() ) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    // check if the data from the login form was submitted.
    if ( !isset($_POST['username'], $_POST['password']) ) {
        // Can't get the data.
        exit('Please fill both the username and password fields!');
    }
    // Prepare our SQL (anti-SQL injection)
    if ($stmt = $con->prepare('SELECT username, password FROM user WHERE username = ?')) {
        //Bind parameters
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        //check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($username, $password);
            $stmt->fetch();
            //Account exists, now we verify the password.
            if (password_verify($_POST['password'], $password)){
                //Create sessions.
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['username'] = $_POST['username'];
                header('Location: Dashboard.php');
            } else {
                //Incorrect password
                header("location:Index.php?msg=failed");
            }
        }else {
            //Incorrect username
            header("location:Index.php?msg=failed");
        }
        $stmt->close();
    }
?>
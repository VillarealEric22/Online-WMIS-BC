<?php
    //connection info.
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_inventory';
    //connect using data above.
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno() ) {
        // If there is an error with the connection, stop the script and display the error.
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: Index.php');
        exit;
    }
    $stmt = $con->prepare('SELECT username FROM user WHERE username = ?');

    $stmt->bind_param('s', $_SESSION['username']);
    $stmt->execute();
    $stmt->bind_result($u_id);
    $stmt->fetch();
    $stmt->close();
    $func = $_POST['func'];
    if ($func == "update"){
        $password = $_POST['password'];
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "UPDATE user SET password = ? WHERE username = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ss', $hash_pass, $u_id);
        // Close connection
        if ($stmt->execute()){
            echo $u_id. "'s password updated successfully";
        } else { 
            
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else if($func == "auto_input_us"){
        $sql = "SELECT username, employee_id FROM user WHERE username = '$u_id'";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);
    }
?>
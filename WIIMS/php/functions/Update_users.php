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
    if (isset($_POST['u_un'])){
        $u_un = $_POST['u_un'];
        $u_pass = $_POST['u_pass'];
        $u_role = $_POST['u_role'];
        $u_id = $_POST['u_id'];

        $sql = "UPDATE user SET user_password = ?, user_role = ?, employee_id = ? WHERE username = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssi', $u_un, $u_pass, $u_role, $u_id);
        // Close connection
        if ($stmt->execute()){
            echo $u_un. "'s record created successfully";
        } else {
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else{
        echo "Data Not Saved". $con->error;
    }
?>
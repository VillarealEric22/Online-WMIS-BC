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
    if (isset($_POST['insert'])){
        $u_eid = $_POST['emp_sel'];
        $u_username = $_POST['username'];
        $password = $_POST['password'];
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);
        $u_role = $_POST['user_role'];

        $sql = "INSERT INTO user (employee_id, username, password, user_role) VALUES (?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('isss', $u_eid, $u_username, $hash_pass, $u_role);
        // Close connection
        if ($stmt->execute()){
            echo "new user added successfully";
        } else {
            echo "Data Not Saved". $con->error;;
        }
	    $stmt->close();
        $con->close();
    }
?>
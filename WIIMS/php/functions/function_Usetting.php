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
    $func = $_POST['func'];
   if ($func == "update"){
        $username = $_POST['username'];
        $employee_id = $_POST['employee_id'];
        $password = $_POST['password'];      
    
        $sql = "UPDATE user SET employee_id = ?, password = ? WHERE username = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('iss', $employee_id, $password, $username);
        // Close connection
        if (!empty($stmt->execute())){
            echo $username. "'s record created successfully";
            }
        else { 
            
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else if($func == "auto_input"){
        $edit_id = $_POST['edit_id'];
        $sql = "SELECT username, employee_id, password FROM user WHERE username = $edit_id";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);
    }
?>
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
        $cust_id = $_POST['customer_id'];

        $sql = "DELETE FROM customer WHERE customer_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s',$cust_id);
        // Close connection
        if ($stmt->execute()){
            echo '<script> alert("Row deleted successfully"); </script>';
            header('Location: /WIIMS/Customers.php');
        } else {
            echo '<script> alert("Data Not Saved"); </script>'. $con->error;;
        }
        $con->close();
    }
    
?>
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
    if (isset($_POST['e_ln'])){
        $e_id = $_POST['e_id'];
        $e_ln = $_POST['e_ln'];
        $e_fn = $_POST['e_fn'];
        $e_mi = $_POST['e_mi'];
        $e_add = $_POST['e_add'];
        $e_cnum = $_POST['e_cnum'];
        $e_sx = $_POST['e_sx'];
        $input_date=$_POST['e_bday'];
        $e_bday = date("Y-m-d H:i:s",strtotime($input_date));

        $sql = "INSERT INTO employees (employee_id, lastname, firstname, middlename, emp_address, contact_number, sex, birthday) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('isssssss', $e_id, $e_ln, $e_fn, $e_mi, $e_add, $e_cnum, $e_sx, $e_bday);
        // Close connection
        if ($stmt->execute()){
            echo "New record created successfully";
        } else {
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
?>
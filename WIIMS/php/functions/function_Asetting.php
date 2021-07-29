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
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $middlename = $_POST['middlename'];      
        $sex = $_POST['sex'];
        $birthday = $_POST['birthday'];
        $email_address = $_POST['email_address']; 
        $contact_number = $_POST['contact_number']; 


    
        $sql = "UPDATE employees SET firstname = ?, lastname = ?, middlename = ?, sex = ?, birthday = ?, email_address = ? WHERE contact_number = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssssss', $firstname, $lastname, $middlename, $sex, $birthday, $email_address, $contact_number);
        // Close connection
        if (!empty($stmt->execute())){
            echo $firstname. "'s record created successfully";
            }
        else { 
            
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else if($func == "auto_input"){
        $edit_id = $_POST['edit_id'];
        $sql = "SELECT firstname, lastname, middlename, sex, birthday, email_address, contact_number FROM employees WHERE contact_number = $edit_id";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);
    }
?>
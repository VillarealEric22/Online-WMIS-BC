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
    if ($func=="disp"){
        $sql = "SELECT user.username, user.password, user.user_role FROM user";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $username = $rows['username'];
            $password = $rows['password'];
            $user_role = $rows['user_role'];           
        ?>
        <tr id='tr_<?= $username ?>' class ='tablerow'>
            <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $username ?>'></td>
            <td><?= $username ?></td>
            <td><?= $password ?></td>
            <td><?= $user_role ?></td>
        <?php
        }
        echo "number of rows: " . $result->num_rows;
    }
    if ($func == "insert"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_role = $_POST['user_role'];           
        $employee_id =  $_POST['employee_id'];
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);


        $sql = "INSERT INTO user (username, password, user_role, employee_id) VALUES (?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssi', $username, $hash_pass, $user_role, $employee_id);
        // Close connection
        if ($stmt->execute()){
            echo "New record created successfully";
        } else {
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else if ($func == "update"){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_role = $_POST['user_role'];           
        $employee_id =  $_POST['employee_id'];

        $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    
        $sql = "UPDATE user SET password = ?, user_role = ?, employee_id = ? WHERE username = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssis', $hash_pass, $user_role, $employee_id, $username);
        // Close connection
        if ($stmt->execute()){
            echo $username. "'s record created successfully";
        } else { 
            
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else if ($func == "delete"){
        $username = $_POST['deleteID'];
        $total = count($username);
        $username = implode(',', $username);

        $sql = "DELETE FROM user WHERE username IN ('$username')";
        $result = mysqli_query($con, $sql);

		if ($result === true) {
			echo $total. " items successfully deleted";
		}else{
			echo "Data Not Saved". $con->error;;
		}

    }
     else if($func == "auto_input"){
        $edit_id = $_POST['edit_id'];
        $sql = "SELECT username, user_role, employee_id FROM user WHERE username = '$edit_id'";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);
    }
?>
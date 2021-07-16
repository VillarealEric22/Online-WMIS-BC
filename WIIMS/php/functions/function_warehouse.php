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
        $sql = "SELECT warehouses.warehouse_code, warehouses.warehouse_name, warehouses.warehouse_address, warehouses.warehouse_area, warehouses.username FROM warehouses";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $warehouse_code = $rows['warehouse_code'];
            $warehouse_name = $rows['warehouse_name'];
            $warehouse_address = $rows['warehouse_address'];
            $warehouse_area = $rows['warehouse_area'];           
            $username =  $rows['username'];
        ?>
        <tr id='tr_<?= $warehouse_code ?>' class ='tablerow'>
            <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $warehouse_code ?>'></td>
            <td><?= $warehouse_code ?></td>
            <td><?= $warehouse_name ?></td>
            <td><?= $warehouse_address ?></td>
            <td><?= $warehouse_area ?></td>
            <td><?= $username ?></td>
        <?php
        }
        echo "number of rows: " . $result->num_rows;
    }
    if ($func == "insert"){
        $warehouse_code = $_POST['warehouse_code'];
        $warehouse_name = $_POST['warehouse_name'];
        $warehouse_address = $_POST['warehouse_address'];
        $warehouse_area = $_POST['warehouse_area'];           
        $username =  $_POST['username'];

        $sql = "INSERT INTO warehouses (warehouse_code, warehouse_name, warehouse_address, warehouse_area, username) VALUES (?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssds', $warehouse_code, $warehouse_name, $warehouse_address, $warehouse_area, $username);
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
        $warehouse_code = $_POST['warehouse_code'];
        $warehouse_name = $_POST['warehouse_name'];
        $warehouse_address = $_POST['warehouse_address'];
        $warehouse_area = $_POST['warehouse_area'];           
        $username =  $_POST['username'];

        $sql = "UPDATE warehouses SET warehouse_name = ?, warehouse_address = ?, warehouse_area = ?, username = ? WHERE warehouse_code = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssdss', $warehouse_name, $warehouse_address, $warehouse_area, $username, $warehouse_code);
        // Close connection
        if ($stmt->execute()){
            echo $warehouse_code. "'s record created successfully";
        } else { 
            
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else if ($func == "delete"){
        $warehouse_code = $_POST['deleteID'];
        $total = count($warehouse_code);
        $warehouse_code = implode(',', $warehouse_code);

        $sql = "DELETE FROM warehouses WHERE warehouse_code IN ('$warehouse_code')";
        $result = mysqli_query($con, $sql);

		if ($result === true) {
			echo $total. " items successfully deleted";
		}else{
			echo "Data Not Saved". $con->error;
		}

    }
    else if($func == "auto_input"){
        $edit_id = $_POST['edit_id'];
        $sql = "SELECT warehouse_code, warehouse_name, warehouse_address, warehouse_area, username FROM warehouses WHERE warehouse_code = '$edit_id'";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);
    }
?>
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
        $sql = "SELECT supplier.supplier_id, supplier.supplier_name, supplier.s_address, supplier.contact_number FROM supplier";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $supplier_id = $rows['supplier_id'];
            $supplier_name = $rows['supplier_name'];
            $s_address = $rows['s_address'];           
            $contact_number =  $rows['contact_number'];
        ?>
        <tr id='tr_<?= $supplier_id ?>' class ='tablerow'>
            <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $supplier_id ?>'></td>
            <td><?= $supplier_id ?></td>
            <td><?= $supplier_name ?></td>
            <td><?= $s_address ?></td>
            <td><?= $contact_number ?></td>
        <?php
        }
        echo "number of rows: " . $result->num_rows;
    }
    else if ($func == "insert"){
        $supplier_id = $_POST['supplier_id'];
        $supplier_name = $_POST['supplier_name'];
        $s_address = $_POST['s_address'];           
        $contact_number =  $_POST['contact_number'];

        $sql = "INSERT INTO supplier (supplier_id, supplier_name, s_address, contact_number) VALUES (?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('isss', $supplier_id, $supplier_name, $s_address, $contact_number);
        // Close connection
        if($stmt->execute()){
            echo "New record created successfully";
        }
        else {
            echo "Insert Supplier ID.". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else if ($func == "update"){
        $supplier_id = $_POST['supplier_id'];
        $supplier_name = $_POST['supplier_name'];
        $s_address = $_POST['s_address'];           
        $contact_number =  $_POST['contact_number'];
    
        $sql = "UPDATE supplier SET supplier_name = ?, s_address = ?, contact_number = ? WHERE supplier_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssi', $supplier_name, $s_address, $contact_number, $supplier_id);
        // Close connection
        if ($stmt->execute()){
            echo $supplier_id. "'s record created successfully";
        } else { 
            
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else if ($func == "delete"){
        $supplier_id = $_POST['deleteID'];
        $total = count($supplier_id);
        $supplier_id = implode(',', $supplier_id);

        $sql = "DELETE FROM supplier WHERE supplier_id IN ($supplier_id)";
        $result = mysqli_query($con, $sql);

		if ($result === true) {
			echo $total. " items successfully deleted";
		}else{
			echo "Data Not Saved". $con->error;;
		}

    }
    else if($func == "auto_input"){
        $edit_id = $_POST['edit_id'];
        $sql = "SELECT supplier_id, supplier_name, s_address, contact_number FROM supplier WHERE supplier_id = $edit_id";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);
    }
?>
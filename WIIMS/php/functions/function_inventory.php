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
        $sql = "SELECT item_inventory.inventory_id, item_inventory.product_code, item_inventory.quantity, item_inventory.warehouse_code, item_inventory.date_created, item_inventory.stack_max_amt, item_inventory.amt_in_stack, item_inventory.critical_amt FROM item_inventory";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $inventory_id = $rows['inventory_id'];
            $product_code = $rows['product_code'];
            $quantity = $rows['quantity'];
            $warehouse_code= $rows['warehouse_code'];           
            $date_created =  $rows['date_created'];
            $stack_max_amt =  $rows['stack_max_amt'];
            $amt_in_stack =  $rows['amt_in_stack'];
            $critical_amt =  $rows['critical_amt'];
        ?>
        <tr id='tr_<?= $inventory_id ?>' class ='tablerow'>
            <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $inventory_id ?>'></td>
            <td><?= $inventory_id ?></td>
            <td><?= $product_code ?></td>
            <td><?= $quantity?></td>
            <td><?= $warehouse_code?></td>
            <td><?= $date_created ?></td>
            <td><?= $stack_max_amt ?></td>
            <td><?= $amt_in_stack ?></td>
            <td><?= $critical_amt ?></td>
        <?php
        }
        echo "number of rows: " . $result->num_rows;
    }
    if ($func == "insert"){
        $inventory_id = $_POST['inventory_id'];
        $product_code = $_POST['product_code'];
        $quantity = $_POST['quantity'];
        $warehouse_code = $_POST['warehouse_code'];
        $date_created = $_POST['date_created'];
        $i_date = date("Y-m-d H:i:s",strtotime($date_created));
        $stack_max_amt = $_POST['stack_max_amt'];
        $amt_in_stack = $_POST['amt_in_stack'];
        $critical_amt =$_POST['critical_amt'];

        $sql = "INSERT INTO item_inventory (inventory_id, product_code, quantity, warehouse_code, date_created, stack_max_amt, amt_in_stack, critical_amt) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('isissiii', $inventory_id, $product_code, $quantity, $warehouse_code, $i_date, $stack_max_amt, $amt_in_stack, $critical_amt);
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
        $inventory_id = $_POST['inventory_id'];
        $product_code = $_POST['product_code'];
        $quantity = $_POST['quantity'];
        $warehouse_code = $_POST['warehouse_code'];
        $date_created = $_POST['date_created'];
        $i_date = date("Y-m-d H:i:s",strtotime($date_created));
        $stack_max_amt = $_POST['stack_max_amt'];
        $amt_in_stack = $_POST['amt_in_stack'];
        $critical_amt = $_POST['critical_amt'];

        $sql = "UPDATE item_inventory SET product_code = ?, quantity  = ?, warehouse_code = ?, date_created= ?, stack_max_amt = ?, amt_in_stack, critical_amt = ? WHERE inventory_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sissiiii', $product_code, $quantity, $warehouse_code, $i_date, $stack_max_amt, $amt_in_stack, $critical_amt, $inventory_id);
        // Close connection
        if ($stmt->execute()){
            echo $inventory_id. "'s record created successfully";
        } else { 
            
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else if ($func == "delete"){
        $inventory_id = $_POST['deleteID'];
        $total = count($inventory_id);
        $inventory_id = implode(',', $inventory_id);

        $sql = "DELETE FROM item_inventory WHERE inventory_id IN ($inventory_id)";
        $result = mysqli_query($con, $sql);

		if ($result === true) {
			echo $total. " items successfully deleted";
		}else{
			echo "Data Not Saved". $con->error;
		}

    }
     else if($func == "auto_input"){
        $edit_id = $_POST['edit_id'];
        $sql = "SELECT inventory_id, product_code, quantity, warehouse_code, date_created, stack_max_amt, amt_in_stack, critical_amt FROM item_inventory WHERE inventory_id = $edit_id";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);
    }
    echo "Data Not Saved". $con->error;
?>
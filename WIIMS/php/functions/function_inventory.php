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
        $sql = "SELECT inventory_id, product_code, curr_quantity, bQty, pQty, warehouse_code, date_created, critical_amt FROM item_inventory ORDER BY date_created DESC";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $inventory_id = $rows['inventory_id'];
            $product_code = $rows['product_code'];
            $cquantity = $rows['curr_quantity'];
            $bq = $rows['bQty'];
            $pq = $rows['pQty'];
            $warehouse_code= $rows['warehouse_code'];           
            $date_created =  $rows['date_created'];
            $critical_amt =  $rows['critical_amt'];
        ?>
        <tr id='tr_<?= $inventory_id ?>' class ='tablerow'>
            <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $inventory_id ?>'></td>
            <td><?= $inventory_id ?></td>
            <td><?= $date_created ?></td>
            <td><?= $product_code ?></td>
            <td><?= $bq?></td>
            <td><?= $pq?></td>
            <td><?= $cquantity?></td>
            <td><?= $critical_amt ?></td>
            <td><?= $warehouse_code?></td>
        <?php
        }
        echo "number of rows: " . $result->num_rows;
    }
    else if ($func == "insert"){
        $inventory_id = $_POST['inventory_id'];
        $product_code = $_POST['product_code'];
        $bq = $_POST['bQty'];
        $cq = $bq;
        $pq = 0;
        $warehouse_code = $_POST['warehouse_code'];
        $date_created = $_POST['i_date'];
        $i_date = date("Y-m-d H:i:s",strtotime($date_created));
        $critical_amt =$_POST['critical_amt'];

        echo($inventory_id);

        $sql = "INSERT INTO item_inventory (inventory_id, product_code, curr_quantity, bQty, pQty, warehouse_code, date_created, critical_amt) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('isiiissi', $inventory_id, $product_code, $cq, $bq, $pq, $warehouse_code, $i_date,$critical_amt);
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
        $bq = $_POST['bQty'];
        $bq = $_POST['cQty'];
        $warehouse_code = $_POST['warehouse_code'];
        $date_created = $_POST['i_date'];
        $i_date = date("Y-m-d H:i:s",strtotime($date_created));
        $critical_amt = $_POST['critical_amt'];

        $sql = "UPDATE item_inventory SET product_code = ?, curr_quantity = ? bQty = ?, warehouse_code = ?, date_created= ?, critical_amt = ? WHERE inventory_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('siissii', $product_code, $cq, $bq, $warehouse_code, $i_date,  $critical_amt, $inventory_id);
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
        $sql = "SELECT inventory_id, product_code, curr_quantity, bQty, pQty, warehouse_code, date_created, critical_amt FROM item_inventory WHERE inventory_id = $edit_id";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);
    }
?>
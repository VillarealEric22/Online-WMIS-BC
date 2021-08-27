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
        $sql = "SELECT item_returns.return_id, item_returns.transaction_no, products.product_name, item_returns.quantity, item_returns.item_price, item_returns.total_price, item_returns.return_type, item_returns.return_date FROM item_returns INNER JOIN products USING (product_code)";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $return_id = $rows['return_id'];
            $transaction_no= $rows['transaction_no'];
            $product_name = $rows['product_name'];
            $quantity = $rows['quantity'];           
            $item_price =  $rows['item_price'];
            $total_price =  $rows['total_price'];
            $return_type =  $rows['return_type'];
            $return_date =  $rows['return_date'];
        ?>
        <tr id='tr_<?= $return_id ?>' class ='tablerow'>
            <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $return_id  ?>'></td>
            <td><?= $return_id  ?></td>
            <td><?= $transaction_no ?></td>
            <td><?= $product_name  ?></td>
            <td><?= $quantity  ?></td>
            <td><?= $item_price?></td>
            <td><?= $total_price ?></td>
            <td><?= $return_type ?></td>
            <td><?= $return_date ?></td>
        <?php
        }
        echo "number of rows: " . $result->num_rows;
    }
    if ($func == "insert"){
        $return_id = $_POST['return_id'];
        $transaction_no = $_POST['transaction_no'];
        $product_code= $_POST['product_code'];
        $quantity = $_POST['quantity'];
        $item_price = $_POST['item_price'];
        $total_price = $_POST['total_price'];
        $return_type = $_POST['return_type'];
        $return_date = $_POST['r_date'];
        $r_date = date("Y-m-d H:i:s",strtotime($return_date));
        
        $sql = "INSERT INTO item_returns (return_id, transaction_no, product_code, quantity , item_price, total_price, return_type, return_date) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('iisiddss', $return_id, $transaction_no, $product_code, $quantity, $item_price, $total_price, $return_type, $return_date);
        // Close connection
        if ($stmt->execute()){
            echo "New record created successfully";
        } else {
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else if ($func == "delete"){
        $return_id = $_POST['deleteID'];
        $total = count($return_id);
        $return_id = implode(',', $return_id);

        $sql = "DELETE FROM item_returns WHERE return_id IN ($return_id)";
        $result = mysqli_query($con, $sql);

		if ($result === true) {
			echo $total. " items successfully deleted";
		}else{
			echo "Data Not Saved". $con->error;;
		}

    }
     else if($func == "auto_input"){
        $edit_id = $_POST['edit_id'];
        $sql = "SELECT return_id, transaction_no, product_code, quantity, item_price, total_price, return_type, return_date FROM item_returns WHERE retun_id = $edit_id";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);
    }
?>
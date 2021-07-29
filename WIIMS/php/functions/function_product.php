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
        $sql = "SELECT products.product_code, products.product_name, products.manufacturer, products.product_type, products.capacity, products.color, products.item_price FROM products";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $product_code = $rows['product_code'];
            $product_name = $rows['product_name'];
            $manufacturer = $rows['manufacturer'];
            $product_type =  $rows['product_type'];  
            $capacity = $rows['capacity'];
            $color =  $rows['color'];
            $item_price =  $rows['item_price'];
        ?>
        <tr id='tr_<?= $product_code ?>' class ='tablerow'>
            <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $product_code ?>'></td>
            <td><?= $product_code ?></td>
            <td><?= $product_name ?></td>
            <td><?= $manufacturer ?></td>
            <td><?= $product_type ?></td>
            <td><?= $capacity ?></td>
            <td><?= $color?></td>
            <td><?=$item_price ?></td>
        <?php
        }
        echo "number of rows: " . $result->num_rows;
    }
    if ($func == "insert"){
        $product_code = $_POST['product_code'];
        $product_name = $_POST['product_name'];
        $manufacturer = $_POST['manufacturer'];
        $capacity= $_POST['capacity'];
        $product_type = $_POST['product_type'];
        $color = $_POST['color'];
        $lenght = $_POST['lenght'];
        $width = $_POST['width'];
        $height = $_POST['height'];
        $item_price  = $_POST['item_price'];
        $supplier_id = $_POST['supplier_id'];

        $sql = "INSERT INTO products (product_code, product_name, manufacturer, capacity, product_type, color, lenght, width, height, item_price, supplier_id) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssssssiiidi', $product_code, $product_name, $manufacturer, $capacity, $product_type, $color, $lenght, $width, $height, $item_price, $supplier_id);
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
        $product_code = $_POST['product_code'];
        $product_name = $_POST['product_name'];
        $manufacturer = $_POST['manufacturer'];
        $capacity= $_POST['capacity'];
        $product_type = $_POST['product_type'];
        $color = $_POST['color'];
        $lenght = $_POST['lenght'];
        $width = $_POST['width'];
        $height = $_POST['height'];
        $item_price  = $_POST['item_price'];
        $supplier_id = $_POST['supplier_id'];

        $sql = "UPDATE products SET product_name = ?, manufacturer = ?, capacity = ?, product_type = ?, color = ?, lenght = ?, width = ?, height = ?, item_price = ?, supplier_id = ? WHERE product_code = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssssiiidis', $product_name, $manufacturer, $capacity, $product_type, $color, $lenght, $width, $height, $item_price, $supplier_id, $product_code);
        // Close connection
        if ($stmt->execute()){
            echo $product_code. "'s record updated successfully";
        } else { 
            
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else if ($func == "delete"){
        $product_code = $_POST['deleteID'];
        $total = count($product_code);
        $product_code= implode(',', $product_code);

        $sql = "DELETE FROM products WHERE product_code IN ('$product_code')";
        $result = mysqli_query($con, $sql);

		if ($result === true) {
			echo $total. " items successfully deleted";
		}else{
			echo "Data Not Saved". $con->error;;
		}

    }
     else if($func == "auto_input"){
        $edit_id = $_POST['edit_id'];
        $sql = "SELECT product_code, product_name, manufacturer, capacity, product_type, color, lenght, width, height, item_price, supplier_id FROM products WHERE product_code = '$edit_id'";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);
    }
?>
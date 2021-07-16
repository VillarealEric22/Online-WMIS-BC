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
        $sql = "SELECT customer.customer_id, customer.firstname, customer.lastname, customer.c_address, customer.contact_number FROM customer";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $customer_id = $rows['customer_id'];
            $firstname = $rows['firstname'];
            $lastname = $rows['lastname'];
            $c_address = $rows['c_address'];           
            $contact_number =  $rows['contact_number'];
        ?>
        <tr id='tr_<?= $customer_id ?>' class ='tablerow'>
            <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $customer_id ?>'></td>
            <td><?= $customer_id ?></td>
            <td><?= $firstname ?></td>
            <td><?= $lastname ?></td>
            <td><?= $c_address ?></td>
            <td><?= $contact_number ?></td>
        <?php
        }
        echo "number of rows: " . $result->num_rows;
    }
    if ($func == "insert"){
        $customer_id = $_POST['customer_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $c_address = $_POST['c_address'];
        $contact_number = $_POST['contact_number'];

        $sql = "INSERT INTO customer (customer_id, firstname, lastname, c_address, contact_number) VALUES (?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('issss', $customer_id, $firstname, $lastname, $c_address, $contact_number);
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
        $customer_id = $_POST['customer_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $c_address = $_POST['c_address'];
        $contact_number = $_POST['contact_number'];
    
        $sql = "UPDATE customer SET firstname = ?, lastname = ?, c_address = ?, contact_number = ? WHERE customer_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssssi', $firstname, $lastname , $c_address, $contact_number, $customer_id);
        // Close connection
        if ($stmt->execute()){
            echo $customer_id. "'s record updated successfully";
        } else { 
            
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else if ($func == "delete"){
        $customer_id = $_POST['deleteID'];
        $total = count($customer_id);
        $customer_id = implode(',', $customer_id);

        $sql = "DELETE FROM customer WHERE customer_id IN ($customer_id)";
        $result = mysqli_query($con, $sql);

		if ($result === true) {
			echo $total. " items successfully deleted";
		}else{
			echo "Data Not Saved". $con->error;;
		}

    }
     else if($func == "auto_input"){
        $edit_id = $_POST['edit_id'];
        $sql = "SELECT customer_id, firstname, lastname, c_address, contact_number FROM customer WHERE customer_id = $edit_id";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);
    }
?>
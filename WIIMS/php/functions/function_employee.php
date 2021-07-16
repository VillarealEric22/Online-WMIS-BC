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
        $sql = "SELECT employees.employee_id, employees.lastname, employees.firstname, employees.middlename, employees.sex, employees.emp_address, employees.contact_number, employees.birthday FROM employees";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $employee_id = $rows['employee_id'];
            $lastname = $rows['lastname'];
            $firstname = $rows['firstname'];
            $middlename = $rows['middlename'];           
            $sex =  $rows['sex'];
            $emp_address =  $rows['emp_address'];
            $contact_number =  $rows['contact_number'];
            $birthday =  $rows['birthday'];
        ?>
        <tr id='tr_<?= $username ?>' class ='tablerow'>
            <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $employee_id ?>'></td>
            <td><?= $employee_id ?></td>
            <td><?= $lastname ?></td>
            <td><?= $firstname ?></td>
            <td><?= $middlename ?></td>
            <td><?= $sex ?></td>
            <td><?= $emp_address ?></td>
            <td><?= $contact_number ?></td>
            <td><?= $birthday ?></td>
        </tr>
        <?php
        }
        echo "number of rows: " . $result->num_rows;
    }
    if ($func == "insert"){
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
    else if ($func == "update"){
        $e_id = $_POST['e_id'];
        $e_ln = $_POST['e_ln'];
        $e_fn = $_POST['e_fn'];
        $e_mi = $_POST['e_mi'];
        $e_add = $_POST['e_add'];
        $e_cnum = $_POST['e_cnum'];
        $e_sx = $_POST['e_sx'];
        $input_date=$_POST['e_bday'];
        $e_bday = date("Y-m-d H:i:s",strtotime($input_date));

        $sql = "UPDATE employees SET lastname = ?, firstname = ?, middlename = ?, emp_address = ?, contact_number = ?, sex = ?, birthday = ? WHERE employee_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssssssi', $e_ln, $e_fn, $e_mi, $e_add, $e_cnum, $e_sx, $e_bday, $e_id);
        // Close connection
        if ($stmt->execute()){
            echo $e_id. "'s record created successfully";
        } else { 
            
            echo "Data Not Saved". $con->error;
        }
        $stmt->close();
        $con->close();
    }
    else if ($func == "delete"){
        $emp_id = $_POST['deleteID'];
        $total = count($emp_id);
        $emp_id = implode(',', $emp_id);

        $sql = "DELETE FROM employees WHERE employee_id IN ($emp_id)";
        $result = mysqli_query($con, $sql);

		if ($result === true) {
			echo $total. " items successfully deleted";
		}else{
			echo "Data Not Saved". $con->error;;
		}

    }
     else if($func == "auto_input"){
        $edit_id = $_POST['edit_id'];
        $sql = "SELECT employee_id, lastname, firstname, middlename, sex, emp_address, contact_number, birthday FROM employees WHERE employee_id = $edit_id";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);
    }
?>
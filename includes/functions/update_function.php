<?php 
include('../db.php');

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = '../../Images/products/'; // upload directory

$func = $_POST['func'];

if ($func == "product"){
    $product_code = $_POST['product_code'];
    $product_name = $_POST['product_name'];
    $manufacturer = $_POST['manufacturer'];
    $product_type = $_POST['product_type'];
    $color = $_POST['color'];
    $item_price = $_POST['item_price'];
    $critical = $_POST['critical'];
    $reorder = $_POST['reorder'];
    $ro_categ = $_POST['ro_categ'];
    $desc = $_POST['desc'];
    $supplier_id = $_POST['supplier_id'];
    $wty = $_POST['wty'];
    
    $sql = "UPDATE `products` SET `product_name`=?,`manufacturer`=?,`product_type`=?,`color`=?,`item_price`=?,`critical_amt`=?,`rop_min`=?,`ro_categ`=?, `warranty_code`=?, `description`=?,`supplier_id`= ? WHERE product_code = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sssssdisisis', $product_name, $manufacturer, $product_type, $color,  $item_price, $critical, $reorder, $ro_categ, $wty, $desc, $supplier_id, $product_code);
    // Close connection
    if ($stmt->execute()){
        echo $product_code. "'s record updated successfully";
        if(isset($_FILES['file']['name'])){
            $img = $_FILES['file']['name'];
            $tmp = $_FILES['file']['tmp_name'];
            // get uploaded file's extension
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            // can upload same image using rand function
            $final_image = rand(1000,1000000).$img;
            // check's valid format
            if(in_array($ext, $valid_extensions)) { 
                $path = $path.strtolower($final_image); 
                if(move_uploaded_file($tmp,$path)) {
                    echo "Image Uploaded";
                    $pathclean =  str_replace("../../", "", $path);
                    $insert = $con->query("UPDATE products SET `product_img` = '$pathclean' WHERE product_code = '$product_code'");
                }
            }
            else {
                echo 'invalid file';
            }
        }
        else{
            
        }
        
    } else { 
        echo "Data Not Saved". $con->error;
    }
    $stmt->close();
    $con->close();
}
else if ($func == "customer"){
    $customer_id = $_POST['id'];
    $name = $_POST['name'];
    $c_address = $_POST['c_address'];
    $contact_number = $_POST['contact_number'];

    $sql = "UPDATE customer SET c_name = ?, c_address = ?, contact_number = ? WHERE customer_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sssi', $name, $c_address, $contact_number, $customer_id);
    // Close connection
    if ($stmt->execute()){
        echo " record updated successfully";
    } else { 
        
        echo "Data Not Saved". $con->error;
    }
    $stmt->close();
    $con->close();
}
else if($func == "supplier"){
    $supplier_id = $_POST['id'];
    $supplier_name = $_POST['name'];
    $s_address = $_POST['s_address'];           
    $contact_number =  $_POST['contact_number'];

    $sql = "UPDATE supplier SET supplier_name = ?, supplier_address = ?, contact_number = ? WHERE supplier_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sssi', $supplier_name, $s_address, $contact_number, $supplier_id);
    // Close connection
    if (!empty($stmt->execute())){
        echo " record updated successfully";
        }
    else { 
        echo "Data Not Saved". $con->error;
    }
    $stmt->close();
    $con->close();
}
else if($func == "transfer"){
    $transfer_id = $_POST['id'];

    $sql = "SELECT `product_code`, `quantity`, `warehouse_source` FROM `transfer_items` INNER JOIN `transfer` USING (`transfer_id`) WHERE `transfer_id` = '$transfer_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $pcode = $rows['product_code'];
        $request_qty = $rows['quantity'];
        $wh_code = $rows['warehouse_source'];

        $quer = "SELECT `product_code`,`quantity` FROM whse_items WHERE product_code = '$pcode' AND warehouse_code = '$wh_code'";
        $res = mysqli_query($con, $quer);
        $count = 0;
        while($crow = mysqli_fetch_array($res)){
            $qty_avl = $crow['quantity'];
            if($qty_avl >= $request_qty){

            }
            else{
                $count++;
            }
            if($count == 0){
                $sqlUp = "UPDATE `transfer` SET `status` = 'approved' WHERE transfer_id = '$transfer_id'";
                $result2 = mysqli_query($con, $sqlUp);
                if ($count == 0) {
                    $sqlUp1 = "UPDATE `whse_items` SET `quantity` = (`quantity` - $request_qty), `committed` = (`committed` + $request_qty) WHERE product_code = '$pcode' AND warehouse_code = '$wh_code'";
                    $result3 = mysqli_query($con, $sqlUp1);
                    if ($result3 === true) {
                        
                    }
                }
                else{
                    echo "Data Not Saved". $con->error;;
                }
                
            }
            else{
                
            }
        }
        if($count == 0){
            echo json_encode("Request approved, stocks updated");
        }
        else{
            echo json_encode('cannot update');
        }
    }
}
else if($func == "transfer-receive"){
    $inventory_id = $_POST['transfer_id'];
    $warehouse_source = $_POST['warehouse_source'];
    $warehouse_dest = $_POST['warehouse_dest'];
    $itemsTotal = $_POST['itemsTotal'];
    $input_date = $_POST['date_created'];
    $date_created = date("Y-m-d H:i:s",strtotime($input_date));
    $remarks = $_POST['remarks'];

    $product_code = $_POST['product_code'];
    $quantity = $_POST['quantity'];
    $tNumber = $_POST['tNumber'];

    $mi = new MultipleIterator();

    $mi->attachIterator(new ArrayIterator($tNumber));
    $mi->attachIterator(new ArrayIterator($product_code));
    $mi->attachIterator(new ArrayIterator($quantity));


    $sql2 = "UPDATE whse_items SET `committed` = (`committed` - ?) WHERE `product_code` = ? AND `warehouse_code` = ?";
    $stmt2 = $con->prepare($sql2);
    foreach ($mi as $value ) {
        list($tNumber, $product_code, $quantity)  = $value;
        $stmt2->bind_param('iss', $quantity,  $product_code, $warehouse_source);
        $stmt2->execute();
    }
    $sql3 = "INSERT INTO whse_items (product_code, quantity, warehouse_code) VALUES (?,?,?) ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)";
    $stmt3 = $con->prepare($sql3);
    foreach ($mi as $value ) {
        list($tNumber, $product_code, $quantity) = $value;
        $stmt3->bind_param('sis', $product_code, $quantity, $warehouse_dest);
        $stmt3->execute();
    }
    echo "updated stocks";

    $sql4 = "UPDATE transfer_items SET remain_qty = (remain_qty - ?) WHERE transfer_id = ? AND product_code = ?";
    $stmt4 = $con->prepare($sql4);
    foreach ($mi as $value) {
        list($tNumber, $product_code, $quantity) = $value;
        $stmt4->bind_param('iis', $quantity, $tNumber, $product_code);
        $stmt4->execute();
    }
    $sql5 = "UPDATE `transfer` AS a INNER JOIN (SELECT SUM(remain_qty) AS remain, transfer_id FROM transfer_items GROUP BY transfer_id) AS b USING (transfer_id) SET a.status= (CASE WHEN (b.remain > 0) THEN 'incomplete' ELSE 'completed' END) WHERE a.transfer_id = ? AND b.transfer_id = ?";

    $stmt5 = $con->prepare($sql5);
    $stmt5->bind_param('ii', $inventory_id, $inventory_id);
    if ($stmt5->execute()){
        echo "Order Status updated";
    }
    else{
        echo "Data Not Saved". $con->error;
    }
    echo $con->error;
    $con->close();
}
else if($func == "transfer-cancel"){
    $transfer_id = $_POST['id'];

    $sql = "SELECT `product_code`, `quantity`, `warehouse_source` FROM `transfer_items` INNER JOIN `transfer` USING (`transfer_id`) WHERE `transfer_id` = '$transfer_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $pcode = $rows['product_code'];
        $request_qty = $rows['quantity'];
        $wh_code = $rows['warehouse_source'];
        
        $sqlUp = "UPDATE `transfer` SET `status` = 'cancelled' WHERE transfer_id = '$transfer_id'";
            $result2 = mysqli_query($con, $sqlUp);
            if ($result2 === true) {
                $sqlUp1 = "UPDATE `whse_items` SET `quantity` = (`quantity` + $request_qty), `committed` = (`committed` - $request_qty) WHERE product_code = '$pcode' AND warehouse_code = '$wh_code'";
                $result3 = mysqli_query($con, $sqlUp1);
                if ($result3 === true) {
                    echo "Request canceled, stocks updated";
                }
            }else{
                echo "Data Not Saved". $con->error;;
            }
        }
}
else if($func == "user"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_role = $_POST['user_role'];
    $employee_id = $_POST['employee_id'];         
    $options = [
        'cost' => 11,
    ];
    $hash_pass = password_hash($password, PASSWORD_BCRYPT, $options);

    $sql = "UPDATE user SET password = ?, user_role = ? WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sss', $hash_pass, $user_role, $username);
    // Close connection
    if ($stmt->execute()){
        echo $username. "'s record created successfully";
    } else { 
        echo "Data Not Saved". $con->error;
    }
    $stmt->close();
    $con->close();
}
else if($func == "uacct"){
    $username = $_POST['username'];
    $password = $_POST['password'];       
    $options = [
        'cost' => 11,
    ];
    $hash_pass = password_hash($password, PASSWORD_BCRYPT, $options);

    $sql = "UPDATE user SET password = ? WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ss', $hash_pass, $username);
    // Close connection
    if ($stmt->execute()){
        echo $username. "'s record created successfully";
    } else { 
        echo "Data Not Saved". $con->error;
    }
    $stmt->close();
    $con->close();
}
else if($func == "employee"){
    $e_id = $_POST['e_id'];
    $e_ln = $_POST['e_ln'];
    $e_fn = $_POST['e_fn'];
    $e_mi = $_POST['e_mi'];
    $e_add = $_POST['e_add'];
    $e_cnum = $_POST['e_cnum'];
    $e_sx = $_POST['e_sx'];
    $input_date=$_POST['e_bday'];
    $e_bday = date("Y-m-d H:i:s",strtotime($input_date));

    $sql = "UPDATE `employee` SET `firstname`=?,`lastname`= ?,`middlename`= ?,`emp_address`= ?,`contact_number`=? ,`sex`= ?,`birthday`= ? WHERE `employee_id`= ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sssssssi', $e_ln, $e_fn, $e_mi, $e_add, $e_cnum, $e_sx, $e_bday, $e_id);
    // Close connection
    if ($stmt->execute()){
        echo $e_id. "'s record updated successfully";
    } else { 
        echo "Data Not Saved". $con->error;
    }
    $stmt->close();
    $con->close();
}
else if($func == "warehouse"){

    $warehouse_code = $_POST['warehouse_code'];
    $warehouse_name = $_POST['warehouse_name'];
    $warehouse_address = $_POST['warehouse_address'];
    $warehouse_contact = $_POST['warehouse_contact'];           
    $username =  $_POST['username'];

    $sql = "UPDATE warehouses SET warehouse_name = ?, warehouse_address = ?, contact_no = ?, employee_id = ? WHERE warehouse_code = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sssss', $warehouse_name, $warehouse_address, $warehouse_contact, $username, $warehouse_code);
    // Close connection
    if ($stmt->execute()){
        echo $warehouse_code. "'s record created successfully";
    } else { 
        
        echo "Data Not Saved". $con->error;
    }
    $stmt->close();
    $con->close();
}
else if($func == "categ"){
    $id = $_POST['id'];
    $product_type = $_POST['ptype'];
    $sql = "UPDATE product_category SET product_type = ? WHERE id = ?";
    $stmtIn = $con->prepare($sql);
    $stmtIn->bind_param('ss', $product_type, $id);
    if ($stmtIn->execute()){
        echo $product_type. "updated successfully";
    } else {
        echo "Data Not Saved". $con->error;
    }
    $stmtIn->close();
    $con->close();
}
else if($func == "warranty"){
    $id = $_POST['id'];
    $wcode = $_POST['wcode'];
    $replacement = $_POST['tp1'];
    $duration1 = $_POST['dur1'];
    $S_warranty = $_POST['tp2'];
    $duration2 = $_POST['dur2'];
    $M_warranty = $_POST['tp3'];
    $duration3 = $_POST['dur3'];

    $sql = "UPDATE warranty SET `rep_dur` = ?, `tp1` = ?, `s_warranty` = ?, `tp2` = ?, `sp_warranty` = ?, `tp3` = ?, warranty_code = ? WHERE id = ?";
    $stmtIn = $con->prepare($sql);
    $stmtIn->bind_param('isisissi',  $duration1, $replacement, $duration2, $S_warranty, $duration3, $M_warranty, $wcode, $id);

    if ($stmtIn->execute()){
        echo "warranty code updated successfully";
    } else {
        echo "Data Not Saved". $con->error;
    }
    $stmtIn->close();
    $con->close();
}
?>

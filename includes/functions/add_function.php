<?php 
include('../db.php');
    $stmt = $con->prepare('SELECT employee_id FROM user WHERE username = ?');
    //diplay onto header
    $stmt->bind_param('s', $_SESSION['username']);
    $stmt->execute();
    $stmt->bind_result($e_id);
    $stmt->fetch();
    $stmt->close();

$func = $_POST['func'];

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = '../../Images/products/'; // upload directory

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

    $sql = "INSERT INTO `products`(`product_code`, `product_name`, `manufacturer`, `product_type`, `color`, `item_price`, `critical_amt`, `rop_min`, `ro_categ`, `description`, `supplier_id`, `warranty_code`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ssssssdissis', $product_code, $product_name, $manufacturer, $product_type, $color,  $item_price, $critical, $reorder, $ro_categ, $desc, $supplier_id, $wty);
    // Close connection
    if ($stmt->execute()){
        echo "New record created successfully";
        if(isset()){
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
    $name = $_POST['name'];
    $c_address = $_POST['c_address'];
    $contact_number = $_POST['contact_number'];

    $sql = "INSERT INTO customer (c_name, c_address, contact_number) VALUES (?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sss',  $name, $c_address, $contact_number);
    // Close connection
    if ($stmt->execute()){
        echo "New record created successfully";
    } else {
        echo "Data Not Saved". $con->error;
    }
    $stmt->close();
    $con->close();
}
else if($func == "supplier"){
    $supplier_name = $_POST['name'];
    $s_address = $_POST['s_address'];           
    $contact_number =  $_POST['contact_number'];

    $sql = "INSERT INTO supplier (supplier_name, supplier_address, contact_number) VALUES (?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sss', $supplier_name, $s_address, $contact_number);
    // Close connection
    if($stmt->execute()){
        echo "New record created successfully";
    }
    else {
        echo "Data Not Saved". $con->error;
    }
    $stmt->close();
    $con->close();
}
else if($func == "sales"){
    $transaction_no = $_POST['transaction_no'];
    $customer_id = $_POST['customer_ID'];
    $itemsTotal = $_POST['itemsTotal'];
    $total_price = $_POST['total_price'];
    $input_date = $_POST['transaction_date'];
    $transaction_date = date("Y-m-d H:i:s",strtotime($input_date));
    $remarks = $_POST['remarks'];

    $product_code = $_POST['product_code'];
    $quantity = $_POST['quantity'];
    $item_price = $_POST['item_price'];
    $tot_price = $_POST['totprice'];
    $tNumber = $_POST['tNumber'];
    $wh_code = $_POST['wh_code'];
    
    $mi = new MultipleIterator();

    $mi->attachIterator(new ArrayIterator($tNumber));
    $mi->attachIterator(new ArrayIterator($product_code));
    $mi->attachIterator(new ArrayIterator($quantity));
    $mi->attachIterator(new ArrayIterator($item_price));
    $mi->attachIterator(new ArrayIterator($tot_price));
    $mi->attachIterator(new ArrayIterator($wh_code));
    //If(quantity>whseItems stock){ reject sale, return message not enought items for the sale request}
    $sql = "INSERT INTO sales_transaction (`transaction_no`, `customer_id`, `itemsTotal`, `total_price`, `transaction_date`, `employee_id`, `remarks`) VALUES (?,?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iiidsis', $transaction_no, $customer_id, $itemsTotal, $total_price, $transaction_date, $e_id, $remarks);

    if ($stmt->execute()){
    $sql2 = "INSERT INTO cart_items (transaction_no, product_code, quantity, price_ea, price_tot) VALUES (?,?,?,?,?)";
    $stmt2 = $con->prepare($sql2);
        foreach ($mi as $value) {
            list($tNumber, $product_code, $quantity, $item_price, $tot_price,  $wh_code) = $value;
            $stmt2->bind_param('isidd', $tNumber, $product_code, $quantity, $item_price, $tot_price);
            $stmt2->execute();
        }
    $sql3= "UPDATE whse_items SET quantity = (quantity - ?) WHERE product_code = ? AND warehouse_code = ?";
    $stmt3 = $con->prepare($sql3);
        foreach ($mi as $value1) {
            list($tNumber, $product_code, $quantity, $item_price, $tot_price) = $value1;
            $stmt3->bind_param('iss', $quantity, $product_code, $wh_code);
            $stmt3->execute();
        }
        echo "Successfully created sales record";
    }
    else{
        echo "Data Not Saved". $con->error;
    }
    $stmt->close();
    $con->close();
}
else if($func == "orders"){
    $purchase_order_id = $_POST['purchase_order_id'];
    $supplier_id = $_POST['supplier_ID'];
    $itemsTotal = $_POST['itemsTotal'];
    $total_price = $_POST['total_price'];
    $input_date = $_POST['order_date'];
    $order_date = date("Y-m-d H:i:s",strtotime($input_date));
    $status = $_POST['status'];
    $remarks = $_POST['desc'];

    $product_code = $_POST['product_code'];
    $quantity = $_POST['quantity'];
    $item_price = $_POST['price_ea'];
    $tNumber = $_POST['tNumber'];
    $totPrice = $_POST['totPrice'];
    $mi = new MultipleIterator();

    $mi->attachIterator(new ArrayIterator($tNumber));
    $mi->attachIterator(new ArrayIterator($product_code));
    $mi->attachIterator(new ArrayIterator($quantity));
    $mi->attachIterator(new ArrayIterator($item_price));
    $mi->attachIterator(new ArrayIterator($totPrice));
    
    $sql = "INSERT INTO `purchase_order`(`purchase_order_id`, `supplier_id`, `items_total`, `total_price`, `order_date`, `status`, `remarks`) VALUES (?,?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iiidsss', $purchase_order_id, $supplier_id, $itemsTotal, $total_price, $order_date, $status, $remarks);

    if ($stmt->execute()){
    $sql2 = "INSERT INTO `item_orders`(`purchase_order_id`, `product_code`, `quantity`, `remain_qty`, `price`, `price_tot`) VALUES (?,?,?,?,?,?)";
    $stmt2 = $con->prepare($sql2);
      foreach ($mi as $value ) {
        list($tNumber, $product_code, $quantity, $item_price, $totPrice) = $value;
        $stmt2->bind_param('isiidd', $tNumber, $product_code, $quantity, $quantity, $item_price, $totPrice);
        $stmt2->execute();
      }
      echo "Successfully Created New Order Record";
    }
   else{
      echo "Data Not Saved". $con->error;
   }
  $stmt->close();
  $con->close();
}
else if($func == "inventory"){
    $inventory_id = $_POST['inventory_id'];
    $purchase_order_id = $_POST['purchaseorder'];
    $warehouse_code = $_POST['warehouse_code'];
    $itemsTotal = $_POST['itemsTotal'];
    $total_price = $_POST['total_price'];
    $input_date = $_POST['transaction_date'];
    $date_created = date("Y-m-d H:i:s",strtotime($input_date));
    $remarks = $_POST['desc'];

    $product_code = $_POST['product_code'];
    $quantity = $_POST['quantity'];
    $item_price = $_POST['price_ea'];
    $tNumber = $_POST['tNumber'];
    $totPrice = $_POST['totPrice'];
    $whseCode = $_POST['whseCode'];
    $order_id = $_POST['order_id'];

    $mi = new MultipleIterator();

    $mi->attachIterator(new ArrayIterator($tNumber));
    $mi->attachIterator(new ArrayIterator($product_code));
    $mi->attachIterator(new ArrayIterator($quantity));
    $mi->attachIterator(new ArrayIterator($item_price));
    $mi->attachIterator(new ArrayIterator($totPrice));
    $mi->attachIterator(new ArrayIterator($whseCode));
    $mi->attachIterator(new ArrayIterator($order_id));

    $sql = "INSERT INTO inventory (inventory_id, purchase_order_id, items_total, totalVal, date_created, warehouse_code, remarks) VALUES (?,?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iiidsss', $inventory_id, $purchase_order_id, $itemsTotal, $total_price, $date_created, $warehouse_code, $remarks);

    if ($stmt->execute()){
    $sql2 = "INSERT INTO inventory_items (inventory_id, product_code, quantity, unit_price, total_price) VALUES (?,?,?,?,?)";
    $stmt2 = $con->prepare($sql2);
        foreach ($mi as $value ) {
        list($tNumber, $product_code, $quantity, $item_price, $totPrice, $whseCode, $order_id) = $value;
        $stmt2->bind_param('isidd', $tNumber, $product_code, $quantity, $item_price, $totPrice);
        $stmt2->execute();
        }
        echo "Data Saved ";
        $sql3 = "INSERT INTO whse_items (product_code, quantity, warehouse_code) VALUES (?,?,?) ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)";
        $stmt3 = $con->prepare($sql3);
        foreach ($mi as $value ) {
        list($tNumber, $product_code, $quantity, $item_price, $totPrice, $whseCode, $order_id) = $value;
        $stmt3->bind_param('sis', $product_code, $quantity, $whseCode);
        $stmt3->execute();
        }
        echo "Stocks has been updated";

        $sql4 = "UPDATE item_orders SET remain_qty = (remain_qty - ?) WHERE purchase_order_id = ? AND product_code = ?";
        $stmt4 = $con->prepare($sql4);
        foreach ($mi as $value) {
        list($tNumber, $product_code, $quantity, $item_price, $totPrice, $whseCode, $order_id) = $value;
        $stmt4->bind_param('iis', $quantity, $order_id, $product_code);
        $stmt4->execute();
        }
        $sql5 = "UPDATE purchase_order AS a INNER JOIN (SELECT SUM(remain_qty) AS remain, purchase_order_id FROM item_orders GROUP BY purchase_order_id) AS b USING (purchase_order_id) SET a.status= (CASE WHEN (b.remain > 0) THEN 'incomplete' ELSE 'completed' END) WHERE a.purchase_order_id = ? AND b.purchase_order_id = ?";
        $stmt5 = $con->prepare($sql5);
        $stmt5->bind_param('ii', $purchase_order_id, $purchase_order_id);
        if ($stmt5->execute()){
        echo "Order Status updated";
        }
    }
    else{
        echo "Data Not Saved". $con->error;
    }
    echo $con->error;
    $stmt->close();
    $con->close();
}
else if($func == "transfer"){
    $inventory_id = $_POST['transfer_id'];
    $warehouse_source = $_POST['warehouse_source'];
    $warehouse_dest = $_POST['warehouse_dest'];
    $itemsTotal = $_POST['itemsTotal'];
    $input_date = $_POST['date_created'];
    $date_created = date("Y-m-d H:i:s",strtotime($input_date));
    $status = 'pending';
    $remarks = $_POST['remarks'];

    $product_code = $_POST['product_code'];
    $quantity = $_POST['quantity'];
    $tNumber = $_POST['tNumber'];

    $mi = new MultipleIterator();

    $mi->attachIterator(new ArrayIterator($tNumber));
    $mi->attachIterator(new ArrayIterator($product_code));
    $mi->attachIterator(new ArrayIterator($quantity));

    $sql = "INSERT INTO transfer (`transfer_id`, `warehouse_source`, `warehouse_dest`, `items_total`, `request_date`, `author`, `status`, `remarks`) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('issisiss', $inventory_id, $warehouse_source, $warehouse_dest, $itemsTotal, $date_created, $e_id, $status, $remarks);

    if ($stmt->execute()){
    $sql2 = "INSERT INTO transfer_items (transfer_id, product_code, quantity ,remain_qty) VALUES (?,?,?,?)";
    $stmt2 = $con->prepare($sql2);
        foreach ($mi as $value ) {
        list($tNumber, $product_code, $quantity) = $value;
        $stmt2->bind_param('isii', $tNumber, $product_code, $quantity, $quantity);
        $stmt2->execute();
        }
        echo "Data Saved ";
    }
    else{
        echo "Data Not Saved". $con->error;
    }
    echo $con->error;
    $stmt->close();
    $con->close();
}
else if($func == "return"){
    $return_id = $_POST['return_id'];
    $transaction_no = $_POST['transaction_no'];
    $total_price = $_POST['total_price'];
    $itemsTotal = $_POST['itemsTotal'];
    $return_date = $_POST['r_date'];
    $r_date = date("Y-m-d H:i:s",strtotime($return_date));
    $remarks = $_POST['remarks'];

    $retType = $_POST['retType'];

    $rID = $_POST['arrNo'];
    $product_code= $_POST['product_code'];
    $quantity = $_POST['quantity'];
    $item_price = $_POST['item_price'];
    $tot_price = $_POST['totPrice'];
    $whCode = $_POST['whCode'];

    $mi = new MultipleIterator();

    $mi->attachIterator(new ArrayIterator($rID));
    $mi->attachIterator(new ArrayIterator($product_code));
    $mi->attachIterator(new ArrayIterator($quantity));
    $mi->attachIterator(new ArrayIterator($item_price));
    $mi->attachIterator(new ArrayIterator($tot_price));
    $mi->attachIterator(new ArrayIterator($whCode));
    $mi->attachIterator(new ArrayIterator($retType));

    $sql = "INSERT INTO item_returns (`return_id`, `transaction_no`, `items_total`, `total_price`, `remarks`, `return_date`) VALUES (?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iiidss', $return_id, $transaction_no, $itemsTotal, $total_price, $remarks, $r_date);
    if ($stmt->execute()){
        $sql2 = "INSERT INTO `item_returns_pd` (`return_id`, `product_code`, `quantity`, `item_price`, `price_total`, `warehouse_code`, `return_type`) VALUES (?,?,?,?,?,?,?)";
        $stmt2 = $con->prepare($sql2);
        foreach ($mi as $value ) {
            list($rID, $product_code, $quantity, $item_price, $tot_price, $whCode, $retType) = $value;
            $stmt2->bind_param('isiddss', $rID, $product_code, $quantity, $item_price, $tot_price, $whCode, $retType);
            $stmt2->execute();
            if($retType == "refund"){
                $sql3 = "UPDATE whse_items SET quantity = (quantity + ?) WHERE product_code = ? AND warehouse_code = ?";
                $stmt3 = $con->prepare($sql3);
                
                foreach ($mi as $value ) {
                list($rID, $product_code, $quantity, $item_price, $tot_price, $whCode, $retType) = $value;
                $stmt3->bind_param('isi', $quantity, $product_code, $whCode);
                $stmt3->execute();
                }
                echo "updated stocks";
            }
            else if($retType == "Warranty"){
                echo "warranty service";
            }
            else{
                echo "item refunded ";
            }
        }
        echo "Data Saved ";       
    }
    else {
        echo "Data Not Saved". $con->error;
    }
}
else if($func == "pullout"){
    $return_id = $_POST['pullout_id'];
    $total_price = $_POST['total_price'];
    $itemsTotal = $_POST['itemsTotal'];  
    $return_date = $_POST['r_date'];
    $remarks = $_POST['remarks'];
    $whCode = $_POST['whCode'];
    $r_date = date("Y-m-d H:i:s",strtotime($return_date));

    $rID = $_POST['arrNo'];
    $product_code= $_POST['product_code'];
    $quantity = $_POST['quantity'];
    $item_price = $_POST['item_price'];
    $tot_price = $_POST['totPrice'];
    $wh_source = $_POST['whCode'];
    $return_type = $_POST['return_type'];

    $mi = new MultipleIterator();

    $mi->attachIterator(new ArrayIterator($rID));
    $mi->attachIterator(new ArrayIterator($product_code));
    $mi->attachIterator(new ArrayIterator($quantity));
    $mi->attachIterator(new ArrayIterator($item_price));
    $mi->attachIterator(new ArrayIterator($tot_price));
    $mi->attachIterator(new ArrayIterator($wh_source));
    $mi->attachIterator(new ArrayIterator($return_type));

    $sql = "INSERT INTO pullout (`pullout_id`, `total_items`, `total_price`, `date`, `remarks`) VALUES (?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('iidss', $return_id, $itemsTotal, $total_price, $r_date, $remarks);
    if ($stmt->execute()){

        $sql2 = "INSERT INTO pullout_items (pullout_id, product_code, quantity, item_price, price_total, return_type, warehouse_code) VALUES (?,?,?,?,?,?,?)";
        $stmt2 = $con->prepare($sql2);
        foreach ($mi as $value ) {
            list($rID, $product_code, $quantity, $item_price, $tot_price, $wh_source, $return_type) = $value;
            $stmt2->bind_param('isiddss', $rID, $product_code, $quantity, $item_price, $tot_price, $return_type, $wh_source);
            $stmt2->execute();
        }
        echo "Data Saved ";

        $sql3 = "UPDATE whse_items SET quantity = (quantity - ?) WHERE warehouse_code = ? AND product_code = ?";
        $stmt3 = $con->prepare($sql3);
        foreach ($mi as $value) {
            list($rID, $product_code, $quantity, $item_price, $tot_price, $wh_source) = $value;
            $stmt3->bind_param('iss', $quantity, $wh_source, $product_code);
            $stmt3->execute();
        }
        echo "Stocks has been updated";

    }
    else {
        echo "Data Not Saved". $con->error;
    }
}
else if($func == "warehouse"){
  $warehouse_code = $_POST['warehouse_code'];
  $warehouse_name = $_POST['warehouse_name'];
  $warehouse_address = $_POST['warehouse_address'];
  $contact = $_POST['warehouse_contact'];     
  $employee_id =  $_POST['username'];

  $sql = "INSERT INTO warehouses (warehouse_code, warehouse_name, warehouse_address, contact_no, employee_id) VALUES (?,?,?,?,?)";
  $stmt = $con->prepare($sql);
  $stmt->bind_param('ssssi', $warehouse_code, $warehouse_name, $warehouse_address, $contact, $employee_id);
  // Close connection
  if ($stmt->execute()){
      echo "New record created successfully";
  } else {
      echo "Data Not Saved". $con->error;
  }
  $stmt->close();
  $con->close();
}
else if($func == "user"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_role = $_POST['user_role'];           
    $employee_id =  $_POST['employee_id'];
    $options = [
        'cost' => 11,
    ];
    $hash_pass = password_hash($password, PASSWORD_BCRYPT, $options);

    $sql = "INSERT INTO user (username, password, user_role, employee_id) VALUES (?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sssi', $username, $hash_pass, $user_role, $employee_id);
    if ($stmt->execute()){
        echo "New record created successfully";
    } else {
        echo "Data Not Saved". $con->error;
    }
    $stmt->close();
    $con->close();
}
else if($func == "employee"){
    $e_ln = $_POST['e_ln'];
    $e_fn = $_POST['e_fn'];
    $e_mi = $_POST['e_mi'];
    $e_add = $_POST['e_add'];
    $e_cnum = $_POST['e_cnum'];
    $e_sx = $_POST['e_sx'];
    $input_date=$_POST['e_bday'];
    $e_bday = date("Y-m-d H:i:s",strtotime($input_date));

    $sql = "INSERT INTO employee (lastname, firstname, middlename, emp_address, contact_number, sex, birthday) VALUES (?,?,?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('sssssss', $e_ln, $e_fn, $e_mi, $e_add, $e_cnum, $e_sx, $e_bday);
    // Close connection
    if ($stmt->execute()){
        echo "New record created successfully";
    } else {
        echo "Data Not Saved". $con->error;
    }
    $stmt->close();
    $con->close();
}
else if($func == "categ"){
    $product_type = $_POST['ptype'];
    $sql = "INSERT INTO product_category (product_type) VALUES (?)";
    $stmtIn = $con->prepare($sql);
    $stmtIn->bind_param('s', $product_type);
    if ($stmtIn->execute()){
        echo "New product category created successfully";
    } else {
        echo "Data Not Saved". $con->error;
    }
    $stmtIn->close();
    $con->close();
}
else if($func == "warranty"){
    $wcode = $_POST['wcode'];
    $replacement = $_POST['tp1'];
    $duration1 = $_POST['dur1'];
    $S_warranty = $_POST['tp2'];
    $duration2 = $_POST['dur2'];
    $M_warranty = $_POST['tp3'];
    $duration3 = $_POST['dur3'];

    $sql = "INSERT INTO warranty (`warranty_code`, `rep_dur`, `tp1`, `s_warranty`, `tp2`, `sp_warranty`, `tp3`) VALUES (?,?,?,?,?,?,?)";
    $stmtIn = $con->prepare($sql);
    $stmtIn->bind_param('sisisis', $wcode, $duration1, $replacement, $duration2, $S_warranty, $duration3, $M_warranty);

    if ($stmtIn->execute()){
        echo "New warranty code created successfully";
    } else {
        echo "Data Not Saved". $con->error;
    }
    $stmtIn->close();
    $con->close();
}
?>

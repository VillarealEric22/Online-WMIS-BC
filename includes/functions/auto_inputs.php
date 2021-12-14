<?php 
include('../db.php');
// get username and usertype
$stmt = $con->prepare('SELECT user_id FROM user WHERE username = ?');
//diplay onto header
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$stmt->bind_result($u_id);
$stmt->fetch();
$stmt->close();

// get username and usertype
$stmt1 = $con->prepare('SELECT employee_id FROM user WHERE username = ?');
//diplay onto header
$stmt1->bind_param('s', $_SESSION['username']);
$stmt1->execute();
$stmt1->bind_result($e_id);
$stmt1->fetch();
$stmt1->close();

$func = $_POST['func'];
if ($func == "product"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT `product_code`, `product_img`, `product_name`, `manufacturer`, `product_type`, `color`, `item_price`, `critical_amt`, `rop_min`, `ro_categ`, `product_img`, `description`, `supplier_id`, `warranty_code` FROM `products` WHERE `product_code` = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result); 
    echo json_encode($rows);
}
else if($func == 'sales'){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT `transaction_no`, `customer_id`, `c_name`, `c_address`, `contact_number`, `itemsTotal`, `total_price`, `transaction_date`, `employee_id`, `remarks` FROM sales_transaction LEFT JOIN customer USING (customer_id) WHERE transaction_no = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == 'sales-1'){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT`transaction_no`, `product_code`, `quantity`, `price_ea`, `price_tot` FROM `cart_items` WHERE  transaction_no = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $array = array();
    while($row = mysqli_fetch_array($result)){
        $array[] = $row;
    }
    echo json_encode($array);
}
else if ($func == "customer"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT c_address, contact_number, c_name, customer_id FROM customer WHERE customer_id = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if ($func == "customer-data"){
    $customer_id = $_POST['customer_id'];
    $sql = "SELECT c_address, contact_number FROM customer WHERE customer_id = '$customer_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if ($func == "customer-data1"){
    $t_no = $_POST['transaction_id'];
    $query = "SELECT `customer_id`, `c_name`, `c_address`, `contact_number` FROM sales_transaction INNER JOIN customer USING (customer_id) WHERE transaction_no = '$t_no'";
    $result = mysqli_query($con,$query) or die($con->error);
    $rows = mysqli_fetch_array($result); //or die($con->error) is for debugging of SQL Query
    echo json_encode($rows);
}
else if($func == "supplier"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT supplier_address, contact_number, supplier_name, supplier_id FROM supplier WHERE supplier_id = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == "supplier-data1"){
    $t_no = $_POST['transaction_id'];
    $sql = "SELECT supplier_id, supplier_name, supplier_address, contact_number FROM purchase_order INNER JOIN supplier USING(supplier_id) WHERE purchase_order_id = '$t_no'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == "supplier-data"){
    $supplier_id = $_POST['supplier_id'];
    $sql = "SELECT supplier_address, supplier_name, contact_number FROM supplier WHERE supplier_id = '$supplier_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == "orders"){
    $query = "SELECT (purchase_order_id+1) AS id FROM purchase_order ORDER BY purchase_order_id DESC LIMIT 1";
    $result = mysqli_query($con, $query) or die($con->error);
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if ($func == "order-1"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT`purchase_order_id`, `supplier_id`, `supplier_name`, `supplier_address`, `contact_number`, `total_price`, `order_date`, `remarks`  FROM purchase_order LEFT JOIN supplier USING (supplier_id) WHERE purchase_order_id = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if ($func == "order-2"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT `purchase_order_id`, `product_code`, `quantity`, `price`, `price_tot` FROM item_orders WHERE purchase_order_id = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $array = array();
    while($row = mysqli_fetch_array($result)){
        $array[] = $row;
    }
    echo json_encode($array);
}
else if($func == "order-data"){
    $o_id = $_POST['o_id'];
    $sql = "SELECT purchase_order_id, supplier_id, supplier_name, supplier_address, contact_number FROM purchase_order LEFT JOIN supplier USING (supplier_id) WHERE purchase_order_id = '$o_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == "inventory"){
    $query = "SELECT (inventory_id+1) AS id FROM inventory ORDER BY inventory_id DESC LIMIT 1";
    $result = mysqli_query($con, $query) or die($con->error);
    $rows = mysqli_fetch_array($result);    
    echo json_encode($rows);
}
else if($func == "inventory-1"){
    $o_id = $_POST["edit_id"];
    $query = "SELECT `inventory_id`, `purchase_order_id`, `totalVal`, `date_created`, `warehouse_code`, `remarks` FROM inventory WHERE inventory_id = $o_id";
    $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == "inventory-2"){
    $o_id = $_POST["edit_id"];
    $query = "SELECT `product_code`, `quantity`, `unit_price`, `total_price` FROM inventory_items WHERE inventory_id = $o_id";
    $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $array = array();
    while($row = mysqli_fetch_array($result)){
        $array[] = $row;
    }
    echo json_encode($array);
}
else if($func == "inventory_order"){
    $o_id = $_POST["o_id"];
    $query = "SELECT `product_code`, `remain_qty`, `price`, `price_tot`, `purchase_order_id` FROM item_orders WHERE purchase_order_id = '$o_id'";
    $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $array = array();
    while($row = mysqli_fetch_array($result)){
        $array[] = $row;
    }
    echo json_encode($array);
}
else if($func == "transfer"){
    $o_id = $_POST["o_id"];
    $query = "SELECT `product_code`, `remain_qty`, `transfer_id`, `warehouse_dest`, `warehouse_source`FROM transfer_items INNER JOIN transfer USING (transfer_id) WHERE transfer_id = '$o_id'";
    $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $array = array();
    while($row = mysqli_fetch_array($result)){
        $array[] = $row;
    }
    echo json_encode($array);
}
else if($func == "pullout"){
    $t_id = $_POST["t_id"];
    $query = "SELECT product_code, quantity, price, price_tot, purchase_order_id FROM item_orders WHERE purchase_order_id = '$t_id'";
    $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $array = array();
    while($row = mysqli_fetch_array($result)){
        $array[] = $row;
    }
    echo json_encode($array);
}
else if($func == "return"){
    $t_id = $_POST["t_id"];
    $query = "SELECT product_code, quantity, price_ea, price_tot, transaction_no FROM cart_items WHERE transaction_no = '$t_id'";
    $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $array = array();
    while($row = mysqli_fetch_array($result)){
        $array[] = $row;
    }
    echo json_encode($array);
}
else if ($func == "return-1"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT `return_id`, `transaction_no`, `warehouse_code`, `warehouse_name`, `warehouse_address`, `contact_no`, `total_price`, `return_date`, `remarks` FROM item_returns INNER JOIN item_returns_pd USING (`return_id`) INNER JOIN warehouses USING (warehouse_code) WHERE return_id = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if ($func == "return-2"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT `return_id`, `product_code`, `quantity`, `item_price`, `price_total`, `return_type` FROM item_returns_pd WHERE  return_id = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $array = array();
    while($row = mysqli_fetch_array($result)){
        $array[] = $row;
    }
    echo json_encode($array);
}
else if($func == "user"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT user_id, username, user_role, password, employee_id FROM user WHERE user_id = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows); 
}
else if($func == "user-1"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT user_id, username, user_role, password, employee_id FROM user WHERE user_id = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows); 
}
else if($func == "employee"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT `employee_id`, `firstname`, `lastname`, `middlename`, `emp_address`, `contact_number`, `sex`, `birthday` FROM employee WHERE employee_id = $edit_id";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == "warehouse"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT warehouse_code, warehouse_name, warehouse_address, contact_no, employee_id FROM warehouses WHERE warehouse_code = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == "set_max"){
    $id = $_POST['id'];
    $wh = $_POST['wh'];
    $query = "SELECT quantity FROM whse_items WHERE product_code = '$id' AND warehouse_code = '$wh'";
    $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == "sales-id"){
    $query = "SELECT (transaction_no + 1) AS id FROM sales_transaction ORDER BY transaction_no DESC LIMIT 1";
    $result = mysqli_query($con, $query) or die($con->error);
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == "transfer-id"){
    $query = "SELECT (transfer_id+1) AS id FROM transfer ORDER BY transfer_id DESC LIMIT 1";
    $result = mysqli_query($con, $query) or die($con->error);
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if ($func == "transfer-1"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT `warehouse_source`, `transfer_id`, `request_date`, `warehouse_dest`, `remarks` FROM `transfer` WHERE transfer_id = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if ($func == "transfer-2"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT `product_code`, `quantity`, `remain_qty` FROM transfer_items WHERE transfer_id = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $array = array();
    while($row = mysqli_fetch_array($result)){
        $array[] = $row;
    }
    echo json_encode($array);
}
else if($func == "inventory-id"){
    $query = "SELECT (inventory_id+1) AS id FROM inventory ORDER BY inventory_id DESC LIMIT 1";
    $result = mysqli_query($con, $query) or die($con->error);
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == "return-id"){
    $query = "SELECT (IFNULL(return_id, 0)+1) AS id FROM item_returns ORDER BY return_id DESC LIMIT 1";
    $result = mysqli_query($con, $query) or die($con->error);
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == "order-id"){
    $query = "SELECT (purchase_order_id+1) AS id FROM purchase_order ORDER BY purchase_order_id DESC LIMIT 1";
    $result = mysqli_query($con, $query) or die($con->error);
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == "pullout-id"){
    $query = "SELECT (IFNULL(pullout_id, 0)+1) AS id FROM pullout ORDER BY pullout_id DESC LIMIT 1";
    $result = mysqli_query($con, $query) or die($con->error);
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if ($func == "pullout-1"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT `pullout_id`, `purchase_order_id`, `date`, `total_price`, `remarks` FROM pullout WHERE pullout_id = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if ($func == "pullout-2"){
    $edit_id = $_POST['edit_id'];
    $sql = "SELECT `product_code`, `quantity`, `item_price`, `price_total`, `return_type` FROM pullout_items WHERE pullout_id = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $array = array();
    while($row = mysqli_fetch_array($result)){
        $array[] = $row;
    }
    echo json_encode($array);
}
else if ($func == "wty"){
    $edit_id = $_POST['id'];
    $sql = "SELECT `id`, `warranty_code`,`rep_dur`, `tp1`, `s_warranty`, `tp2`, `sp_warranty`, `tp3` FROM warranty WHERE id = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if ($func == "wty-1"){
    $edit_id = $_POST['id'];
    $sql = "SELECT `id`, `warranty_code`, CONCAT(`rep_dur`, ' ',`tp1`) AS refund, CONCAT(`s_warranty`, ' ',`tp2`) AS warranty, CONCAT(`sp_warranty`, ' ',`tp3`) AS mfgr FROM warranty WHERE id = '$edit_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if ($func == "ptype-1"){
    $edit_id = $_POST['id'];
    $sql = "SELECT `id`, `product_type` FROM product_category WHERE id = $edit_id";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == "emp1"){
    $sql = "SELECT `employee_id`, `firstname`, `lastname`, `middlename`, `emp_address`, `contact_number`, `sex`, `birthday` FROM employee WHERE employee_id = $e_id";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
else if($func == "user1"){
    $sql = "SELECT username FROM user WHERE user_id = '$u_id'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    $rows = mysqli_fetch_array($result);
    echo json_encode($rows);
}
?>

<?php 
include('../db.php');
$func = $_POST['func'];
//restrict delete
if ($func == "product"){
    $product_code = $_POST['deleteID'];
    $total = count($product_code);
    $array = array();
    $path = '';
    foreach($product_code as $value){
        $sql_check = "SELECT product_code FROM products INNER JOIN cart_items USING (product_code) INNER JOIN whse_items USING (product_code) INNER JOIN item_orders USING (product_code) WHERE product_code = '$value' LIMIT 1";
        $result = mysqli_query($con, $sql_check);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)){
                $array[] = $row['product_code'];
              }
        }else{
            $sql = "SELECT product_img FROM products WHERE product_code = '$value'";
            $res = mysqli_query($con, $sql) or die($con->error);
                while($rows = mysqli_fetch_array($res)){
                    $path = $rows['product_img'];
                    unlink('../../'.$path);
                    $sqlDel = "DELETE FROM products WHERE product_code = '$value'";
                    $res1 = mysqli_query($con, $sqlDel) or die($con->error);
                }
        }
    }
    $pcode = implode(",", $array);
    if(count($array) == 1){
        echo "cannot delete: ".$pcode. " as it is being referenced by active transactions.";
    }
    else if(count($array)>1){
        echo "cannot delete: ".$pcode. " as it is being referenced by active transactions, other items deleted.";
    }
    else{
        echo "successfully deleted ". $total. " items";
    }
    
}
else if ($func == "customer"){
    $customer_id = $_POST['deleteID'];
    $total = count($customer_id);
    $customer_id = implode(',', $customer_id);

    $sql = "DELETE FROM customer WHERE customer_id IN ($customer_id)";
    $result = mysqli_query($con, $sql);

    if ($result === true) {
        echo $total. " items successfully deleted";
    }else{
        echo "Data Not Saved". $con->error;
	}
    
}
//restrict delete
else if($func == "supplier"){
    $supplier_id = $_POST['deleteID'];
    $total = count($supplier_id);
    $array = array();

    foreach($supplier_id as $value){
        $sql_check = "SELECT supplier_id, supplier_name FROM supplier INNER JOIN products USING (supplier_id) WHERE supplier_id = '$value' LIMIT 1";
        $result = mysqli_query($con, $sql_check);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)){
                $array[] = $row['supplier_name'];
              }
        }else{
            $sql = "DELETE FROM supplier WHERE supplier_id = '$value'";
            $res = mysqli_query($con, $sql);
        }
    }
    $sid = implode(",", $array);

    if(count($array) == 1){
        echo "cannot delete: ".$sid. " as it is being referenced by active products.";
    }
    else if(count($array)>1){
        echo "cannot delete: ".$sid. " as it is being referenced by active products, other items deleted.";
    }
    else{
        echo "successfully deleted ". $total. " items";
    }
}
else if($func == "transfer"){
    $transfer_id = $_POST['id'];
    $total = count($transfer_id);
    $transfer_id = implode(',', $transfer_id);

    $sql = "DELETE FROM transfer WHERE transfer_id IN ($transfer_id)";
    $result = mysqli_query($con, $sql);

    if($result === true) {
        $sql2 = "DELETE FROM transfer_items WHERE transfer_id IN ($transfer_id)";
        $result2 = mysqli_query($con, $sql2);

        echo $total. " Transfer request has been declined and deleted from the database";

    }else{
         echo "Data Not Saved". $con->error;
    }
}
else if($func == "user"){
    $user_id = $_POST['deleteID'];
    $total = count($user_id);
    $user_id= implode(',', $user_id);

    $sql = "DELETE FROM user WHERE `user_id` IN ($user_id)";
    $result = mysqli_query($con, $sql);

    if ($result === true) {
        echo $total. " items successfully deleted";
    }else{
        echo "Data Not Saved". $con->error;;
    }
}
else if($func == "employee"){
    $emp_id = $_POST['deleteID'];
    $total = count($emp_id);
    $array = array();
    foreach($emp_id as $value){
        $sql_check = "SELECT employee_id FROM employee INNER JOIN user USING (employee_id) INNER JOIN warehouses USING (employee_id) WHERE employee_id = '$value' LIMIT 1";
        $result = mysqli_query($con, $sql_check);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)){
                $array[] = $row['employee_id'];
              }
        }else{
            $sql = "DELETE FROM employee WHERE employee_id = '$value'";
            $result = mysqli_query($con, $sql);
        }
    }
    $sid = implode(",", $array);

    if(count($array) == 1){
        echo "cannot delete: ".$sid. " as it is being referenced by active products.";
    }
    else if(count($array)>1){
        echo "cannot delete: ".$sid. " as it is being referenced by active products, other items deleted.";
    }
    else{
        echo "successfully deleted ". $total. " items";
    }

}
//restrict delete
else if($func == "warehouse"){
    $warehouse_id = $_POST['deleteID'];
    $total = count($warehouse_id);
    $array = array();
    foreach($warehouse_id as $value){
        $sql_check = "SELECT warehouse_code FROM warehouses INNER JOIN whse_items USING (warehouse_code) INNER JOIN transfer t ON warehouses.warehouse_code = t.warehouse_source INNER JOIN transfer tr ON warehouses.warehouse_code = tr.warehouse_dest WHERE warehouse_code = '$value' LIMIT 1";
        $result = mysqli_query($con, $sql_check);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)){
                $array[] = $row['warehouse_code'];
              }
        }else{
            $sql = "DELETE FROM warehouses WHERE warehouse_code = '$value'";
            $res = mysqli_query($con, $sql);
        }
    }
    $sid = implode(",", $array);

    if(count($array) == 1){
        echo "cannot delete: ".$sid. " as it is actively referenced.";
    }
    else if(count($array)>1){
        echo "cannot delete: ".$sid. " as it is actively referenced, other items deleted.";
    }
    else{
        echo "successfully deleted ". $total. " items";
    }
}
//restrict delete
else if($func == "ptype"){
    $supplier_id = $_POST['deleteID'];
    $total = count($supplier_id);
    $array = array();

    foreach($supplier_id as $value){
        $sql_check = "SELECT product_type FROM product_category INNER JOIN products USING (product_type) WHERE id = '$value' LIMIT 1";
        $result = mysqli_query($con, $sql_check);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)){
                $array[] = $row['product_type'];
              }
        }else{
            $sql = "DELETE FROM product_category WHERE id = '$value'";
            $res = mysqli_query($con, $sql);
        }
    }
    $sid = implode(",", $array);

    if(count($array) == 1){
        echo "cannot delete: ".$sid. " as it is being referenced by active products.";
    }
    else if(count($array)>1){
        echo "cannot delete: ".$sid. " as it is being referenced by active products, other items deleted.";
    }
    else{
        echo "successfully deleted ". $total. " items";
    }
}
//restrict delete
else if($func == "warranty"){
    $supplier_id = $_POST['deleteID'];
    $total = count($supplier_id);
    $array = array();

    foreach($supplier_id as $value){
        $sql_check = "SELECT warranty_code FROM warranty INNER JOIN products p ON warranty.id = p.warranty_code WHERE id = '$value' LIMIT 1";
        $result = mysqli_query($con, $sql_check);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)){
                $array[] = $row['warranty_code'];
              }
        }else{
            $sql = "DELETE FROM warranty WHERE id = '$value'";
            $res = mysqli_query($con, $sql);
        }
    }
    $sid = implode(",", $array);

    if(count($array) == 1){
        echo "cannot delete: ".$sid. " as it is being referenced by active products.";
    }
    else if(count($array)>1){
        echo "cannot delete: ".$sid. " as it is being referenced by active products, other items deleted.";
    }
    else{
        echo "successfully deleted ". $total. " items";
    }
}
?>

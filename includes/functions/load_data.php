<?php 
include('../db.php');

$func = $_POST['func'];
if ($func == "product"){
    $sql = "SELECT product_code, product_img, product_name, manufacturer, c.product_type, color, ro_categ, rop_min, critical_amt, item_price, IFNULL(SUM(quantity),0) AS qty FROM products LEFT JOIN whse_items USING (product_code) LEFT JOIN product_category c ON c.id = products.product_type GROUP BY product_code";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $product_img = $rows['product_img'];
        $product_code = $rows['product_code'];
        $product_name = $rows['product_name'];
        $manufacturer = $rows['manufacturer'];
        $product_type =  $rows['product_type'];            
        $color =  $rows['color'];
        $ro_categ = $rows['ro_categ'];
        $rop = $rows['rop_min'];
        $crit = $rows['critical_amt'];
        $qty =  $rows['qty'];
        $item_price =  $rows['item_price'];
        if($ro_categ != 'JIT' && $qty>$rop){
            ?>
            <tr id='tr_<?= $product_code ?>' class ='tablerow'>
                <td class = "table-main" ><input type='checkbox' id = toggle name='selectable[]' class = "selectable" value='<?= $product_code ?>'></td>
                <td class = "table-main" ><img src='<?=$product_img?>' width="50px" height="50px" alt="Product_image"></td>
                <td class = "table-main" ><?= $product_code ?></td>
                <td class = "table-main" ><?= $product_name ?></td>
                <td class = "table-main" ><?= $product_type ?></td>
                <td class = "table-main" ><?= $qty?></td>
                <td class = "table-main" ><?=$item_price ?></td>
                <td class = "table-main" ><button href = "#view" class = 'modalbtn btn_view' value='<?= $product_code ?>'>View <span class = 'las la-eye'></span></button></td>
            </tr>
            <?php
        }
        else if($ro_categ != 'JIT' && $qty<=$rop && $qty>$crit){
            ?>
            <tr id='tr_<?= $product_code ?>' class ='tablerow'>
                <td class = "table-main" ><input type='checkbox' id = toggle name='selectable[]' class = "selectable" value='<?= $product_code ?>'></td>
                <td class = "table-main" ><img src='<?=$product_img?>' width="50px" height="50px" alt="Product_image"></td>
                <td class = "table-main" ><?= $product_code ?></td>
                <td class = "table-main" ><?= $product_name ?></td>
                <td class = "table-main" ><?= $product_type ?></td>
                <td class = "table-main" ><div class="status pending"><?= $qty?></div></td>
                <td class = "table-main" ><?=$item_price ?></td>
                <td class = "table-main" ><button href = "#view" class = 'btn_view' value='<?= $product_code ?>'>View <span class = 'las la-eye'></span></button></td>
            </tr>
            <?php
        }
        else if($ro_categ != 'JIT' &&  $qty<=$rop && $qty<=$crit){
            ?>
            <tr id='tr_<?= $product_code ?>' class ='tablerow'>
                <td class = "table-main" ><input type='checkbox' id = toggle name='selectable[]' class = "selectable" value='<?= $product_code ?>'></td>
                <td class = "table-main" ><img src='<?=$product_img?>' width="50px" height="50px" alt="Product_image"></td>
                <td class = "table-main" ><?= $product_code ?></td>
                <td class = "table-main" ><?= $product_name ?></td>
                <td class = "table-main" ><?= $product_type ?></td>
                <td class = "table-main" ><div class="status return"><?= $qty?></div></td>
                <td class = "table-main" ><?=$item_price ?></td>
                <td class = "table-main" ><button href = "#view" class = 'btn_view' value='<?= $product_code ?>'>View <span class = 'las la-eye'></span></button></td>
            </tr>
            <?php
        }
        else{
            ?>
            <tr id='tr_<?= $product_code ?>' class ='tablerow'>
                <td class = "table-main" ><input type='checkbox' id = toggle name='selectable[]' class = "selectable" value='<?= $product_code ?>'></td>
                <td class = "table-main" ><img src='<?=$product_img?>' width="50px" height="50px" alt="Product_image"></td>
                <td class = "table-main" ><?= $product_code ?></td>
                <td class = "table-main" ><?= $product_name ?></td>
                <td class = "table-main" ><?= $product_type ?></td>
                <td class = "table-main" ><?= $qty?></td>
                <td class = "table-main" ><?=$item_price ?></td>
                <td class = "table-main" ><button href = "#view" class = 'modalbtn btn_view' value='<?= $product_code ?>'>View <span class = 'las la-eye'></span></button></td>
            </tr>
            <?php
        }
    }
}
if ($func == "product-pos"){
    $sql = "SELECT product_code, product_img, product_name, product_type, color, item_price, IFNULL(SUM(quantity),0) AS qty FROM products LEFT JOIN whse_items USING (product_code) WHERE quantity != 0 GROUP BY product_code";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $product_img = $rows['product_img'];
        $product_code = $rows['product_code'];
        $product_name = $rows['product_name'];
        $product_type =  $rows['product_type'];            
        $color =  $rows['color'];
        $qty =  $rows['qty'];
        $item_price =  $rows['item_price'];
    ?>
    <tr  data-pcode= '<?= $product_code ?>' data-price= '<?= $item_price ?>' id='tr_<?= $product_code ?>' class = 'select_pos_item'>
        <td class = "table-main" ><img src='<?=$product_img?>' width="50px" alt="Product_image"></td>
        <td class = "table-main" ><?= $product_code ?></td>
        <td class = "table-main" ><?= $product_name ?></td>
        <td class = "table-main" ><?= $product_type ?></td>
        <td class = "table-main" ><?= $qty?></td>
        <td class = "table-main" ><?= $item_price ?></td>
    <?php
    }
}
else if ($func == "categ"){
    $sql = "SELECT id, product_category.product_type, IFNULL(count(product_code),0) AS total FROM product_category LEFT JOIN products ON product_category.id = products.product_type GROUP BY product_type";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $id = $rows['id'];
        $product_type = $rows['product_type'];
        $total = $rows['total'];
    ?>
    <tr id='tr_<?= $id ?>' class ='tablerow'>
        <td class = "table-main" ><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $id ?>'></td>
        <td class = "table-main" ><?= $product_type ?></td>
        <td class = "table-main" ><?= $total ?></td>
        <td class = "table-main" ><button href = "#view" class = 'modalbtn btn_view' value='<?= $id ?>'> View <span class = 'las la-eye'></span></button></td>
    <?php
    }
}
else if ($func == "warranty"){
    $sql = "SELECT id, warranty.warranty_code, IFNULL(count(product_code),0) AS total, CONCAT(rep_dur, ' ',tp1) AS `refund`, CONCAT(s_warranty, ' ',tp2) AS warranty, CONCAT(sp_warranty,  ' ',tp3) AS supplier FROM warranty LEFT JOIN products p ON warranty.id = p.warranty_code GROUP BY warranty_code";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $id = $rows['id'];
        $wty_code = $rows['warranty_code'];
        $total = $rows['total'];
        $refund = $rows['refund'];
        $warranty = $rows['warranty'];
        $supplier = $rows['supplier'];
    ?>
    <tr id='tr_<?= $wty_code ?>' class ='tablerow'>
        <td class = "table-main" ><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $id ?>'></td>
        <td class = "table-main" ><?= $wty_code?></td>
        <td class = "table-main" ><?= $total ?></td>
        <td class = "table-main" ><?= $refund ?></td>
        <td class = "table-main" ><?= $warranty ?></td>
        <td class = "table-main" ><?= $supplier ?></td>
        <td class = "table-main" ><button href = "#view" class = 'modalbtn btn_view' value='<?= $id ?>'> View <span class = 'las la-eye'></span></button></td>
    <?php
    }
}
else if ($func == "customer"){
    $sql = "SELECT customer_id, c_name, c_address, contact_number FROM customer";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $customer_id = $rows['customer_id'];
        $customer_name = $rows['c_name'];
        $c_address = $rows['c_address'];           
        $contact_number =  $rows['contact_number'];
    ?>
    <tr id='tr_<?= $customer_id ?>' class ='tablerow'>
        <td class = "table-main" ><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $customer_id ?>'></td>
        <td class = "table-main" ><?= $customer_id ?></td>
        <td class = "table-main" ><?= $customer_name ?></td>
        <td class = "table-main" ><?= $c_address ?></td>
        <td class = "table-main" ><?= $contact_number ?></td>
    <?php
    }
}
else if($func == "supplier"){
    $sql = "SELECT supplier_id, supplier_name, supplier_address, contact_number FROM supplier";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $supplier_id = $rows['supplier_id'];
        $supplier_name = $rows['supplier_name'];
        $s_address = $rows['supplier_address'];           
        $contact_number =  $rows['contact_number'];
    ?>
    <tr id='tr_<?= $supplier_id ?>' class ='tablerow'>
        <td class = "table-main" ><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $supplier_id ?>'></td>
        <td class = "table-main" ><?= $supplier_id ?></td>
        <td class = "table-main" ><?= $supplier_name ?></td>
        <td class = "table-main" ><?= $s_address ?></td>
        <td class = "table-main" ><?= $contact_number ?></td>
    <?php
    }
}
else if($func == "sales"){
    $sql = "SELECT `transaction_no`, `c_name`, `itemsTotal`, `total_price`, `transaction_date`, CONCAT(employee.firstname, ' ', employee.lastname) AS employee FROM sales_transaction LEFT JOIN customer USING (customer_id) INNER JOIN employee USING(employee_id) ORDER BY transaction_no DESC";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $transaction_no = $rows['transaction_no'];
        $customer_id = $rows['c_name'];
        $itemsTotal = $rows['itemsTotal'];
        $total_price = $rows['total_price'];
        $transaction_date = $rows['transaction_date'];
        $employee = $rows['employee'];
    ?>
    <tr id='tr_<?= $transaction_no ?>' class ='tablerow'>
        <td class = "table-main" ></td>
        <td class = "table-main" ><?= $transaction_no ?></td>
        <td class = "table-main" ><?= $transaction_date ?></td>
        <td class = "table-main" ><?= $customer_id ?></td>
        <td class = "table-main" ><?= $itemsTotal?></td>
        <td class = "table-main" ><?= $total_price ?></td>
        <td class = "table-main" ><?= $employee ?></td>
        <td class = "table-main" ><button href = "#view" class = 'modalbtn btn_view' value='<?= $transaction_no ?>'> View <span class = 'las la-eye'></span></button></td>
    </tr>
    <?php
    }
}
else if($func == "orders"){
    $sql = "SELECT `purchase_order_id`,`supplier_name` ,`items_total`, `total_price`, `order_date`, `status` FROM purchase_order LEFT JOIN supplier USING (supplier_id) WHERE status != 'completed'";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $purchase_order_id = $rows['purchase_order_id'];
        $supplier_id = $rows['supplier_name'];
        $itemsTotal = $rows['items_total'];
        $total_price = $rows['total_price'];
        $order_date = $rows['order_date'];
        $status = $rows['status'];
    ?>
    <tr id='tr_<?= $purchase_order_id ?>' class ='tablerow'>
        <td class = "table-main" ></td>
        <td class = "table-main" ><?= $purchase_order_id ?></td>
        <td class = "table-main" ><?= $supplier_id ?></td>
        <td class = "table-main" ><?= $itemsTotal ?></td>
        <td class = "table-main" ><?= $total_price ?></td>
        <td class = "table-main" ><?= $order_date ?></td>
        <td class = "table-main" ><?= $status ?></td>
        <td class = "table-main" ><button href = "#view" class = 'modalbtn btn_view' value='<?= $purchase_order_id ?>'> View <span class = 'las la-eye'></span></button></td>
    </tr>
    <?php
    }
}
else if($func == "orders-c"){
    $sql = "SELECT `purchase_order_id`,`supplier_name` ,`items_total`, `total_price`, `order_date`, `status` FROM purchase_order LEFT JOIN supplier USING (supplier_id) WHERE status = 'completed' ORDER BY purchase_order_id DESC";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $purchase_order_id = $rows['purchase_order_id'];
        $supplier_id = $rows['supplier_name'];
        $itemsTotal = $rows['items_total'];
        $total_price = $rows['total_price'];
        $order_date = $rows['order_date'];
        $status = $rows['status'];
    ?>
    <tr id='tr_<?= $purchase_order_id ?>' class ='tablerow'>
        <td class = "table-main" ></td>
        <td class = "table-main" ><?= $purchase_order_id ?></td>
        <td class = "table-main" ><?= $supplier_id ?></td>
        <td class = "table-main" ><?= $itemsTotal ?></td>
        <td class = "table-main" ><?= $total_price ?></td>
        <td class = "table-main" ><?= $order_date ?></td>
        <td class = "table-main" ><?= $status ?></td>
        <td class = "table-main" ><button href = "#view" class = 'modalbtn btn_view' value='<?= $purchase_order_id ?>'> View <span class = 'las la-eye'></span></button></td>
    </tr>
    <?php
    }
}
else if($func == "inventory"){
    $sql = "SELECT `inventory_id`, `purchase_order_id`, `items_total`, `totalVal`, `date_created`, `warehouse_name` FROM `inventory` LEFT JOIN warehouses USING (warehouse_code) ORDER BY purchase_order_id DESC";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $inventory_id = $rows['inventory_id'];
        $purchase_order_id  = $rows['purchase_order_id'];
        $items_total = $rows['items_total'];
        $totalValue = $rows['totalVal'];
        $warehouse_name= $rows['warehouse_name'];           
        $date_created =  $rows['date_created'];
    ?>
    <tr id='tr_<?= $inventory_id ?>' class ='tablerow'>
        <td class = "table-main" ></td>
        <td class = "table-main" ><?= $inventory_id ?></td>    
        <td class = "table-main" ><?= $date_created ?></td>
        <td class = "table-main" ><?= $purchase_order_id ?></td>
        <td class = "table-main" ><?= $items_total?></td>
        <td class = "table-main" ><?= $totalValue?></td>
        <td class = "table-main" ><?= $warehouse_name?></td>
        <td class = "table-main" ><button href = "#view" class = 'modalbtn btn_view' value='<?= $inventory_id ?>'> View <span class = 'las la-eye'></span></button></td>
    <?php
    }
}
else if($func == "transfer"){
    $sql = "SELECT transfer_id, request_date, items_total, warehouse_source, warehouse_dest, author, status, CONCAT(employee.firstname, ' ', employee.lastname) AS employee FROM transfer LEFT JOIN employee ON (employee.employee_id = transfer.author) WHERE status = 'pending' ORDER BY transfer_id DESC";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $transfer_id = $rows['transfer_id'];
        $items_total = $rows['items_total'];
        $warehouse_source = $rows['warehouse_source'];
        $warehouse_dest = $rows['warehouse_dest'];         
        $date_created =  $rows['request_date'];
        $author =  $rows['employee'];
        $status =  $rows['status'];
    ?>
    <tr id='tr_<?= $transfer_id ?>' class ='tablerow'>
        <td class = "table-main" ><input type='checkbox' name='selectable[]' class = "selectable" value='<?=  $transfer_id ?>'></td>
        <td class = "table-main" ><?= $transfer_id ?></td>    
        <td class = "table-main" ><?= $date_created ?></td>
        <td class = "table-main" ><?= $items_total?></td>
        <td class = "table-main" ><?= $warehouse_source?></td>
        <td class = "table-main" ><?= $warehouse_dest?></td>
        <td class = "table-main" ><?= $author?></td>
        <td class = "table-main" ><?= $status?></td>
        <td class = "table-main" ><button href = "#view" class = 'modalbtn btn_view' value='<?=  $transfer_id ?>'> View </button></td>
    <?php
    }
}
else if($func == "transfer-approved"){
    $sql = "SELECT transfer_id, request_date, items_total, warehouse_source, warehouse_dest, author, status, CONCAT(employee.firstname, ' ', employee.lastname) AS employee FROM transfer LEFT JOIN employee ON (employee.employee_id = transfer.author) WHERE status = 'approved' OR status = 'incomplete' ORDER BY transfer_id DESC";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $transfer_id = $rows['transfer_id'];
        $items_total = $rows['items_total'];
        $warehouse_source = $rows['warehouse_source'];
        $warehouse_dest = $rows['warehouse_dest'];         
        $date_created =  $rows['request_date'];
        $author =  $rows['employee'];
        $status =  $rows['status'];
    ?>
    <tr id='tr_<?= $transfer_id ?>' class ='tablerow'>
        <td class = "table-main" ><input type='checkbox' name='selectable[]' class = "selectable" value='<?=  $transfer_id ?>'></td>
        <td class = "table-main" ><?= $transfer_id ?></td>    
        <td class = "table-main" ><?= $date_created ?></td>
        <td class = "table-main" ><?= $items_total?></td>
        <td class = "table-main" ><?= $warehouse_source?></td>
        <td class = "table-main" ><?= $warehouse_dest?></td>
        <td class = "table-main" ><?= $author?></td>
        <td class = "table-main" ><?= $status?></td>
        <td class = "table-main" ><button href = "#view" class = 'modalbtn btn_view' value='<?=  $transfer_id ?>'> View <span class = 'las la-eye'></span></button></td>
    <?php
    }
}
else if($func == "transfer-completed"){
    $sql = "SELECT transfer_id, request_date, items_total, warehouse_source, warehouse_dest, author, status, CONCAT(employee.firstname, ' ', employee.lastname) AS employee FROM transfer LEFT JOIN employee ON (employee.employee_id = transfer.author) WHERE status = 'completed'  ORDER BY transfer_id DESC";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $transfer_id = $rows['transfer_id'];
        $items_total = $rows['items_total'];
        $warehouse_source = $rows['warehouse_source'];
        $warehouse_dest = $rows['warehouse_dest'];         
        $date_created =  $rows['request_date'];
        $author =  $rows['employee'];
        $status =  $rows['status'];
    ?>
    <tr id='tr_<?= $transfer_id ?>' class ='tablerow'>
        <td class = "table-main" ><input type='checkbox' name='selectable[]' class = "selectable" value='<?=  $transfer_id ?>'></td>
        <td class = "table-main" ><?= $transfer_id ?></td>    
        <td class = "table-main" ><?= $date_created ?></td>
        <td class = "table-main" ><?= $items_total?></td>
        <td class = "table-main" ><?= $warehouse_source?></td>
        <td class = "table-main" ><?= $warehouse_dest?></td>
        <td class = "table-main" ><?= $author?></td>
        <td class = "table-main" ><?= $status?></td>
        <td class = "table-main" ><button href = "#view" class = 'modalbtn btn_view' value='<?=  $transfer_id ?>'> View <span class = 'las la-eye'></span></button></td>
    <?php
    }
}
else if($func == "returns"){
    $sql = "SELECT return_id, transaction_no, items_total, total_price, remarks, return_date FROM item_returns ORDER BY return_id DESC";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $return_id = $rows['return_id'];
        $transaction_no= $rows['transaction_no'];        
        $items_total =  $rows['items_total'];
        $total_price =  $rows['total_price'];
        $return_type =  $rows['remarks'];
        $return_date =  $rows['return_date'];
    ?>
    <tr id='tr_<?= $return_id ?>' class ='tablerow'>
        <td class = "table-main" ></td>
        <td class = "table-main" ><?= $return_id  ?></td>
        <td class = "table-main" ><?= $transaction_no ?></td>
        <td class = "table-main" ><?= $items_total?></td>
        <td class = "table-main" ><?= $total_price ?></td>
        <td class = "table-main" ><?= $return_type ?></td>
        <td class = "table-main" ><?= $return_date ?></td>
        <td class = "table-main" ><button href = "#view" class = 'modalbtn btn_view' value='<?= $return_id ?>'> View <span class = 'las la-eye'></span></button></td>
    <?php
    }
}
else if($func == "pullout"){
    $sql = "SELECT `pullout_id`, `total_items`, `total_price`, `date`, `remarks` FROM pullout";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $return_id = $rows['pullout_id'];       
            $items_total =  $rows['total_items'];
            $total_price =  $rows['total_price'];
            $return_type =  $rows['remarks'];
            $return_date =  $rows['date'];
        ?>
        <tr id='tr_<?= $return_id ?>' class ='tablerow'>
            <td class = "table-main" ></td>
            <td class = "table-main" ><?= $return_id  ?></td>
            <td class = "table-main" ><?= $items_total?></td>
            <td class = "table-main" ><?= $total_price ?></td>
            <td class = "table-main" ><?= $return_date ?></td>
            <td class = "table-main" ><button href = "#view" class = 'modalbtn btn_view' value='<?= $return_id ?>'> View <span class = 'las la-eye'></span></button></td>
        <?php
        }
}
else if($func == "user"){
    $sql = "SELECT `user_id`, username, user_role, CONCAT(employee.firstname, ' ', employee.lastname) AS employee FROM user LEFT JOIN employee USING (employee_id)";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $user_id = $rows['user_id'];
        $username = $rows['username'];
        $user_role = $rows['user_role'];
        $name = $rows['employee'];          
    ?>
    <tr id='tr_<?= $user_id ?>' class ='tablerow'>
        <td class = "table-main" ><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $user_id ?>'></td>      
        <td class = "table-main" ><?= $user_id ?></td>
        <td class = "table-main" ><?= $username ?></td>
        <td class = "table-main" ><?= $user_role ?></td>
        <td class = "table-main" ><?= $name ?></td>
    <?php
    }
}
else if($func == "employee"){
    $sql = "SELECT employee_id, lastname, firstname, middlename, sex, emp_address, contact_number, birthday FROM employee";
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
        <td class = "table-main" ><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $employee_id ?>'></td>
        <td class = "table-main" ><?= $employee_id ?></td>
        <td class = "table-main" ><?= $lastname ?></td>
        <td class = "table-main" ><?= $firstname ?></td>
        <td class = "table-main" ><?= $middlename ?></td>
        <td class = "table-main" ><?= $sex ?></td>
        <td class = "table-main" ><?= $emp_address ?></td>
        <td class = "table-main" ><?= $contact_number ?></td>
        <td class = "table-main" ><?= $birthday ?></td>
    </tr>
    <?php
    }
}
else if($func == "warehouse"){
    $sql = "SELECT warehouse_code, warehouse_name, warehouse_address, contact_no, CONCAT(employee.firstname, ' ', employee.lastname) AS employee FROM warehouses INNER JOIN employee USING (employee_id)";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $warehouse_code = $rows['warehouse_code'];
        $warehouse_name = $rows['warehouse_name'];
        $warehouse_address = $rows['warehouse_address'];         
        $contact =  $rows['contact_no'];
        $username =  $rows['employee'];
    ?>
    <tr id='tr_<?= $warehouse_code ?>' class ='tablerow'>
        <td class = "table-main" ><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $warehouse_code ?>'></td>
        <td class = "table-main" ><?= $warehouse_code ?></td>
        <td class = "table-main" ><?= $warehouse_name ?></td>
        <td class = "table-main" ><?= $warehouse_address ?></td>
        <td class = "table-main" ><?= $contact ?></td>
        <td class = "table-main" ><?= $username ?></td>
    <?php
    }
}
else if($func == 'wh_items'){

    $sql = "SELECT product_code, product_name, quantity, committed, warehouse_code FROM whse_items INNER JOIN products USING (product_code)";
    $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
    while($rows = mysqli_fetch_array($result)){
        $product_code = $rows['product_code'];
        $product_name = $rows['product_name'];        
        $items_total =  $rows['quantity'];
        $c_qty = $rows['committed'];
        $warehouse_code =  $rows['warehouse_code'];
    ?>
    <tr id='tr_<?= $product_code ?>' class ='tablerow'>
        <td class = "table-main" ></td>
        <td class = "table-main" ><?= $product_code?></td>
        <td class = "table-main" ><?= $product_name ?></td>
        <td class = "table-main" ><?= $items_total ?></td>
        <td class = "table-main" ><?= $c_qty ?></td>
        <td class = "table-main" ><?= $warehouse_code ?></td>
    <?php
    }
}

else if($func == "check_validity"){
    $pcode = $_POST['pcode'];
    $t_no = $_POST['t_no'];
    $query = "SELECT transaction_no, transaction_date, product_code, CONCAT ('-', rep_dur, tp1) AS replacement, CONCAT('-', s_warranty, tp2) AS s_warranty FROM sales_transaction INNER JOIN cart_items USING (transaction_no) INNER JOIN products USING (product_code) INNER JOIN warranty w ON w.id = products.warranty_code  WHERE product_code = '$pcode' AND transaction_no = '$t_no'";
    $result = mysqli_query($con, $query) or die($con->error);

    while($row = mysqli_fetch_array($result)) {
      $return = $row['replacement'];
      $s_wty = $row['s_warranty'];
      $tdate = strtotime($row['transaction_date']);
      if($tdate < strtotime($return)){ 
        if($tdate < strtotime($s_wty)){
          echo json_encode("invalid");
        }
        else{
          echo json_encode("wty_only");
        }
      }
      else{
        echo json_encode("valid");

        }
    }
  }
  else if($func == "check_validity_s"){
    $pcode = $_POST['pcode'];
    $t_no = $_POST['t_no'];
    $query = "SELECT purchase_order_id, order_date, product_code,  CONCAT('-', sp_warranty, tp3) AS M_warranty FROM purchase_order INNER JOIN item_orders USING (purchase_order_id) INNER JOIN products USING (product_code) INNER JOIN warranty w ON w.id = products.warranty_code WHERE product_code = '$pcode' AND purchase_order_id = '$t_no'";
    $result = mysqli_query($con, $query) or die($con->error);
    while($row = mysqli_fetch_array($result)) {
      $m_warranty = $row['M_warranty'];
      $tdate = strtotime($row['order_date']);
      if($tdate < strtotime($m_warranty)){ 
        echo json_encode("invalid");
      }
      else{
        echo json_encode("valid");
        }
    }
  }
?>

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
    $func = $_POST["func"];
    if($func == "disp"){
      $sql = "SELECT purchase_order_id, supplier_name AS supplier, total_price, order_date FROM purchase_order INNER JOIN supplier USING (supplier_id)";
      $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
      while($rows = mysqli_fetch_array($result)){
          $purchase_order_id = $rows['purchase_order_id'];
          $supplier_id = $rows['supplier'];
          $total_price = $rows['total_price'];
          $order_date = $rows['order_date'];
      ?>
      <tr id='tr_<?= $purchase_order_id ?>' class ='tablerow'>
          <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $purchase_order_id ?>'> </td>
          <td><?= $purchase_order_id ?></td>
          <td><?= $supplier_id ?></td>
          <td><?= $total_price ?></td>
          <td><?= $order_date ?></td>
          <td><button class = 'btn_view' value='<?= $purchase_order_id ?>'> View <span class = 'las la-eye'></span></button></td>
        </tr>
      <?php
      }
    }
    else if($func == "view"){
      $purchase_order_id =  $_POST['viewID'];
      $sql = "SELECT product_code, quantity, price_ea FROM item_orders WHERE purchase_order_id = '$purchase_order_id'";
      $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
     
      while($rows = mysqli_fetch_array($result)){
          $product_code = $rows['product_code'];
          $qty = $rows['quantity'];
          $price= $rows['price_ea'];
      ?>
      <tr id='tr_<?= $purchase_order_id ?>' class ='tablerow'>
          <td><?= $product_code ?></td>
          <td><?= $qty ?></td>
          <td><?= $price ?></td>
      <?php
      }
    }
    else if($func == "insert"){
        $purchase_order_id = $_POST['purchase_order_id'];
        $supplier_id = $_POST['supplier_ID'];
        $total_price = $_POST['total_price'];
        $input_date = $_POST['order_date'];
        $order_date = date("Y-m-d H:i:s",strtotime($input_date));

        $product_code = $_POST['product_code'];
        $quantity = $_POST['quantity'];
        $item_price = $_POST['price_ea'];
        $tNumber = $_POST['tNumber'];
        
        $mi = new MultipleIterator();

        $mi->attachIterator(new ArrayIterator($tNumber));
        $mi->attachIterator(new ArrayIterator($product_code));
        $mi->attachIterator(new ArrayIterator($quantity));
        $mi->attachIterator(new ArrayIterator($item_price));
        
        $sql = "INSERT INTO purchase_order (purchase_order_id, supplier_ID, total_price, order_date) VALUES (?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('iids', $purchase_order_id, $supplier_id, $total_price, $order_date);

        if ($stmt->execute()){
        $sql2 = "INSERT INTO item_orders (purchase_order_id, product_code, quantity, price_ea) VALUES (?,?,?,?)";
        $stmt2 = $con->prepare($sql2);
          foreach ($mi as $value ) {
            list($tNumber, $product_code, $quantity, $item_price) = $value;
            $stmt2->bind_param('isid', $tNumber, $product_code, $quantity, $item_price);
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
    if($func = "autosug"){
      if(isset($_POST["query"]))  
      {  
        $output = '';
        $query = "SELECT product_code FROM products WHERE product_code LIKE '%".
        $_POST["query"]."%'";
        $result = mysqli_query($con, $query);  
        $output = '<ul class="list-unstyled">';  
        if(mysqli_num_rows($result) > 0)  
        {  
            while($row = mysqli_fetch_array($result))  
            {  
                  $output .= '<li>'.$row["product_code"].'</li>';  
            }  
        }  
        else  
        {  
            $output .= '<li>Item Not Found</li>';  
        }  
        $output .= '</ul>';  
        echo $output;  
      }
    }
?>
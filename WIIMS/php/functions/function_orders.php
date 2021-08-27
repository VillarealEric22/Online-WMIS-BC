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
      $sql = "SELECT purchase_order_id, supplier_name AS supplier, itemsTotal, total_price, order_date, status FROM purchase_order INNER JOIN supplier USING (supplier_id) WHERE status = 'pending'";
      $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
      while($rows = mysqli_fetch_array($result)){
          $purchase_order_id = $rows['purchase_order_id'];
          $supplier_id = $rows['supplier'];
          $itemsTotal = $rows['itemsTotal'];
          $total_price = $rows['total_price'];
          $order_date = $rows['order_date'];
          $status = $rows['status'];
      ?>
      <tr id='tr_<?= $purchase_order_id ?>' class ='tablerow'>
          <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $purchase_order_id ?>'></td>
          <td><?= $purchase_order_id ?></td>
          <td><?= $supplier_id ?></td>
          <td><?= $itemsTotal ?></td>
          <td><?= $total_price ?></td>
          <td><?= $order_date ?></td>
          <td><?= $status ?></td>
          <td><button class = 'btn_view' value='<?= $purchase_order_id ?>'> View <span class = 'las la-eye'></span></button></td>
        </tr>
      <?php
      }
    }
    else if($func == "disp1"){
      $sql = "SELECT purchase_order_id, supplier_name AS supplier, itemsTotal, total_price, order_date, status FROM purchase_order INNER JOIN supplier USING (supplier_id) WHERE status = 'received'";
      $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
      while($rows = mysqli_fetch_array($result)){
          $purchase_order_id = $rows['purchase_order_id'];
          $supplier_id = $rows['supplier'];
          $itemsTotal = $rows['itemsTotal'];
          $total_price = $rows['total_price'];
          $order_date = $rows['order_date'];
          $status = $rows['status'];
      ?>
      <tr id='tr_<?= $purchase_order_id ?>' class ='tablerow'>
          <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $purchase_order_id ?>'></td>
          <td><?= $purchase_order_id ?></td>
          <td><?= $supplier_id ?></td>
          <td><?= $itemsTotal ?></td>
          <td><?= $total_price ?></td>
          <td><?= $order_date ?></td>
          <td><?= $status ?></td>
          <td><button class = 'btn_view' value='<?= $purchase_order_id ?>'> View <span class = 'las la-eye'></span></button></td>
        </tr>
      <?php
      }
    }
    else if($func == "view"){
      $purchase_order_id =  $_POST['viewID'];
      $sql = "SELECT product_code, product_name, quantity, price_ea FROM item_orders INNER JOIN products USING (product_code) WHERE purchase_order_id = '$purchase_order_id'";
      $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
     
      while($rows = mysqli_fetch_array($result)){
          $product_code = $rows['product_code'];
          $product_name = $rows['product_name'];
          $qty = $rows['quantity'];
          $price= $rows['price_ea'];
      ?>
      <tr id='tr_<?= $purchase_order_id ?>' class ='tablerow'>
          <td><?= $product_code ?></td>
          <td><?= $product_name ?></td>
          <td><?= $qty ?></td>
          <td><?= $price ?></td>
      <?php
      }
    }
    else if($func == "insert"){
        $purchase_order_id = $_POST['purchase_order_id'];
        $supplier_id = $_POST['supplier_ID'];
        $itemsTotal = $_POST['itemsTotal'];
        $total_price = $_POST['total_price'];
        $input_date = $_POST['order_date'];
        $order_date = date("Y-m-d H:i:s",strtotime($input_date));
        $status = $_POST['status'];

        $product_code = $_POST['product_code'];
        $quantity = $_POST['quantity'];
        $item_price = $_POST['price_ea'];
        $tNumber = $_POST['tNumber'];
        
        $mi = new MultipleIterator();

        $mi->attachIterator(new ArrayIterator($tNumber));
        $mi->attachIterator(new ArrayIterator($product_code));
        $mi->attachIterator(new ArrayIterator($quantity));
        $mi->attachIterator(new ArrayIterator($item_price));
        
        $sql = "INSERT INTO purchase_order (purchase_order_id, supplier_ID, itemsTotal total_price, order_date, status) VALUES (?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('iiidss', $purchase_order_id, $supplier_id, $total_price, $order_date, $status);

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
    if($func == "receive"){
      $id = $_POST['orderID'];
      $po_id = implode(',', $id);
      $sql = "UPDATE item_inventory AS ii, purchase_order AS po, (SELECT product_code, quantity, purchase_order_id FROM item_orders INNER JOIN purchase_order USING (purchase_order_id) WHERE purchase_order_id = (?)) AS io SET ii.pQty = (ii.pQty + io.quantity), curr_quantity = (curr_quantity + io.quantity), po.status = 'received' WHERE ii.product_code = io.product_code AND po.purchase_order_id IN (?)";
      $stmt = $con->prepare($sql);
      $stmt->bind_param('ii', $po_id, $po_id);
      if($stmt->execute()){
        echo "Successfully Created New Order Record";
      }
      else{
        echo "Data Not Saved". $con->error;
      }
    }
    if($func == "autosug"){
        $supid = $_POST["supid"];
        $query = "SELECT product_code, product_name FROM products WHERE supplier_id = '$supid'";
        $result = mysqli_query($con, $query) or die();
        $array = array();
        while($row = mysqli_fetch_array($result)){
          $array[] = $row;
        }
        echo json_encode($array);
    }
?>

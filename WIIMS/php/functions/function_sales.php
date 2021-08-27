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
      $sql = "SELECT transaction_no, CONCAT(firstname, ' ', lastname) AS customer, itemsTotal, total_price, transaction_date FROM sales_transaction INNER JOIN customer USING (customer_id)";
      $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
      while($rows = mysqli_fetch_array($result)){
          $transaction_no = $rows['transaction_no'];
          $customer_id = $rows['customer'];
          $itemsTotal = $rows['itemsTotal'];
          $total_price = $rows['total_price'];
          $transaction_date = $rows['transaction_date'];
      ?>
      <tr id='tr_<?= $transaction_no ?>' class ='tablerow'>
          <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $transaction_no ?>'> </td>
          <td><?= $transaction_no ?></td>
          <td><?= $customer_id ?></td>
          <td><?= $itemsTotal?></td>
          <td><?= $total_price ?></td>
          <td><?= $transaction_date ?></td>
          <td><button class = 'btn_view' value='<?= $transaction_no ?>'> View <span class = 'las la-eye'></span></button></td>
        </tr>
      <?php
      }
    }
    else if($func == "view"){
      $transaction_no =  $_POST['viewID'];
      $sql = "SELECT product_code, quantity, price_ea, price_tot FROM cart_items WHERE transaction_no = '$transaction_no'";
      $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
     
      while($rows = mysqli_fetch_array($result)){
          $product_code = $rows['product_code'];
          $qty = $rows['quantity'];
          $price= $rows['price_ea'];
          $pricet= $rows['price_tot'];
      ?>
      <tr id='tr_<?= $transaction_no ?>' class ='tablerow'>
          <td><?= $product_code ?></td>
          <td><?= $qty ?></td>
          <td><?= $price ?></td>
          <td><?= $pricet ?></td>
      <?php
      }
    }
    else if($func == "insert"){
        $transaction_no = $_POST['transaction_no'];
        $customer_id = $_POST['customer_ID'];
        $itemsTotal = $_POST['itemsTotal'];
        $total_price = $_POST['total_price'];
        $input_date = $_POST['transaction_date'];
        $transaction_date = date("Y-m-d H:i:s",strtotime($input_date));

        $product_code = $_POST['product_code'];
        $quantity = $_POST['quantity'];
        $item_price = $_POST['item_price'];
        $tot_price = $_POST['totprice'];
        $tNumber = $_POST['tNumber'];
        
        $mi = new MultipleIterator();

        $mi->attachIterator(new ArrayIterator($tNumber));
        $mi->attachIterator(new ArrayIterator($product_code));
        $mi->attachIterator(new ArrayIterator($quantity));
        $mi->attachIterator(new ArrayIterator($item_price));
        $mi->attachIterator(new ArrayIterator($tot_price));
        
        
        // Note for later: validate if quantity bought per item > curr_quantity
        // if true, echo not enough stock, cannot proceed purchase or **automatically order/redirect to order**
        $query = "SELECT product_code, curr_quantity FROM item_inventory";
        $stmtq = $con->prepare($query);
        foreach($mi as $val){
          list($tNumber, $product_code, $quantity, $item_price, $tot_price) = $val;
          $stmtq->bind_param('si',$product_code, $quantity);
        }

        //commit sale
        $sql = "INSERT INTO sales_transaction (transaction_no, customer_ID, itemsTotal, total_price, transaction_date) VALUES (?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('iiids', $transaction_no, $customer_id, $itemsTotal, $total_price, $transaction_date);

        if ($stmt->execute()){
        $sql2 = "INSERT INTO cart_items (transaction_no, product_code, quantity, price_ea, price_tot) VALUES (?,?,?,?,?)";
        $stmt2 = $con->prepare($sql2);
            foreach ($mi as $value) {
            list($tNumber, $product_code, $quantity, $item_price, $tot_price) = $value;
            $stmt2->bind_param('isidd', $tNumber, $product_code, $quantity, $item_price, $tot_price);
            if($stmt2->execute()){
              //deduct quantity to curr_quantity
              $sql3= "UPDATE item_inventory SET curr_quantity = (curr_quantity - ?) WHERE product_code = ?";
              $stmt3 = $con->prepare($sql3);
                foreach ($mi as $value1) {
                  list($tNumber, $product_code, $quantity, $item_price, $tot_price) = $value1;
                  $stmt3->bind_param('is', $quantity, $product_code);
                  $stmt3->execute();
                }
            }   
          }
          echo "Successfully created sales record";
        }
       else{
          echo "Data Not Saved". $con->error;
        }
      $stmt->close();
      $con->close();
    }
?>
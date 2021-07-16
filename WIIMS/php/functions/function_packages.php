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
      $sql = "SELECT package_code, total_price FROM packages";
      $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
      while($rows = mysqli_fetch_array($result)){
          $package_code = $rows['package_code'];
          $total_price = $rows['total_price'];
      ?>
      <tr id='tr_<?= $package_code ?>' class ='tablerow'>
          <td><input type='checkbox' name='selectable[]' class = "selectable" value='<?= $package_code ?>'> </td>
          <td><?= $package_code ?></td>
          <td><?= $total_price ?></td>
          <td><button class = 'btn_view' value='<?= $package_code ?>'> View <span class = 'las la-eye'></span></button></td>
        </tr>
      <?php
      }
    }
    else if($func == "view"){
      $package_code =  $_POST['viewID'];
      $sql = "SELECT product_code, quantity FROM package_items WHERE package_code = '$package_code'";
      $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
     
      while($rows = mysqli_fetch_array($result)){
          $product_code = $rows['product_code'];
          $qty = $rows['quantity'];
      ?>
      <tr id='tr_<?= $package_code ?>' class ='tablerow'>
          <td><?= $product_code ?></td>
          <td><?= $qty ?></td>
      <?php
      }
    }
    else if($func == "insert"){
        $package_code = $_POST['package_code'];
        $package_price = $_POST['package_price'];
        $product_code = $_POST['product_code'];
        $quantity = $_POST['quantity'];
        $pckgCD = $_POST['pkgcd'];

        
        $mi = new MultipleIterator();
        $mi->attachIterator(new ArrayIterator($product_code));
        $mi->attachIterator(new ArrayIterator($quantity));
        $mi->attachIterator(new ArrayIterator($pckgCD));

        $sql = "INSERT INTO packages (package_code, total_price) VALUES (?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sd', $package_code, $package_price);

        if ($stmt->execute()){
        $sql2 = "INSERT INTO package_items (product_code, quantity, package_code) VALUES (?,?,?)";
        $stmt2 = $con->prepare($sql2);
          foreach ( $mi as $value ) {
            list($product_code, $quantity, $pckgCD) = $value;
            $stmt2->bind_param('sis', $product_code, $quantity, $pckgCD);
            $stmt2->execute();
          }
          echo "Successfully Created New Package";
        }
       else{
          echo "Data Not Saved". $con->error;
        }
      $stmt->close();
      $con->close();
    }
    /*else if($func == "update"){
      $package_code = $_POST['package_code'];
      $package_price = $_POST['package_price'];
      $product_code = $_POST['product_code'];
      $quantity = $_POST['quantity'];
      $pckgCD = $_POST['pkgcd'];
      
      $mi = new MultipleIterator();
      $mi->attachIterator(new ArrayIterator($product_code));
      $mi->attachIterator(new ArrayIterator($quantity));
      $mi->attachIterator(new ArrayIterator($pckgCD));

      $sql = "UPDATE packages SET total_price = ? WHERE package_code = ?";
      $stmt = $con->prepare($sql);
      $stmt->bind_param('sd', $package_code, $package_price);

      if ($stmt->execute()){
      $sql2 = "UPDATE package_items SET product_code = ?, quantity = ? WHERE package_code = ?";
      $stmt2 = $con->prepare($sql2);
        foreach ( $mi as $value ) {
          list($product_code, $quantity, $pckgCD) = $value;
          $stmt2->bind_param('sis', $product_code, $quantity, $pckgCD);
          $stmt2->execute();
        }
        echo "Successfully Created New Package";
      }
     else{
        echo "Data Not Saved". $con->error;
      }
    $stmt->close();
    $con->close();
    }
    */
    else if($func == "delete"){
      $package_code = $_POST['deleteID'];
      $total = count($package_code);
      $package_code = implode(',', $package_code);

      $sql =  "DELETE FROM package_items WHERE package_code IN ('$package_code')";
      $result = mysqli_query($con, $sql);

      if ($result === true) {
        
        $sql2 = "DELETE FROM packages WHERE package_code IN ('$package_code')";
        $result2 = mysqli_query($con, $sql2);

        echo $total. " items successfully deleted";
      }else{
        echo "Data Not Saved". $con->error;
      }
            
    }
    else if($func == "auto_input"){
      $edit_id = $_POST['edit_id'];

      $sql = "SELECT package_code, total_price FROM packages WHERE package_code = '$edit_id'";
      $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
      $rows = mysqli_fetch_array($result);
      /*
      $sql2 = "SELECT product_code, quantity FROM package_items WHERE package_code = '$edit_id'";
      $result2 = mysqli_query($con,$sql2) or die($con->error); //or die($con->error) is for debugging of SQL Query
      while($rows2 = mysqli_fetch_array($result2)){
          $product_code = $rows2['product_code'];
          $qty = $rows2['quantity'];
      ?>
      <tr id='tr_<?= $package_code ?>' class ='tablerow'>
        <td class = 'pkgitem'><?= $product_code ?></td>
        <td><input class ='small-input itemqty' type='number' min='0' value = '<?= $qty ?>'></td>
        <td><button class = 'removeItem'><span class='las la-trash'></span></button></td>
      </tr>
      <?php
      }
      */
      echo json_encode($rows);
    }
    else if($func == "auto_sug"){

    }
?>
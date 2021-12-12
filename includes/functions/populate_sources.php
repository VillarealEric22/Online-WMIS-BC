<?php
    include('../db.php');

    $func = $_POST['func'];
    if ($func == "customer"){

        $query = "SELECT customer_id, c_name FROM customer";
        $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $array = array();
        while($row = mysqli_fetch_array($result)){
          $array[] = $row;
        }
        echo json_encode($array);
    }
    else if($func == "supplier"){

        $query = "SELECT supplier_id, supplier_name FROM supplier";
        $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $array = array();
        while($row = mysqli_fetch_array($result)){
          $array[] = $row;
        }
        echo json_encode($array);
    }
    else if($func == "productCategory"){

        $query = "SELECT product_type FROM product_category";
        $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $array = array();
        while($row = mysqli_fetch_array($result)){
          $array[] = $row;
        }
        echo json_encode($array);
    }
    else if($func == "warrantyCode"){

        $query = "SELECT warranty_code FROM warranty";
        $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $array = array();
        while($row = mysqli_fetch_array($result)){
          $array[] = $row;
        }
        echo json_encode($array);
    }
    else if($func == "warehouse_code"){

        $query = "SELECT warehouse_code, warehouse_name FROM warehouses";
        $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $array = array();
        while($row = mysqli_fetch_array($result)){
          $array[] = $row;
        }
        echo json_encode($array);
    }
    else if($func == "warehouse_pull"){
      $product = $_POST['product'];
      $query = "SELECT warehouse_code, warehouse_name FROM whse_items INNER JOIN warehouses USING(warehouse_code) WHERE product_code = '$product' AND quantity !=0 ";
      $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
      $array = array();
      while($row = mysqli_fetch_array($result)){
        $array[] = $row;
      }
      echo json_encode($array);
  }
    else if($func == "wh_dest"){
        $wh_code = $_POST["id"];
        $query = "SELECT warehouse_code, warehouse_name FROM warehouses WHERE warehouse_code != '$wh_code'";
        $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $array = array();
        while($row = mysqli_fetch_array($result)){
          $array[] = $row;
        }
        echo json_encode($array);
    }
    else if($func == "transaction_no"){
      $query = "SELECT transaction_no, transaction_date FROM sales_transaction";
      $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
      $array = array();
      while($row = mysqli_fetch_array($result)){
        $array[] = $row;
      }
      echo json_encode($array);
    }
    else if($func == "order_no"){
        $query = "SELECT purchase_order_id, order_date FROM purchase_order WHERE status = 'completed'";
        $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $array = array();
        while($row = mysqli_fetch_array($result)){
          $array[] = $row;
        }
        echo json_encode($array);
    }
    else if($func == "transfer"){

        $query = "SELECT `transfer_id`, `warehouse_dest` FROM `transfer` WHERE status = 'approved' OR status = 'incomplete'";
        $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $array = array();
        while($row = mysqli_fetch_array($result)){
          $array[] = $row;
        }
        echo json_encode($array);
    }
    else if($func == "transfer-dest"){
      $id = $_POST['id'];
      $query = "SELECT `warehouse_dest` FROM `transfer` WHERE transfer_id = '$id'";
      $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
      $array = array();
      while($row = mysqli_fetch_array($result)){
        $array[] = $row;
      }
      echo json_encode($array);
  }
    else if($func == "inventory"){

        $query = "SELECT purchase_order_id FROM purchase_order WHERE status != 'completed'";
        $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $array = array();
        while($row = mysqli_fetch_array($result)){
          $array[] = $row;
        }
        echo json_encode($array);
    }
    else if($func == "product"){

      $query = "SELECT product_code, product_name FROM products";
      $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
      $array = array();
      while($row = mysqli_fetch_array($result)){
        $array[] = $row;
      }
      echo json_encode($array);
    }
    else if($func == "product_s"){
      $id = $_POST['id'];
      $query = "SELECT product_code, product_name FROM products WHERE supplier_id = '$id'";
      $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
      $array = array();
      while($row = mysqli_fetch_array($result)){
        $array[] = $row;
      }
      echo json_encode($array);
    }
    else if($func == "manager"){

      $query = "SELECT employee_id, CONCAT(employee.firstname, ' ', employee.lastname) AS employee FROM employee";
      $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
      $array = array();
      while($row = mysqli_fetch_array($result)){
        $array[] = $row;
      }
      echo json_encode($array);
    }
    else if($func == "employee"){
      
      $query = "SELECT employee_id, CONCAT(employee.firstname, ' ', employee.lastname) AS employee FROM employee";
      $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
      $array = array();
      while($row = mysqli_fetch_array($result)){
        $array[] = $row;
      }
      echo json_encode($array);

    }
    else if($func == "wh_item"){
      $id = $_POST['id'];
      $query = "SELECT product_code, product_name FROM whse_items INNER JOIN products USING (product_code) WHERE warehouse_code = '$id'";
      $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
      $array = array();
      while($row = mysqli_fetch_array($result)){
        $array[] = $row;
      }
      echo json_encode($array);
    }
    else if ($func == "wh_item_wh") {
      $id = $_POST['id'];
      $query = "SELECT warehouse_code FROM whse_items  WHERE product_code = '$id' && quantity != 0";
      $result = mysqli_query($con,$query) or die($con->error); //or die($con->error) is for debugging of SQL Query
      $array = array();
      while($row = mysqli_fetch_array($result)){
        $array[] = $row;
      }
      echo json_encode($array);
    }
?>
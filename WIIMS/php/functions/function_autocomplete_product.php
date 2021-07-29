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
    if($func == "autosug"){
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
    else if($func == "autoprice"){
      $id = $_POST['id'];
      $sql = "SELECT item_price FROM products WHERE product_code = '$id'";
      $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
      $rows = mysqli_fetch_array($result);

      echo json_encode($rows);
    }
?>
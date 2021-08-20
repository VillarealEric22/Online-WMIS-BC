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
    $func = $_POST['func'];
    if($func == 'sales_report'){
        $fromdate = date("Y-m-d H:i:s",strtotime($_POST['from']));
        $todate = date("Y-m-d H:i:s",strtotime($_POST['to']));

        $sql = "SELECT DATE(sales_transaction.transaction_date) AS date, COUNT(sales_transaction.transaction_no) AS transactions, SUM(cart_items.quantity) AS itemsold, 
                SUM(sales_transaction.total_price) AS total FROM sales_transaction INNER JOIN cart_items ON sales_transaction.transaction_no = cart_items.transaction_no 
                WHERE sales_transaction.transaction_date BETWEEN '".$fromdate."'AND '".$todate."' GROUP BY date";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $transactions = $rows['transactions'];
            $total_price = $rows['total'];
            $itemsold = $rows['itemsold'];
            $transaction_date = $rows['date'];
        ?>
        <tr id='tr_<?= $transaction_no ?>' class ='tablerow'>
            <td><?= $transaction_date ?></td>
            <td><?= $transactions ?></td>
            <td><?= $itemsold ?></td>
            <td><?= $total_price ?></td>
            </tr>
        <?php
        }
    }
    else if($func == 'product_performance'){
        $fromdate = date("Y-m-d H:i:s",strtotime($_POST['from']));
        $todate = date("Y-m-d H:i:s",strtotime($_POST['to']));
                //NOTES(baka makalimutan): select all transactions from date range, then select all the products, then sum all quantities per product, then select all orders, then same principle, then sold/recieved = STR
                //COGS take from inventory
                
        $sql = "SELECT p.product_code AS products, ci.itemsold, itemsreturned, total, IFNULL(SUM(IFNULL(ci.quantity,0) * IFNULL(ior.price_ea,0)),0) AS COGS, IFNULL((IFNULL(total,0) - IFNULL(SUM(IFNULL(ci.quantity,0) * IFNULL(ior.price_ea,0)),0)),0) AS GProfit, IFNULL(ci.itemsold/ii.inv,0)*100 AS sellthrough, (IFNULL(SUM(IFNULL(ci.quantity,0) * IFNULL(ior.price_ea,0)),0)/IFNULL(total,0))*100 AS margin 
        FROM (SELECT transaction_no, transaction_date FROM sales_transaction WHERE sales_transaction.transaction_date BETWEEN '".$fromdate."' AND '".$todate."') st 
                LEFT JOIN (SELECT transaction_no, product_code, quantity, price_ea, IFNULL(SUM(quantity), 0) AS itemsold, IFNULL(SUM(IFNULL(quantity,0) * IFNULL(price_ea,0)),0) AS total FROM cart_items GROUP BY product_code) ci ON (st.transaction_no = ci.transaction_no) 
                LEFT JOIN (SELECT product_code from products) p ON (ci.product_code = p.product_code)
                LEFT JOIN (SELECT product_code, SUM(bQty + pQty) AS inv, SUM(IFNULL(bQty,0)) AS quant FROM item_inventory WHERE item_inventory.date_created BETWEEN '".$fromdate."' AND '".$todate."' GROUP BY product_code) ii ON(p.product_code = ii.product_code) 
                LEFT JOIN (SELECT product_code, quantity, SUM(IFNULL(quantity,0)) AS itemsreturned FROM item_returns WHERE item_returns.return_date BETWEEN '".$fromdate."' AND '".$todate."' GROUP BY product_code) ir ON(p.product_code = ir.product_code)
                LEFT JOIN (SELECT purchase_order_id, order_date FROM purchase_order WHERE order_date BETWEEN '".$fromdate."' AND '".$todate."') po ON true
                LEFT JOIN (SELECT purchase_order_id, product_code, quantity, price_ea FROM item_orders GROUP BY product_code) ior ON (p.product_code = ior.product_code)
                GROUP BY p.product_code";

        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $products = $rows['products'];
            $revenue = $rows['total'];
            $itemsold = $rows['itemsold'];
            $itemsreturned = $rows['itemsreturned'];
            $COGS = $rows['COGS'];
            $GProfit = $rows['GProfit'];
            $sellthrough = $rows['sellthrough'];
            $margin= $rows['margin'];
        ?>
        <tr id='tr_<?= $transaction_no ?>' class ='tablerow'>
            <td><?= $products ?></td>
            <td><?= $itemsold ?></td>
            <td><?= $itemsreturned ?></td>
            <td><?= $revenue ?></td>
            <td><?= $COGS ?></td>
            <td><?= $GProfit ?></td>
            <td><?= $sellthrough ?></td>
            <td><?= $margin ?></td>
            </tr>
        <?php
        }
    }
    else if($func == 'inventory_report'){

    }
?>
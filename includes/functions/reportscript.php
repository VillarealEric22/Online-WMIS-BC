<?php
include('../db.php');
$func = $_POST['func'];
    if($func == 'sales_report'){

        $fromdate = date("Y-m-d",strtotime($_POST['from']));
        $todate = date("Y-m-d",strtotime($_POST['to']));

        $sql = "SELECT product_code, COUNT(cart_items.transaction_no) AS transactions, IFNULL(SUM(quantity), 0) AS itemsold, IFNULL(SUM(IFNULL(quantity,0) * IFNULL(price_ea,0)),0) AS total FROM cart_items, 
        (SELECT sales_transaction.transaction_no, transaction_date FROM sales_transaction WHERE sales_transaction.transaction_date BETWEEN '".$fromdate."' AND '".$todate."') so WHERE cart_items.transaction_no = so.transaction_no
        GROUP BY product_code";

        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $transactions = $rows['transactions'];
            $itemsold = $rows['itemsold'];
            $total = $rows['total'];
            $product =$rows['product_code'];
            ?>
            <tr id='tr_<?= $report_id ?>' class ='tablerow'>
                <td class = "table-main" ><?= $product ?></td>
                <td class = "table-main" ><?= $itemsold ?></td>
                <td class = "table-main" ><?= $transactions ?></td>
                <td class = "table-main" ><?= $total ?></td>
            </tr>
            <?php
        }
    }
    else if($func == 'top_sales'){

        $fromdate = date("Y-m-d",strtotime($_POST['from']));
        $todate = date("Y-m-d",strtotime($_POST['to']));

        $sql = "SELECT product_code, COUNT(cart_items.transaction_no) AS transactions, IFNULL(SUM(quantity), 0) AS itemsold, IFNULL(SUM(IFNULL(quantity,0) * IFNULL(price_ea,0)),0) AS total FROM cart_items, 
        (SELECT sales_transaction.transaction_no, transaction_date FROM sales_transaction WHERE sales_transaction.transaction_date BETWEEN '".$fromdate."' AND '".$todate."') so WHERE cart_items.transaction_no = so.transaction_no
        GROUP BY product_code ORDER BY itemsold DESC LIMIT 5";

        $result = mysqli_query($con,$sql) or die($con->error);
        $data = array();

        foreach ($result as $row) {
            $data[] = array(
                'products'   => $row['product_code'],
                'itemsold'   => $row['itemsold'],
                'color'      => '#' . rand(100000, 999999) . ''
            );
        }
        echo json_encode($data);
    }
    else if($func == "trans-today"){
        $fromdate = date("Y-m-d",strtotime($_POST['from']));
        
        $sql = "SELECT IFNULL(COUNT(transaction_no),0) AS total_items FROM sales_transaction WHERE transaction_date BETWEEN '".$fromdate."' AND '".$fromdate."'";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);   
    }
    else if($func == "sales-today"){
        $fromdate = date("Y-m-d",strtotime($_POST['from']));

        $sql = "SELECT IFNULL(SUM(total_price),0) AS total_items FROM sales_transaction WHERE transaction_date BETWEEN '".$fromdate."' AND '".$fromdate."'";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);   
    }
    else if($func == "sales-month"){
        $fromdate = date("Y-m-d",strtotime($_POST['from']));
        $todate = date("Y-m-d",strtotime($_POST['to']));

        $sql = "SELECT IFNULL(SUM(total_price),0) AS total_items FROM sales_transaction WHERE transaction_date BETWEEN '".$fromdate."' AND '".$todate."'";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);   
    }
    else if($func == "trans-today"){
        $fromdate = date("Y-m-d",strtotime($_POST['from']));

        $sql = "SELECT IFNULL(SUM(total_price),0) AS total_items FROM sales_transaction WHERE transaction_date BETWEEN '".$fromdate."' AND '".$fromdate."'";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);   
    }
    else if($func == "sales"){
        $sql = "SELECT `transaction_no`, `c_name`, `itemsTotal`, `total_price`, `transaction_date`, CONCAT(employee.firstname, ' ', employee.lastname) AS employee FROM sales_transaction LEFT JOIN customer USING (customer_id) INNER JOIN employee USING(employee_id) ORDER BY transaction_date DESC LIMIT 10";
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
            <td class = "table-main" ><?= $transaction_no ?></td>
            <td class = "table-main" ><?= $customer_id ?></td>
            <td class = "table-main" ><?= $itemsTotal?></td>
            <td class = "table-main" ><?= $total_price ?></td>
            <td class = "table-main" ><?= $transaction_date ?></td>
        </tr>
        <?php
        }
    }
    else if($func == "customer"){
        $sql = "SELECT `transaction_no`, `c_name`, `c_address`,`total_price`, `transaction_date` FROM sales_transaction LEFT JOIN customer USING (customer_id) ORDER BY transaction_date DESC LIMIT 10";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $transaction_no = $rows['transaction_no'];
            $customer_id = $rows['c_name'];
            $customer_add = $rows['c_address'];
            $total_price = $rows['total_price'];
            $transaction_date = $rows['transaction_date'];
        ?>
        <tr  class ='tablerow'>
            <td class = "table-main" ><h4><?= $customer_id ?><br><span><?= $customer_add ?></span></h4></td>
            <td class = "table-main" ><h4>&#8369; <?= $total_price ?></h4></td>
        </tr>
        <?php
        }
    }
    else if ($func == "recent_orders"){
        $sql = "SELECT purchase_order_id, order_date, items_total, total_price FROM purchase_order ORDER BY order_date DESC LIMIT 10 ";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $id = $rows['purchase_order_id'];
            $items_total = $rows['items_total'];
            $total_price =  $rows['total_price'];            
            ?>
                <tr id='tr_<?= $id ?>' class ='tablerow'>
                    <td class = "table-main" ><?= $id ?></td>
                    <td class = "table-main" ><?= $items_total ?></td>
                    <td class = "table-main" >₱ <?= $total_price?></td>
                </tr>
            <?php
        }
    }
    else if ($func == "lowStock"){
        $sql = "SELECT p.product_code, p.product_name, p.product_type, p.item_price, w.qty FROM (SELECT product_code, product_name, product_type, item_price, rop_min FROM products)p LEFT JOIN (SELECT product_code, IFNULL(SUM(quantity),0) AS qty FROM whse_items GROUP BY product_code) w USING (product_code) WHERE qty < rop_min GROUP BY product_code";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $product_code = $rows['product_code'];
            $product_name = $rows['product_name'];
            $product_type =  $rows['product_type'];            
            $qty =  $rows['qty'];
            $item_price =  $rows['item_price'];
            ?>
                <tr id='tr_<?= $product_code ?>' class ='tablerow'>
                    <td class = "table-main" ><?= $product_code ?></td>
                    <td class = "table-main" ><?= $product_name ?></td>
                    <td class = "table-main" ><?= $qty?></td>
                </tr>
            <?php
        }
    }
    else if ($func == "lowStock2"){
        $sql = "SELECT IFNULL(COUNT(p.product_code),0) AS total_items FROM (SELECT product_code, rop_min FROM products) p LEFT JOIN (SELECT product_code, IFNULL(SUM(quantity),0) AS qty FROM whse_items GROUP BY product_code) w USING (product_code) WHERE qty < rop_min";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        $rows = mysqli_fetch_array($result);
        echo json_encode($rows);       
    }
    else if ($func == "ptype_stats"){
        $edit_id = $_POST['id'];
        $sql = "SELECT product_code, product_name FROM product_category INNER JOIN products USING (product_type) WHERE id = $edit_id";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $product_code = $rows['product_code'];
            $product_name = $rows['product_name'];
            ?>
                <tr id='tr_<?= $product_code ?>' class ='tablerow'>
                    <td class = "table-main" ><?= $product_code ?></td>
                    <td class = "table-main" ><?= $product_name ?></td>
                </tr>
            <?php
        }
    }
    else if ($func == "wty_stats"){
        $edit_id = $_POST['id'];
        $sql = "SELECT product_code, product_name FROM warranty INNER JOIN products USING (warranty_code) WHERE id = $edit_id";
        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $product_code = $rows['product_code'];
            $product_name = $rows['product_name'];
            ?>
                <tr id='tr_<?= $product_code ?>' class ='tablerow'>
                    <td class = "table-main" ><?= $product_code ?></td>
                    <td class = "table-main" ><?= $product_name ?></td>
                </tr>
            <?php
        }
    }
    else if($func == 'ppi'){

        $fromdate = date("Y-m-d",strtotime($_POST['from']));
        $todate = date("Y-m-d",strtotime($_POST['to']));
        
        $sql = "SELECT p.product_code AS products, IFNULL(ii.quantity,0) AS available, IFNULL(itemsold,0) AS itemsold, IFNULL(itemsreturned,0) AS itemsreturned_c, IFNULL(total,0) AS total, IFNULL(itembought,0) AS item_bought, IFNULL(total_buy,0) AS total_buy, ROUND(IFNULL(IFNULL(ci.itemsold/ioi.itembought,0)*100,0),2) AS sellthrough
        FROM (SELECT product_code from products) p 
        LEFT JOIN (SELECT product_code, quantity FROM whse_items GROUP BY product_code) ii ON (p.product_code = ii.product_code) 
        LEFT JOIN (SELECT cart_items.transaction_no, product_code, quantity, price_ea, IFNULL(SUM(quantity), 0) AS itemsold, IFNULL(SUM(IFNULL(quantity,0) * IFNULL(price_ea,0)),0) AS total FROM cart_items, (SELECT sales_transaction.transaction_no, transaction_date FROM sales_transaction WHERE sales_transaction.transaction_date BETWEEN '$fromdate' AND '$todate') AS st WHERE cart_items.transaction_no = st.transaction_no GROUP BY product_code) ci ON (p.product_code = ci.product_code)
        LEFT JOIN (SELECT item_orders.purchase_order_id, product_code, quantity, price, IFNULL(SUM(quantity), 0) AS itembought, IFNULL(SUM(IFNULL(quantity,0) * IFNULL(price,0)),0) AS total_buy FROM item_orders, (SELECT purchase_order.purchase_order_id, order_date FROM purchase_order WHERE purchase_order.order_date BETWEEN '$fromdate' AND '$todate') AS io WHERE item_orders.purchase_order_id = io.purchase_order_id GROUP BY product_code) ioi ON (p.product_code = ioi.product_code)
        LEFT JOIN (SELECT item_returns_pd.return_id, product_code, SUM(IFNULL(quantity,0)) AS itemsreturned, item_price, IFNULL(SUM(quantity), 0) AS itemreturns FROM item_returns_pd, (SELECT item_returns.return_id, return_date FROM item_returns WHERE item_returns.return_date BETWEEN '$fromdate' AND '$todate') AS ir WHERE item_returns_pd.return_id = ir.return_id GROUP BY product_code) irp ON (p.product_code = irp.product_code)
        GROUP BY p.product_code";       

        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $products = $rows['products'];
            $revenue = $rows['total'];
            $itemsold = $rows['itemsold'];
            $itemsbought = $rows['item_bought'];
            $total_buy = $rows['total_buy'];
            $itemsreturned = $rows['itemsreturned_c'];
            $sellthrough = $rows['sellthrough'];
            $items_available = $rows['available'];
            ?>
            <tr id='tr_<?= $products ?>' class ='tablerow'>
                <td class = "table-main" ><?= $products ?></td>    
                <td class = "table-main" ><?= $items_available ?></td>       
                <td class = "table-main" ><?= $itemsold ?></td>
                <td class = "table-main" ><?= $revenue ?></td>
                <td class = "table-main" ><?= $itemsbought ?></td>
                <td class = "table-main" ><?= $total_buy ?></td>
                <td class = "table-main" ><?= $itemsreturned ?></td>
                <td class = "table-main" ><?= $sellthrough ?></td>
            </tr>
        <?php
        }
    }
    else if($func == 'safety'){

        $fromdate = date("Y-m-d",strtotime($_POST['from']));
        $todate = date("Y-m-d",strtotime($_POST['to']));
        
        $sql = "SELECT ss.product_code, ss.max_daily_usage, ss.maxlead, ROUND(ss.avg_daily_usage,2) AS avg_daily_usage, CONCAT(ss.avglead, ' days') AS avglead, IFNULL(CEILING(IFNULL(ss.maxlead*ss.max_daily_usage,0)-IFNULL(ss.avglead*ss.avg_daily_usage,0)),0) AS safety_stock, CEILING(IFNULL((ss.avglead * ss.avg_daily_usage),0) + IFNULL(CEILING(IFNULL(ss.maxlead*ss.max_daily_usage,0)-IFNULL(ss.avglead*ss.avg_daily_usage,0)),0)) AS rop FROM (SELECT p.product_code, IFNULL(max(s.maxsale),0) AS max_daily_usage, IFNULL(avg(s.avgsale),0) AS avg_daily_usage, IFNULL(CONCAT(MAX(COALESCE(CAST((Cast(IFNULL(o.date_created,0) AS DATE) - Cast(IFNULL(o.order_date,0) AS DATE)) AS VARCHAR(20)), 'n/a')), ' days'),0) AS maxlead, IFNULL(avg(COALESCE(CAST((Cast(IFNULL(o.date_created,0) AS DATE) - Cast(IFNULL(o.order_date,0) AS DATE)) AS VARCHAR(20)), 'n/a')),0) AS avglead, o.order_date, o.date_created FROM products p LEFT JOIN  
        (SELECT transaction_no, transaction_date, product_code, max(quantity) as maxsale, AVG(quantity) as avgsale FROM sales_transaction INNER JOIN cart_items USING (transaction_no) WHERE transaction_date BETWEEN '$fromdate' AND '$todate' GROUP BY product_code, transaction_date) s ON s.product_code = p.product_code
        LEFT JOIN (SELECT odr.product_code, odr.order_date, rec.date_created FROM (SELECT purchase_order_id, product_code, order_date FROM purchase_order INNER JOIN item_orders USING(purchase_order_id) WHERE order_date BETWEEN '$fromdate' AND '$todate' GROUP BY product_code) odr 
        INNER JOIN (SELECT purchase_order_id, product_code, date_created FROM inventory INNER JOIN inventory_items USING (inventory_id))rec USING (purchase_order_id)) o ON o.product_code = p.product_code WHERE ro_categ != 'JIT' GROUP BY product_code)ss GROUP BY product_code ORDER BY rop DESC;";       

        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            $products = $rows['product_code'];
            $max_daily_usage = $rows['max_daily_usage'];
            $maxlead = $rows['maxlead'];
            $avg_daily_usage = $rows['avg_daily_usage'];
            $avglead = $rows['avglead'];
            $safety_stock = $rows['safety_stock'];
            $rop = $rows['rop'];
            ?>
            <tr id='tr_<?= $products ?>' class ='tablerow'>
                <td class = "table-main" ><input type='checkbox' id = toggle name='selectable[]' class = "selectable" value='<?= $products ?>'></td>
                <td class = "table-main" ><?= $products ?></td>    
                <td class = "table-main" ><?= $max_daily_usage ?></td>  
                <td class = "table-main" ><?= $avg_daily_usage ?></td>     
                <td class = "table-main" ><?= $maxlead ?></td>
                <td class = "table-main" ><?= $avglead ?></td>
                <td class = "table-main" ><?= $safety_stock ?></td>
                <td class = "table-main" ><?= $rop ?></td>
            </tr>
        <?php
        }
    }
    else if($func == 'pareto'){
    
        $fromdate = date("Y-m-d",strtotime($_POST['from']));
        $todate = date("Y-m-d",strtotime($_POST['to']));


        $sql = "SELECT products, itemsold, consumption, totalsold, total_consumption, ROUND(IFNULL(IFNULL(itemsold/totalsold,0)*100,0),2) AS sales_vol,  ROUND(IFNULL(IFNULL(consumption/total_consumption,0)*100,0),2) AS consumption_vol, CASE 
        WHEN SUM(itemsold) OVER (ORDER BY itemsold DESC)/SUM(itemsold) OVER () <= .7 THEN 'A'
        WHEN SUM(itemsold) OVER (ORDER BY itemsold DESC)/SUM(itemsold) OVER () <= .9 THEN 'B'
        ELSE 'C' END AS class FROM (SELECT SUM(s.itemsold) AS totalsold, SUM(s.consumption) AS total_consumption FROM (SELECT p.product_code AS products, IFNULL(itemsold,0) AS itemsold, ROUND(IFNULL(ioi.price,0),2) AS cpu, IFNULL(total,0) AS consumption
        FROM (SELECT product_code from products) p 
        LEFT JOIN (SELECT product_code, quantity FROM whse_items GROUP BY product_code) ii ON (p.product_code = ii.product_code) 
        LEFT JOIN (SELECT cart_items.transaction_no, product_code, quantity, price_ea, IFNULL(SUM(quantity), 0) AS itemsold, IFNULL(SUM(IFNULL(quantity,0) * IFNULL(price_ea,0)),0) AS total FROM cart_items, (SELECT sales_transaction.transaction_no, transaction_date FROM sales_transaction WHERE sales_transaction.transaction_date BETWEEN '$fromdate' AND '$todate') AS st WHERE cart_items.transaction_no = st.transaction_no GROUP BY product_code) ci ON (p.product_code = ci.product_code)
        LEFT JOIN (SELECT item_orders.purchase_order_id, product_code, AVG(price) as price FROM item_orders, (SELECT purchase_order.purchase_order_id, order_date FROM purchase_order WHERE purchase_order.order_date BETWEEN '$fromdate' AND '$todate') AS io WHERE item_orders.purchase_order_id = io.purchase_order_id GROUP BY product_code) ioi ON (p.product_code = ioi.product_code)
        GROUP BY p.product_code) s)t CROSS JOIN (SELECT p.product_code AS products, IFNULL(itemsold,0) AS itemsold, ROUND(IFNULL(ioi.price,0),2) AS cpu, IFNULL(total,0) AS consumption
        FROM (SELECT product_code from products) p 
        LEFT JOIN (SELECT product_code, quantity FROM whse_items GROUP BY product_code) ii ON (p.product_code = ii.product_code) 
        LEFT JOIN (SELECT cart_items.transaction_no, product_code, quantity, price_ea, IFNULL(SUM(quantity), 0) AS itemsold, IFNULL(SUM(IFNULL(quantity,0) * IFNULL(price_ea,0)),0) AS total FROM cart_items, (SELECT sales_transaction.transaction_no, transaction_date FROM sales_transaction WHERE sales_transaction.transaction_date BETWEEN '$fromdate' AND '$todate') AS st WHERE cart_items.transaction_no = st.transaction_no GROUP BY product_code) ci ON (p.product_code = ci.product_code)
        LEFT JOIN (SELECT item_orders.purchase_order_id, product_code, AVG(price) as price FROM item_orders, (SELECT purchase_order.purchase_order_id, order_date FROM purchase_order WHERE purchase_order.order_date BETWEEN '$fromdate' AND '$todate') AS io WHERE item_orders.purchase_order_id = io.purchase_order_id GROUP BY product_code) ioi ON (p.product_code = ioi.product_code)
        GROUP BY p.product_code) v GROUP BY v.products ORDER BY v.consumption DESC";

        $result = mysqli_query($con,$sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
        while($rows = mysqli_fetch_array($result)){
            
            $products = $rows['products'];
            $itemsold = $rows['itemsold'];
            $consumption = $rows['consumption'];
            $total_s = $rows['totalsold'];
            $total_c = $rows['total_consumption'];
            $sales_vol = $rows['sales_vol'];
            $consumption_vol = $rows['consumption_vol'];
            $class = $rows['class'];

        ?>
        <tr id='tr_<?= $products?>' class ='tablerow'>       
            <td class = "table-main" ><?= $products ?></td>       
            <td class = "table-main" ><?= $itemsold ?></td>
            <td class = "table-main" ><?= $consumption ?></td>
            <td class = "table-main" ><?= $sales_vol ?></td>
            <td class = "table-main" ><?= $consumption_vol ?></td>
            <td class = "table-main" ><?= $class ?></td>
        <?php
        }
    }
    else if ($func == 'pareto_graph') {

        $fromdate = date("Y-m-d",strtotime($_POST['from']));
        $todate = date("Y-m-d",strtotime($_POST['to']));

        $sql = "SELECT products, itemsold, consumption, totalsold, total_consumption, ROUND(IFNULL(IFNULL(itemsold/totalsold,0)*100,0),2) AS sales_vol,  ROUND(IFNULL(IFNULL(consumption/total_consumption,0)*100,0),2) AS consumption_vol, CASE 
                WHEN SUM(itemsold) OVER (ORDER BY itemsold DESC)/SUM(itemsold) OVER () <= .7 THEN 'A'
                WHEN SUM(itemsold) OVER (ORDER BY itemsold DESC)/SUM(itemsold) OVER () <= .9 THEN 'B'
                ELSE 'C' END AS class FROM (SELECT SUM(s.itemsold) AS totalsold, SUM(s.consumption) AS total_consumption FROM (SELECT p.product_code AS products, IFNULL(itemsold,0) AS itemsold, ROUND(IFNULL(ioi.price,0),2) AS cpu, IFNULL(total,0) AS consumption
                FROM (SELECT product_code from products) p 
                LEFT JOIN (SELECT product_code, quantity FROM whse_items GROUP BY product_code) ii ON (p.product_code = ii.product_code) 
                LEFT JOIN (SELECT cart_items.transaction_no, product_code, quantity, price_ea, IFNULL(SUM(quantity), 0) AS itemsold, IFNULL(SUM(IFNULL(quantity,0) * IFNULL(price_ea,0)),0) AS total FROM cart_items, (SELECT sales_transaction.transaction_no, transaction_date FROM sales_transaction WHERE sales_transaction.transaction_date BETWEEN '$fromdate' AND '$todate') AS st WHERE cart_items.transaction_no = st.transaction_no GROUP BY product_code) ci ON (p.product_code = ci.product_code)
                LEFT JOIN (SELECT item_orders.purchase_order_id, product_code, AVG(price) as price FROM item_orders, (SELECT purchase_order.purchase_order_id, order_date FROM purchase_order WHERE purchase_order.order_date BETWEEN '$fromdate' AND '$todate') AS io WHERE item_orders.purchase_order_id = io.purchase_order_id GROUP BY product_code) ioi ON (p.product_code = ioi.product_code)
                GROUP BY p.product_code) s)t CROSS JOIN (SELECT p.product_code AS products, IFNULL(itemsold,0) AS itemsold, ROUND(IFNULL(ioi.price,0),2) AS cpu, IFNULL(total,0) AS consumption
                FROM (SELECT product_code from products) p 
                LEFT JOIN (SELECT product_code, quantity FROM whse_items GROUP BY product_code) ii ON (p.product_code = ii.product_code) 
                LEFT JOIN (SELECT cart_items.transaction_no, product_code, quantity, price_ea, IFNULL(SUM(quantity), 0) AS itemsold, IFNULL(SUM(IFNULL(quantity,0) * IFNULL(price_ea,0)),0) AS total FROM cart_items, (SELECT sales_transaction.transaction_no, transaction_date FROM sales_transaction WHERE sales_transaction.transaction_date BETWEEN '$fromdate' AND '$todate') AS st WHERE cart_items.transaction_no = st.transaction_no GROUP BY product_code) ci ON (p.product_code = ci.product_code)
                LEFT JOIN (SELECT item_orders.purchase_order_id, product_code, AVG(price) as price FROM item_orders, (SELECT purchase_order.purchase_order_id, order_date FROM purchase_order WHERE purchase_order.order_date BETWEEN '$fromdate' AND '$todate') AS io WHERE item_orders.purchase_order_id = io.purchase_order_id GROUP BY product_code) ioi ON (p.product_code = ioi.product_code)
                GROUP BY p.product_code) v GROUP BY v.products ORDER BY v.consumption DESC";

        $result = mysqli_query($con,$sql) or die($con->error);
        $data = array();
        foreach($result as $rows){
            $data[] = array(
                "products"  =>	$rows["products"],
				"sales_vol"	=>	$rows["sales_vol"],
			    "color"		=>	'#' . rand(100000, 999999) . ''
            );
        }
        echo json_encode($data);
    }
    else if ($func == 'sales_chart') {

        $fromdate = date("Y-m-d",strtotime($_POST['from']));
        $todate = date("Y-m-d",strtotime($_POST['to']));

        $sql = "SELECT product_code, IFNULL(SUM(quantity), 0) AS itemsold FROM cart_items, 
        (SELECT sales_transaction.transaction_no, transaction_date FROM sales_transaction WHERE sales_transaction.transaction_date BETWEEN '".$fromdate."' AND '".$todate."') so WHERE cart_items.transaction_no = so.transaction_no
        GROUP BY product_code";

        $result = mysqli_query($con,$sql) or die($con->error);
        $data = array();

        foreach ($result as $row) {
            $data[] = array(
                'products'   => $row['product_code'],
                'itemsold'   => $row['itemsold'],
                'color'      => '#' . rand(100000, 999999) . ''
            );
        }
        echo json_encode($data);
    }
    else if ($func == 'sales_ch') {

        $fromdate = date("Y-m-d",strtotime($_POST['from']));
        $todate = date("Y-m-d",strtotime($_POST['to']));

        $sql = "SELECT transaction_date, IFNULL(SUM(quantity), 0) AS itemsold FROM cart_items, 
        (SELECT sales_transaction.transaction_no, transaction_date FROM sales_transaction WHERE sales_transaction.transaction_date BETWEEN '".$fromdate."' AND '".$todate."') so WHERE cart_items.transaction_no = so.transaction_no
        GROUP BY transaction_date";

        $result = mysqli_query($con,$sql) or die($con->error);
        $data = array();

        foreach ($result as $row) {
            $data[] = array(
                'products'   => $row['transaction_date'],
                'itemsold'   => $row['itemsold'],
                'color'      => '#' . rand(100000, 999999) . ''
            );
        }
        echo json_encode($data);
    }
    else if ($func == 'ppi-sellthrough') {

        $fromdate = date("Y-m-d",strtotime($_POST['from']));
        $todate = date("Y-m-d",strtotime($_POST['to']));

        $sql = "SELECT p.product_code AS products, IFNULL(ii.quantity,0) AS available, IFNULL(itemsold,0) AS itemsold, IFNULL(itemsreturned,0) AS itemsreturned_c, IFNULL(total,0) AS total, IFNULL(itembought,0) AS item_bought, IFNULL(total_buy,0) AS total_buy, ROUND(IFNULL(IFNULL(ci.itemsold/ioi.itembought,0)*100,0),2) AS sellthrough
        FROM (SELECT product_code from products) p 
        LEFT JOIN (SELECT product_code, quantity FROM whse_items GROUP BY product_code) ii ON (p.product_code = ii.product_code) 
        LEFT JOIN (SELECT cart_items.transaction_no, product_code, quantity, price_ea, IFNULL(SUM(quantity), 0) AS itemsold, IFNULL(SUM(IFNULL(quantity,0) * IFNULL(price_ea,0)),0) AS total FROM cart_items, (SELECT sales_transaction.transaction_no, transaction_date FROM sales_transaction WHERE sales_transaction.transaction_date BETWEEN '$fromdate' AND '$todate') AS st WHERE cart_items.transaction_no = st.transaction_no GROUP BY product_code) ci ON (p.product_code = ci.product_code)
        LEFT JOIN (SELECT item_orders.purchase_order_id, product_code, quantity, price, IFNULL(SUM(quantity), 0) AS itembought, IFNULL(SUM(IFNULL(quantity,0) * IFNULL(price,0)),0) AS total_buy FROM item_orders, (SELECT purchase_order.purchase_order_id, order_date FROM purchase_order WHERE purchase_order.order_date BETWEEN '$fromdate' AND '$todate') AS io WHERE item_orders.purchase_order_id = io.purchase_order_id GROUP BY product_code) ioi ON (p.product_code = ioi.product_code)
        LEFT JOIN (SELECT item_returns_pd.return_id, product_code, SUM(IFNULL(quantity,0)) AS itemsreturned, item_price, IFNULL(SUM(quantity), 0) AS itemreturns FROM item_returns_pd, (SELECT item_returns.return_id, return_date FROM item_returns WHERE item_returns.return_date BETWEEN '$fromdate' AND '$todate') AS ir WHERE item_returns_pd.return_id = ir.return_id GROUP BY product_code) irp ON (p.product_code = irp.product_code)
        GROUP BY p.product_code";

        $result = mysqli_query($con,$sql) or die($con->error);
        $data = array();
        foreach($result as $rows){
            $data[] = array(
                "products"    =>	$rows["products"],
				"sellthrough" =>	$rows["sellthrough"],
			    "color"		  =>	'#' . rand(100000, 999999) . ''
            );
        }
        echo json_encode($data);
    }
    else if($func == 'download-abc'){

    }
    else if($func == 'download-ppi'){

    }
    else if($func == 'download-sales'){

    }
    else if($func == 'download-product'){

    }
    else if($func == 'download-customer'){

    }
?>
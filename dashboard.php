<?php
    include('includes/navs.php');
?>
<div class = "cardBox">
    <div class = "card">
        <div>
            <div class = "numbers"><span id = 'card-low'></span></div>
            <div class = "cardName">Item low on stock</div>
        </div>
        <div class = "iconBox">
            <i class="fa fa-eye" aria-hidden="true"></i>
        </div>
    </div>
    <div class = "card">
        <div>
            <div class = "numbers"><span id = 'trans-today'></span></div>
            <div class = "cardName">Transactions today</div>
        </div>
        <div class = "iconBox">
            <i class="fa fa-book" aria-hidden="true"></i>
        </div>
    </div>
    <div class = "card">
        <div>
            <div class = "numbers"> &#8369; <span id = 'sales-today'></span></div>
            <div class = "cardName">Sales Today</div>
        </div>
        <div class = "iconBox">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        </div>
    </div>
    <div class = "card">
        <div>
            <div class = "numbers"> &#8369; <span id = 'sales-month'></span></div>
            <div class = "cardName">This month's sales</div>
        </div>
        <div class = "iconBox">
            <i class="fa fa-money-bill-wave" aria-hidden="true"></i>
        </div>
    </div>
</div>
<div class = "details">
    <div class="table-view">
        <div class = "cardHeader">
            <h2>Sales Chart</h2>
        </div>
        <canvas id="line" style="max-width:100%;"></canvas>
    </div>
    <div class="table-view">
        <div class = "cardHeader">
            <h2>Low Stock</h2>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <td>Product Code</td>
                        <td>Name</td>
                        <td>Qty Available</td>
                    </tr>
                </thead>
                <tbody id = 'table-data'>
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class = "table-view">
        <div class = "cardHeader">
            <h2>Recent Sales</h2>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <td>Transaction #</td>
                        <td>Customer</td>
                        <td>Total Items</td>
                        <td>Grand Total</td>
                        <td>Date</td>
                    </tr>
                </thead>
                <tbody id = 'sales-data'>
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class = "recentCustomers">
        <div class = "cardHeader">
            <h2>Recent Customers</h2>
        </div>
        <table>
            <tbody id = 'customer-data'>
                
            </tbody>
        </table>
    </div>
    <div class = "table-view">
        <div class = "cardHeader">
            <h2>Top 5 Selling Products</h2>
        </div>
        <canvas id="pie" style="max-width:100%;"></canvas>
    </div>
    <div class="table-view">
        <div class = "cardHeader">
            <h2>Recent Orders</h2>
        </div>
        <table>
            <thead>
                <tr>
                    <td>Purchase Order #</td>
                    <td>Total Items</td>
                    <td>Total Price</td>
                </tr>
            </thead>
            <tbody id = 'order-data'>
                
            </tbody>
            <tfoot>
                
            </tfoot>
        </table>
    </div>
</div>
<script>
$(document).ready(function(){
    var from = moment().startOf('month').format('YYYY-MM-DD hh:mm');
    var to = moment().endOf('month').format('YYYY-MM-DD hh:mm');
    
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;
    
    lowStock();
    cardLow();
    var cvalue = $("#counter").val();
    salesRecent();
    customerRecent();
    topsalesChart();
    salesChart();
    transToday();
    salesToday();
    salesMonth();
    ordersRecent();
    function lowStock(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/reportscript.php",
            data: {
                'func':"lowStock"
            },                             
            success: function(response){                    
                $("#table-data").html(response); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
    function topsalesChart(){
        $.ajax({
            type: "POST",
            url: "includes/functions/reportscript.php",
            data: {
                'func':"top_sales",
                'from':from,
                'to':to
            },
            dataType:'JSON',                             
            success: function(data){                    
                var product = [];
                var items = [];
                var color = [];

                for(var count = 0; count < data.length; count++){
                    product.push(data[count].products);
                    items.push(data[count].itemsold);
                    color.push(data[count].color);
                }
                var chart_data = {
                    labels: product,
                    datasets:[
                        {
                            label: '# of Sales',
                            backgroundColor: color,
                            color:'#fff',
                            data: items
                        }
                    ]
                };
                var chart = $('#pie');
                var graph = new Chart(chart, {
                    type:"pie",
                    data: chart_data,
                });
            },
            error: function(){
                alert(data);
            }
        });       
    }
    function salesChart(){
        $.ajax({
            type: "POST",
            url: "includes/functions/reportscript.php",
            data: {
                'func':"sales_ch",
                'from':from,
                'to':to
            },
            dataType:'JSON',                             
            success: function(data){                    
                var product = [];
                var items = [];
                var color = [];

                for(var count = 0; count < data.length; count++){
                    product.push(data[count].products);
                    items.push(data[count].itemsold);
                    color.push(data[count].color);
                }
                var chart_data = {
                    labels: product,
                    datasets:[
                        {
                            label: '# of Sales',
                            backgroundColor: color,
                            color:'#fff',
                            fill: false,
                            data: items
                        }
                    ]
                };
                var chart = $('#line');
                var graph = new Chart(chart, {
                    type:"line",
                    data: chart_data,
                    options: {
                        legend: {display: false}
                    }
                });
            },
            error: function(){
                alert(data);
            }
        });   
    }
    function salesRecent(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/reportscript.php",
            data: {
                'func':"sales"
            },                             
            success: function(response){                    
                $("#sales-data").html(response); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
    function ordersRecent(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/reportscript.php",
            data: {
                'func':"recent_orders"
            },                             
            success: function(response){                    
                $("#order-data").html(response); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
    function salesMonth(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/reportscript.php",
            dataType: 'JSON',
            data: {
                'func':"sales-month",
                'from':from,
                'to':to
            },                             
            success: function(data){                    
                $("#sales-month").html(data.total_items); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
    function transToday(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/reportscript.php",
            dataType: 'JSON',
            data: {
                'func':"trans-today",
                'from':today
            },                             
            success: function(data){                    
                $("#trans-today").html(data.total_items); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
    function salesToday(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/reportscript.php",
            dataType: 'JSON',
            data: {
                'func':"sales-today",
                'from':today
            },                             
            success: function(data){                    
                $("#sales-today").text(data.total_items); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
    function customerRecent(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/reportscript.php",
            data: {
                'func':"customer"
            },                             
            success: function(response){                    
                $("#customer-data").html(response); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
    function cardLow(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/reportscript.php",
            dataType: 'JSON',
            data: {
                'func':"lowStock2"
            },                             
            success: function(data){                    
                $("#card-low").html(data.total_items); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
});
</script>
<?php 
    include('includes/foot.php');
?>

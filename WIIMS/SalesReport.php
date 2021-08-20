<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
    <main>
        <div class="card">
            <form method="POST">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-list"></span>
                        <select name = "tableName" id="tbName" onchange="location.href=this.value">
                            <option value = "SalesReport.php">Sales</option>
                            <option value = "Reports.php">All Reports</option>
                            <option value = "ProductPerformance.php">Product Performance</option>
                            <option value = "InventoryReport.php">Inventory (Per Product)</option>
                            <option value = "InventoryReport2.php">Inventory (Valuation)</option>
                        </select>
                    </h2>
                    <div class="FromToDate">
                        <form method = "POST">
                            <label> From: <input type ="date" id="date_from"> To: <input type ="date" id="date_to"><button id = "generateSales">Generate</button> 
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        
                        <div class="row">
                            <div class="table-length">
                                <label>Show <Select name="tableLength" id="maxRows">
                                    <option value = "5000" > All </option>
                                    <option value = "10" > 10 </option>
                                    <option value = "20" > 20</option>
                                    <option value = "30" > 30 </option>
                                    <option value = "40" > 40 </option>
                                    <option value = "50" > 50 </option>
                                </Select> Entries.</label> 
                            </div>
                            <div class="table-search">
                                <label> Search: <input type="search" placeholder="" id = "searchInput"></label> 
                            </div>
                        </div>
                        <div class="row">
                            <table id="sortable" class="table" width = "100%">
                                <thead>
                                    <tr>
                                        <td>Date</td>
                                        <td># of Transactions</td>
                                        <td># of Products Sold</td>
                                        <td>Total</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <tbody class="tablecontent">
                                    <!--display to table-->
                                </tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="row-no-margin">
                            <div class="table-pagination">
                                <ul class = pagination>
                                    
                                </ul>
                            </div>
                            <div class="table-info"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>  
    </main>
    <script>
    $(document).ready(function(){
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

        $("#date_to").val(today);

        var d = ("0" + now.getDate()).slice(-2);
        var m = ("0" + (now.getMonth() - 0)).slice(-2);

        ago = now.getFullYear()+"-"+(m)+"-"+(d);

        $("#date_from").val(ago);
        function genSales(){
            var from = $('#date_from').val();
            var to = $('#date_to').val();
            $.ajax({    //create an ajax request to display.php
                type: "POST",
                url: "php/functions/function_reports.php",
                data: {
                    'func':"sales_report",
                    'from':from,
                    'to':to
                },                             
                success: function(response){                    
                    $(".tablecontent").html(response);
                },
                error: function(){
                    alert("Something went wrong");
                }
            });
        }
        genSales();
        $("#generateSales").click(function(e){
            e.preventDefault();
            genSales();
        });

    });
    </script>
<?php
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>

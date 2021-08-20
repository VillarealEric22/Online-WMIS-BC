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
                            <option value = "InventoryReport.php">Inventory (Per Product)</option>
                            <option value = "InventoryReport2.php">Inventory (Valuation)</option>
                            <option value = "Reports.php">All Reports</option>
                            <option value = "ProductPerformance.php">Product Performance</option>
                            <option value = "SalesReport.php">Sales</option>
                        </select>
                    </h2>
                    <div class="FromToDate">
                        <label> From: <input type ="date" id="a_date_from" value = "<?php echo date("Y-m-d");?>" required> To: <input type ="date" id="a_date_to" value = "<?php echo date("Y-m-d");?>" required> <button>Generate</button>
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
                                        <td> </td>
                                        <td id = "date_">Date</td>
                                        <td id = "p_code">Product Code</td>
                                        <td id = "b_qty">Beginning Inventory</td>
                                        <td id = "p_qty">Purchases</td>
                                        <td id = "e_qty">Ending Inventory</td>
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
<?php
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>

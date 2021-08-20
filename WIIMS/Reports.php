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
                            <option value = "Reports.php">All Reports</option>
                            <option value = "InventoryReport.php">Inventory (Per Product)</option>
                            <option value = "InventoryReport2.php">Inventory (Valuation)</option>
                            <option value = "ProductPerformance.php">Product Performance</option>
                            <option value = "SalesReport.php">Sales</option>
                        </select>
                    </h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="row">
                            <p> Select a report to view detailed report</p>
                        </div>
                    </div>
                </div>
                </form>
            </div>  
        <div class="recent-grid">
            <div class="inventory">
                <div class="card">
                    <div class="card-header">
                        <h2>Inventory</h2>
                        <form action="Inventory.php">
                            <button type="submit">See more <span class="las la-arrow-right"></span></button>
                        </form>
                    </div>
                    <div class="card-body">
                        <canvas id="PieChart" style = "width:100%;max-width:700px"></canvas>
                    </div>
                    </div>
                </div>  
            <div class="Sales">
                <div class="card">
                    <div class="card-header">
                        <h2>Sales</h2>
                        <form action="Sales.php">
                            <button type="submit">See more <span class="las la-arrow-right"></span></button>
                        </form>
                    </div>
                    <div class="card-body">
                        <canvas id="LineChart" style = "width:100%;max-width:700px"></canvas>
                    </div>
                </div>
            </div>   
        </div>
    </main>
<?php
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>

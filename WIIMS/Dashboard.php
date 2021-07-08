<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
    <main>
        <div class="cards">
            <div class="card-single">
                <div>
                    <h1>10</h1>
                    <span>Items&nbsplow on stock</span>
                </div>
                <div>
                    <span class = "las la-box-open"></span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <h1>15</h1>
                    <span>Sales Today</span>
                </div>
                <div>
                    <span class = "las la-money-bill-wave"></span>
                </div>
            </div>
            <div class="card-single">
                <div>  
                    <h1>10</h1>
                    <span>Returns Today</span>
                </div>
                <div>
                    <span class = "las la-dolly"></span>
                </div>
            </div>
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
</div>
<?php
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>

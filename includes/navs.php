<?php 
	include('includes/db.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta name = "viewport" content = "width=device-width, initial-scale=1.0">
<title>Baker's Craft Admin</title>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel = "stylesheet" type = "text/css" href = "css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type = "text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>
	<div class = "cointaner">
		<div class = "navigation">
			<?php
			if($_SESSION["userrole"] == "Admin")
			{
				?>
				<ul class = "nav-links">
					<li>
						<a href = "dashboard.php">
							<span class = "icon"><i class="fa fa-apple" aria-hidden="true"></i></span>
							<span class = "title"><h2>Baker's Craft</h2></span>
						</a>
					</li>
					<li>
						<a href = "dashboard.php">
							<span class = "icon"><i class="fa fa-home" aria-hidden="true"></i></span>
							<span class = "title">Dashboard</span>
						</a>
					</li>
					<li>
					    	<a href="products.php">
							<span class = "icon"><i class="fa fa-tags" aria-hidden="true"></i></span>
							<span class="title">Products</span>
					    	</a>
					</li>
					<li>
						    <a href="categories.php">
							<span class = "icon"><i class="fa fa-tags" aria-hidden="true"></i></span>
							<span class="title">Categories</span>
						    </a>
					</li>
					<li>
						<a href="warranties.php">
							<span class = "icon"><i class="fa fa-tags" aria-hidden="true"></i></span>
							<span class="title">Warranties</span>
						</a>
					</li>
					<li>
						<a href="inventory.php">
							<span class = "icon"><i class="fa fa-cubes" aria-hidden="true"></i></span>
							<span class="title">Inventory</span>
					    	</a>
					</li>
					<li>
						<a href = "sales.php">
							<span class = "icon"><i class="fa fa-cash-register" aria-hidden="true"></i></span>
							<span class = "title">Sales</span>
						</a>
					</li>
					<li>
						<a href = "orders.php">
							<span class = "icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
							<span class = "title">Orders</span>
						</a>
					</li>
					<li>
						<a href = "orders-completed.php">
							<span class = "icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
							<span class = "title">Orders(completed)</span>
						</a>
					</li>
					<li>
						<a href = "returns.php">
							<span class = "icon"><i class="fa fa-repeat" aria-hidden="true"></i></span>
							<span class = "title">Returns</span>
						</a>
					</li>
					<li>
						<a href = "pullout.php">
							<span class = "icon"><i class="fa fa-dolly" aria-hidden="true"></i></span>
							<span class = "title">Item Pullout</span>
						</a>
					</li>
					<li>
						<a href = "transfer.php">
							<span class = "icon"><i class="fa fa-people-carry" aria-hidden="true"></i></span>
							<span class = "title">Transfer</span>
						</a>
					</li>
					<li>
						<a href = "transfer-approved.php">
							<span class = "icon"><i class="fa fa-people-carry" aria-hidden="true"></i></span>
							<span class = "title">Transfer(Approved)</span>
						</a>
					</li>
					<li>
						<a href = "transfer-completed.php">
							<span class = "icon"><i class="fa fa-people-carry" aria-hidden="true"></i></span>
							<span class = "title">Transfer(Completed)</span>
						</a>
					</li>
					<li>
						<a href = "warehouse.php">
							<span class = "icon"><i class="fa fa-warehouse" aria-hidden="true"></i></span>
							<span class = "title">Warehouse</span>
						</a>
					</li>
					<li>
						<a href = "whse_items.php">
							<span class = "icon"><i class="fa fa-warehouse" aria-hidden="true"></i></span>
							<span class = "title">Warehouse Items</span>
						</a>
					</li>
					<li>
						<a href = "customers.php">
							<span class = "icon"><i class="fa fa-user-tag" aria-hidden="true"></i></span>
							<span class = "title">Customers</span>
						</a>
						<div>
					</li>
					<li>
						<a href = "suppliers.php">
							<span class = "icon"><i class="fa fa-user-tie" aria-hidden="true"></i></span>
							<span class = "title">Suppliers</span>
						</a>
						<div>
					</li>
					<li>
						<a href = "abc_analysis.php">
							<span class = "icon"><i class="fa fa-book" aria-hidden="true"></i></span>
							<span class = "title">ABC Analysis</span>
						</a>
					</li>
					<li>
						<a href = "sales_report.php">
							<span class = "icon"><i class="fa fa-book" aria-hidden="true"></i></span>
							<span class = "title">Sales Report</span>
						</a>
					</li>
					<li>
						<a href = "safety_stock.php">
							<span class = "icon"><i class="fa fa-book" aria-hidden="true"></i></span>
							<span class = "title">Safety Stock</span>
						</a>
					</li>
					<li>
						<a href = "ppi.php">
							<span class = "icon"><i class="fa fa-book" aria-hidden="true"></i></span>
							<span class = "title">Product Performance</span>
						</a>
					</li>
					<li>
						<a href = "users.php">
							<span class = "icon"><i class="fa fa-user" aria-hidden="true"></i></span>
							<span class = "title">Users</span>
						</a>
					</li>
					<li>
						<a href = "employees.php">
							<span class = "icon"><i class="fa fa-user-friends" aria-hidden="true"></i></span>
							<span class = "title">Employees</span>
						</a>
					</li>
				</ul>
				<?php
			}
			else if($_SESSION["userrole"] == "Sales"){
				?>
				<ul class = "nav-links">
					<li>
						<a href = "#">
							<span class = "icon"><i class="fa fa-apple" aria-hidden="true"></i></span>
							<span class = "title"><h2>Baker's Craft</h2></span>
						</a>
					</li>
					<li>
					    	<a href="products.php">
							<span class = "icon"><i class="fa fa-tags" aria-hidden="true"></i></span>
							<span class="title">Products</span>
					    	</a>
					</li>
					<li>
						<a href = "sales.php">
							<span class = "icon"><i class="fa fa-cash-register" aria-hidden="true"></i></span>
							<span class = "title">Sales</span>
						</a>
					</li>
					<li>
						<a href = "customers.php">
							<span class = "icon"><i class="fa fa-user-tag" aria-hidden="true"></i></span>
							<span class = "title">Customers</span>
						</a>
						<div>
					</li>
				</ul>
			
			<?php
			}
			else if($_SESSION["userrole"] == 'Inventory_clerk'){
				?>
				<ul class = "nav-links">
					<li>
						<a href = "#">
							<span class = "icon"><i class="fa fa-apple" aria-hidden="true"></i></span>
							<span class = "title"><h2>Baker's Craft</h2></span>
						</a>
					</li>
					<li>
					    	<a href="products.php">
							<span class = "icon"><i class="fa fa-tags" aria-hidden="true"></i></span>
							<span class="title">Products</span>
					    	</a>
					</li>
					<li>
						<a href = "whse_items.php">
							<span class = "icon"><i class="fa fa-warehouse" aria-hidden="true"></i></span>
							<span class = "title">Warehouse Items</span>
						</a>
					</li>
					<li>
						<a href = "warehouse.php">
							<span class = "icon"><i class="fa fa-warehouse" aria-hidden="true"></i></span>
							<span class = "title">Warehouse</span>
						</a>
					</li>
					<li>
						<a href = "transfer.php">
							<span class = "icon"><i class="fa fa-people-carry" aria-hidden="true"></i></span>
							<span class = "title">Transfer</span>
						</a>
					</li>
					<li>
						<a href = "transfer-approved.php">
							<span class = "icon"><i class="fa fa-people-carry" aria-hidden="true"></i></span>
							<span class = "title">Transfer(Approved)</span>
						</a>
					</li>
					<li>
						<a href = "transfer-completed.php">
							<span class = "icon"><i class="fa fa-people-carry" aria-hidden="true"></i></span>
							<span class = "title">Transfer(Completed)</span>
						</a>
					</li>	
				</ul>
			<?php
			}
			else{
				header("location:index.php");
			}
			?>
		</div>
	</div>
	<div class = "main">
		<div class = "topbar">
			<div class = "toggle" onclick = "toggleMenu();"></div>
				
			<div class="user-wrapper">
                <ul>
                    <li>
                      <a href="#">
                        <span class = 'c_user'><?=$_SESSION['username']?><br><span></span></span><i class="fa fa-angle-down"></i>
                      </a>
                      <div class="dropdown">
                        <ul>
                            <li><a href="#useracct" class = "modalBtn userSetting" id = "user_edit"><i class = "fa fa-cogs"></i> User Settings </a></li>
                            <li><a href="#acct" class = "modalBtn accountSetting"  id = "account_edit"><i class = "fa fa-user-circle"></i> Account Settings </a></li> 
                            <li><a href="logout.php" class = "modalBtn logout"><i class = "fa fa-sign-out"></i> Log Out </a></li> 
                        </ul>
                      </div>
                    </li>
                </ul>
            </div>
		</div>
        <div class="content-wrapper">

      

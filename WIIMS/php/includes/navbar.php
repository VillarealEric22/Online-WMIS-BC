<?php
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: Index.php');
        exit;
    }
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'db_inventory';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno()) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    // get username and usertype
    $stmt = $con->prepare('SELECT user_role, user_img FROM users WHERE username = ?');
    //diplay onto header
    $stmt->bind_param('s', $_SESSION['username']);
    $stmt->execute();
    $stmt->bind_result($user_role, $user_img);
    $stmt->fetch();
    $stmt->close();
?>
<!--start wrapper-->
<div class="wrapper">
    <!--Sidebar-->
        <input type="checkbox" id="nav-toggle">
        <div class="sidebar">
            <div class="sidebar-brand">
                <h2><span class="Bakerscraft"></span><span>Baker's Craft</span></h2>
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="Dashboard.php" class = "not-active"><span class = "las la-home"></span>
                        <span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="Products.php" class = "not-active"><span class = "las la-boxes"></span>
                        <span>Products</span></a>
                    </li>
                    <li>
                        <a href="Inventory.php" class = "not-active"><span class = "las la-clipboard-list"></span>
                        <span>Inventory</span></a>
                    </li>
                    <li>
                        <a href="Sales.php" class = "not-active"><span class = "las la-cash-register"></span>
                        <span>Sales</span></a>
                    </li>
                    <li>
                        <a href="Orders.php" class = "not-active"><span class = "las la-briefcase"></span>
                        <span>Orders</span></a>
                    </li>
                    <li>
                        <a href="Customers.php" class = "not-active"><span class = "las la-users"></span>
                        <span>Customers</span></a>
                    </li>
                    <li>
                        <a href="Suppliers.php" class = "not-active"><span class = "las la-user-tie"></span>
                        <span>Suppliers</span></a>
                    </li>
                    <li>
                        <a href="Warehouse.php" class = "not-active"><span class = "las la-warehouse"></span>
                        <span>Warehouse</span></a>
                    </li>
                    <li>
                        <a href="Returns.php" class = "not-active"><span class = "las la-truck"></span>
                        <span>Returns</span></a> 
                    </li>
                    <li>
                        <a href="Reports.php" class = "not-active"><span class = "las la-chart-line"></span>
                        <span>Reports</span></a> 
                    </li>
                    <li>
                        <a href="Users.php" class = "not-active"><span class = "las la-user"></span>
                        <span>Users</span></a> 
                    </li>
                </ul>
            </div>
        </div>
        <!--End Sidebar-->
        <!--Start Main Content-->
        <div class="main-content">
            <!--Header-->
            <header>
                <div class="header-title">
                    <h3>
                        <label for="nav-toggle">
                            <span class = "las la-bars">

                            </span>
                        </label>
                    </h3>
                </div>
                <div class="search-wrapper">
                    <span class ="las la-search"></span>
                    <input type="search" placeholder="Search"/> 
                </div>
                <div class="user-wrapper">
                    <ul>
                        <li>
                          <a href="#">
                            <p><?=$_SESSION['username']?><br><span><?=$user_role?></span></p>
                            <img src="<?=$user_img?>" width="40px" height="40px" alt="User"><i class="las la-angle-down"></i>
                          </a>
                          <div class="dropdown">
                            <ul>
                                <li><a href="#accountModal" class = "modalBtn settings"><i class = "las la-cogs"></i> Settings </a></li>
                                <li><a href="#logoutModal" class = "modalBtn logout"><i class = "las la-sign-out-alt"></i> Log Out </a></li> 
                            </ul>
                          </div>
                        </li>
                    </ul>
                </div>
            </header>
            <!--Header End-->
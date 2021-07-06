<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
<main>
    <div class="main-containter">
        <div class="Users">
            <div class="card">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-user"></span>
                        Users
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addUsersModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
                            <button href = "#editProductModal" class = "modalBtn btn-success" > Edit <span class="las la-edit"></span></button>
                            <button href = "#deleteProductModal" class = "modalBtn btn-danger"> Delete <span class="las la-trash"></span></button>
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
                                <label> Search: <input type="search" placeholder=""/></label> 
                            </div>
                        </div>
                        <div class="row">
                            <table id="sortable" class="table" width = "100%">
                                <thead>
                                    <tr>
                                        <td>Employee ID</td>
                                        <td>Username</td>
                                        <td>User Role</td>
                                        <td>Lastname</td>
                                        <td>Firstname</td>
                                        <td>M.I.</td>
                                        <td>Sex</td>
                                        <td>Address</td>
                                        <td>Contact No.</td>
                                        <td>Birthday</td>
                                        <td>User Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--display to table-->
                                    <?php
                                        //connection info.
                                        $DATABASE_HOST = 'localhost';
                                        $DATABASE_USER = 'root';
                                        $DATABASE_PASS = '';
                                        $DATABASE_NAME = 'db_inventory';
                                        //connect using data above.
                                        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
                                        if ( mysqli_connect_errno() ) {
                                            // If there is an error with the connection, stop the script and display the error.
                                            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
                                        }
                                        $sql = "SELECT user.employee_id, user.username, user.user_role, employees.lastname, employees.firstname, employees.middlename, employees.sex, employees.address, employees.contact_number, employees.birthday FROM user INNER JOIN employees ON user.employee_id = employees.employee_id";
                                        $result = $con->query($sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
                                            while($rows= $result-> fetch_assoc()){
                                                echo "<tr><td>".$rows['employee_id']."</td>";
                                                echo "<td>".$rows['username']."</td>";
                                                echo "<td>".$rows['user_role']."</td>";
                                                echo "<td>".$rows['lastname']."</td>";
                                                echo "<td>".$rows['firstname']."</td>";
                                                echo "<td>".$rows['middlename']."</td>";
                                                echo "<td>".$rows['sex']."</td>";
                                                echo "<td>".$rows['address']."</td>";
                                                echo "<td>".$rows['contact_number']."</td>";
                                                echo "<td>".$rows['birthday']."</td></tr>";
                                            }
                                            echo "number of rows: " . $result->num_rows;
                                        $con->close();
                                    ?>
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
            </div>  
        </div>
    </div>
    <!--add modal-->
    <div id = "addUsersModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form>
                        Employee Details
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addEmployeeID">Product Name:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addEmployeeID" name = "addEmployeeID">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "adddimensions">Name:</label>
                            </div>
                            <div class="input">
                                <label>Last Name</label>
                                <input type ="text" id="addlength" name = "addlength">
                            </div>
                            <div class="input">
                                <label> First Name</label>
                                <input type ="text" id="addwidth" nmae = "addwidth">
                            </div>
                            <div class="input">
                                <label>M.I </label>
                                <input type ="text" id="addheight" nmae = "addheight">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addEmployeeAddress"> Address:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addEmployeeAddress" name = "addEmployeeAddress">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addEmployeeContact"> Contact No.:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addEmployeeContact" name = "addEmployeeContact">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "sex">Sex:</label>
                            </div>
                            <div class="input">
                            <Select name="sex" id="sex">
                                    <option value = "type 1" > Male </option>
                                    <option value = "type 2" > Female </option>
                                    <option value = "type 3" > Transexual </option>
                            </Select>
                            </div>                           
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "birthdate">Birth Date:</label>
                            </div>
                            <div class="input">
                                <input type="date" id="birthdate" name="birthdate">
                            </div>
                        </div>
                        <br/>
                        User Account
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addusername">Username:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="addusername" name = "addusername">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addpassword">Password:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="addpassword" name = "addpassword"> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addRole">User Role:</label>
                            </div>                              
                            <div class="input">                               
                            <Select name="addRole" id="addRole">
                                    <option value = "Products" > type 1 </option>
                                    <option value = "Packages" > type 2 </option>
                                    <option value = "Packages" > type 3 </option>
                            </Select>
                            <button href = "#userRoleModal" class = "modalBtn"> ... </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <a class="btn-confirm" href="">Confirm</a>
                </div>
            </div>
        </div>
    </div>
    <!--add modal end-->
    <!--edit modal-->
    <div id = "editProductModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class = "modal-body">
                    <form>
                        Employee Details
                        <br/>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addEmployeeID">Product Name:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addEmployeeID" name = "addEmployeeID">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "adddimensions">Name:</label>
                            </div>
                            <div class="input">
                                <label>Last Name</label>
                                <input type ="text" id="addlength" name = "addlength">
                            </div>
                            <div class="input">
                                <label> First Name</label>
                                <input type ="text" id="addwidth" nmae = "addwidth">
                            </div>
                            <div class="input">
                                <label>M.I </label>
                                <input type ="text" id="addheight" nmae = "addheight">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addEmployeeAddress"> Address:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addEmployeeAddress" name = "addEmployeeAddress">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addEmployeeContact"> Contact No.:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addEmployeeContact" name = "addEmployeeContact">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "sex">Sex:</label>
                            </div>
                            <div class="input">
                            <Select name="sex" id="sex">
                                    <option value = "type 1" > Male </option>
                                    <option value = "type 2" > Female </option>
                                    <option value = "type 3" > Transexual </option>
                            </Select>
                            </div>                           
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "birthdate">Birth Date:</label>
                            </div>
                            <div class="input">
                                <input type="date" id="birthdate" name="birthdate">
                            </div>
                        </div>
                        <br/>
                        User Account
                        <br/>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addusername">Username:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="addusername" name = "addusername">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addpassword">Password:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="addpassword" name = "addpassword"> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addRole">User Role:</label>
                            </div>                              
                            <div class="input">                               
                            <Select name="addRole" id="addRole">
                                    <option value = "Products" > type 1 </option>
                                    <option value = "Packages" > type 2 </option>
                                    <option value = "Packages" > type 3 </option>
                            </Select>
                            <button href = "#userRoleModal" class = "modalBtn"> ... </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <a class="btn-confirm" href="">Confirm</a>
                </div>
            </div>
        </div>
    </div>
    <!--edit modal end-->
    <!--delete modal-->
    <div id = "deleteProductModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="modal-message">
                        Are you sure to delete item? This action is irreversible.
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <a class="btn-confirm" href="">Confirm</a>
                </div>
            </div>
        </div>
    </div>
    <!--delete modal end-->
    <!--user role modal-->
    <div id = "userRoleModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content-wide">
                <div class="modal-header">
                    <h5 class="modal-title">User Roles</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="modal-message">
                        <div class="col">
                            <table id="sortable" class="table" width = "100%">
                                <thead>
                                    <tr>
                                        <td>User Role</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Admin</td>
                                    </tr>
                                    <tr>
                                        <td>Sales</td>
                                    </tr>
                                    <tr>
                                        <td>Warehouse Manager</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><button type = "button">Add</button></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col">
                            <table id="sortable" class="table" width = "100%">
                                <thead>
                                    <tr>
                                        <td>Module</td>
                                        <td>Authorization</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Products</td>
                                        <td>
                                            <select>
                                                <option value = "1" > No Restrictions </option>
                                                <option value = "2" > Create and Edit </option>
                                                <option value = "3" > Read-Only </option>
                                                <option value = "4" > No Authorization </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Inventory</td>
                                        <td>
                                            <select>
                                                <option value = "1" > No Restrictions </option>
                                                <option value = "2" > Create and Edit </option>
                                                <option value = "3" > Read-Only </option>
                                                <option value = "4" > No Authorization </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sales</td>
                                        <td>
                                            <select>
                                                <option value = "1" > No Restrictions </option>
                                                <option value = "2" > Create and Edit </option>
                                                <option value = "3" > Read-Only </option>
                                                <option value = "4" > No Authorization </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Orders</td>
                                        <td>
                                            <select>
                                                <option value = "1" > No Restrictions </option>
                                                <option value = "2" > Create and Edit </option>
                                                <option value = "3" > Read-Only </option>
                                                <option value = "4" > No Authorization </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Customers</td>
                                        <td>
                                            <select>
                                                <option value = "1" > No Restrictions </option>
                                                <option value = "2" > Create and Edit </option>
                                                <option value = "3" > Read-Only </option>
                                                <option value = "4" > No Authorization </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Suppliers</td>
                                        <td>
                                            <select>
                                                <option value = "1" > No Restrictions </option>
                                                <option value = "2" > Create and Edit </option>
                                                <option value = "3" > Read-Only </option>
                                                <option value = "4" > No Authorization </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Warehouse</td>
                                        <td>
                                            <select>
                                                <option value = "1" > No Restrictions </option>
                                                <option value = "2" > Create and Edit </option>
                                                <option value = "3" > Read-Only </option>
                                                <option value = "4" > No Authorization </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Reports</td>
                                        <td>
                                            <select>
                                                <option value = "1" > No Restrictions </option>
                                                <option value = "2" > Create and Edit </option>
                                                <option value = "3" > Read-Only </option>
                                                <option value = "4" > No Authorization </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Returns</td>
                                        <td>
                                            <select>
                                                <option value = "1" > No Restrictions </option>
                                                <option value = "2" > Create and Edit </option>
                                                <option value = "3" > Read-Only </option>
                                                <option value = "4" > No Authorization </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Users</td>
                                        <td>
                                            <select>
                                                <option value = "1" > No Restrictions </option>
                                                <option value = "2" > Create and Edit </option>
                                                <option value = "3" > Read-Only </option>
                                                <option value = "4" > No Authorization </option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <a class="btn-confirm" href="">Confirm</a>
                </div>
            </div>
        </div>
    </div>
    <!--user role modal modal end-->
</main>
<?php
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>

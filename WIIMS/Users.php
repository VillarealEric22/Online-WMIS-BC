<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
<main>

    <div class="main-containter">
        <div class="Users">
            <div class="card">
            <form method='post' action="">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-user"></span>
                        <select name = "tableName" id="tbName" onchange="location.href=this.value">
                            <option value = "Users.php">Users</option>
                            <option value = "Employees.php">Employees</option>
                        </select>
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addUsersModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
                            <button href = "#editUsersModal" class = "modalBtn btn-success" > Edit <span class="las la-edit"></span></button>
                            <button href = "#deleteUsersModal" class = "modalBtn btn-danger"> Delete <span class="las la-trash"></span></button>
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
                                        <td></td>
                                        <td>Employee ID</td>
                                        <td>Username</td>
                                        <td>User Role</td>
                                    </tr>
                                </thead>
                                <tbody class = "tablecontent">
                                    <!--display to table-->  
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
            </form>
        </div>
    </div>
    <!--add modal-->
    <div id = "addUsersModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Employee</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">                       
                    <form method = "POST" action = "php/functions/Add_users.php">
                        User Account
                        <br/>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label>employee_id:</label>
                            </div>
                            <div class="input">
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
                                    $sql = "SELECT employees.employee_id, employees.lastname FROM employees";
                                    $result = $con->query($sql) or die($con->error);
                                ?>
                                <select name="emp_sel">
                                    <?php
                                        while($rows= $result-> fetch_assoc())
                                        {
                                            echo "<option value='".$rows['employee_id']."'>".$rows['employee_id']." - ".$rows['lastname']."</option>";
                                        }
                                        $con->close();
                                    ?>    
                                </select>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label>Username:</label>
                            </div>
                            <div class="input">
                                <input type="text" name = "username">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label>Password:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="password" name = "password"> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label>User Role:</label>
                            </div>                              
                            <div class="input">                               
                            <Select name="user_role">
                                    <option value = "Admin"> Admin </option>
                                    <option value = "Sales"> Sales </option>
                                    <option value = "Warehouse Manager"> Warehouse Manager </option>
                            </Select>
                            <button href = "#userRoleModal" class = "modalBtn"> ... </button>
                            </div>
                        </div>
                </div>
                
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <input type="submit" value="insert" name="insert" class="btn-submit">
                </div>
                </form>
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
                        User Account
                        <br/>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label>Username:</label>
                            </div>
                            <div class="input">
                                <input type="text" name = "username">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "password">Password:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="addpassword" name = "password"> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "user_ole">User Role:</label>
                            </div>                              
                            <div class="input">                               
                            <Select name="addRole" id="addRole">
                                    <option value = "Products" >  </option>
                                    <option value = "Packages" >  </option>
                                    <option value = "Packages" >  </option>
                            </Select>
                            <button href = "#userRoleModal" class = "modalBtn"> ... </button>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <input type="submit" value="Confirm" name="update" class="btn-submit">
                </div>
                </form>
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
    <script>
    $(document).ready(function(){
        // fetch data from table without reload/refresh page
        loadData();
        function loadData(){
            $.ajax({    //create an ajax request to display.php
                type: "POST",
                url: "php/functions/Display_users.php",                             
                success: function(response){                    
                    $(".tablecontent").html(response); 
                },
                error: function(){
                    alert("Something went wrong");
                }
            });
        }
        function emptyForm(){

            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

            $('#a_employee_id').val('');
            $('#a_lastname').val('');
            $('#a_firstname').val('');
            $('#a_middlename').val('');
            $('#a_emp_address').val('');
            $('#a_contact_number').val('');
            $('#a_sex').val("Male");
            $('#a_birthday').val(today);
        }
        //insert into table without relaod/refresh page
        $("#insert").click(function() {
            var e_id= $('#a_employee_id').val();
            var e_ln= $('#a_lastname').val();
            var e_fn= $('#a_firstname').val();
            var e_mi= $('#a_middlename').val();
            var e_add= $('#a_emp_address').val();
            var e_cnum= $('#a_contact_number').val();
            var e_sx= $('#a_sex').val();
            var e_bday= $('#a_birthday').val();

            $.ajax({
                method: "POST",
                url: "php/functions/Add_employee.php",
                cache:false,
                async: false,
                data: {
                    'e_id':e_id,
                    'e_ln':e_ln,
                    'e_fn':e_fn,
                    'e_mi':e_mi,
                    'e_add':e_add,
                    'e_cnum':e_cnum,
                    'e_sx':e_sx,
                    'e_bday':e_bday
                },
                success: function(data) {
                    $('#addEmpModal').hide();
                    alert(data);
                    loadData();
                    emptyForm();
                },
                error: function(){
                    alert(data);
                    alert("hagorn")
            }
            });
        });
        // update data from table without relaod/refresh page
        $("#update").click(function() {
            event.preventDefault();
            var e_id= $('#e_employee_id').val();
            var e_ln= $('#e_lastname').val();
            var e_fn= $('#e_firstname').val();
            var e_mi= $('#e_middlename').val();
            var e_add= $('#e_emp_address').val();
            var e_cnum= $('#e_contact_number').val();
            var e_sx= $('#e_sex').val();
            var e_bday= $('#e_birthday').val();

            $.ajax({
                method: "POST",
                url: "php/functions/Update_employee.php",
                cache:false,
                async: false,
                data: {
                    'e_id':e_id,
                    'e_ln':e_ln,
                    'e_fn':e_fn,
                    'e_mi':e_mi,
                    'e_add':e_add,
                    'e_cnum':e_cnum,
                    'e_sx':e_sx,
                    'e_bday':e_bday
                },
                success: function(data) {
                    $('#editEmpModal').hide();
                    alert(data);
                    loadData();
                    emptyForm();
                },
                error: function(){
                    alert(data);
                    alert("hagorn")
            }
            });
        });
        // delete data from table without reload/refresh page
        $('#delete').click(function(){
        var id = [];
        $(".selectable:checked").each(function(){
              id.push($(this).val());
        });
            $.ajax({
                url: "php/functions/Delete_employee.php",
                method: "POST",
                cache:false,
                data: {'deleteID' : id},
                async: false, 
                success: function(response){
                    $('#deleteEmpModal').hide();
                    alert(response);
                    loadData();
                },
                error: function(){
                    alert(id);
                }
            });
        });
    });
    </script>
</main>
<?php
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>

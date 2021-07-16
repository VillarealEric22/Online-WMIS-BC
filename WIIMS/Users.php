<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
<main>

    <div class="main-containter">
        <div class="Users">
            <div class="card">
            <form method='POST' action="">
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
                            <button href = "#editUsersModal" class = "modalBtn btn-success" id = "edit_button"> Edit <span class="las la-edit"></span></button>
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
                                        <td> </td>
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
                </form>
            </div>  
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
                    <form method = "POST">
                        User Account
                        <br/>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "employee_id" >employee_id:</label>
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
                                <select id="a_employee_id">
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
                                <label class = modal-form-label for = "username">Username:</label>
                            </div>
                            <div class="input">
                                <input type = "text"  id = "a_username" name = "username" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "password">Password:</label>
                            </div>                              
                            <div class="input">                               
                                <input type = "password" id = "a_password" name = "password" required> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="user_role">User Role:</label>
                            </div>                              
                            <div class="input">                               
                            <Select name = "user_role" id = "a_user_role">
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
                    <button class ="btn-submit" type= submit value="Confirm" id="insert" name="insert">Confirm</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--add modal end-->
    <!--edit modal-->
    <div id = "editUsersModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Employee</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">                       
                    <form method = "POST">
                        User Account
                        <br/>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "employee_id" >employee_id:</label>
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
                                <select id="e_employee_id">
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
                                <label class = modal-form-label for = "username">Username:</label>
                            </div>
                            <div class="input">
                                <input type = "text"  id = "e_username" name = "username">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "password">Password:</label>
                            </div>                              
                            <div class="input">                               
                                <input type = "password" id = "e_password" name = "password"> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="user_role">User Role:</label>
                            </div>                              
                            <div class="input">                               
                            <Select name = "user_role" id = "e_user_role">
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
                    <button class ="btn-submit" value="Confirm" id="update" name="update">Confirm</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--edit modal end-->
    <!--delete modal-->
    <div id = "deleteUsersModal" class="modal fade">
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
                    <button class ="btn-submit" value="Confirm" id="delete" name="delete">Confirm</button>
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
    //autofill edit inputs
    $("#edit_button").click(function() {
        var id = $('.selectable:checked').val();
        $.ajax({
            method: "POST",
            url: "php/functions/function_user.php",
            cache:false,
            async: false,
            data: {
                'func': "auto_input",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#e_username').val(data.username);
                $('#e_password').val(data.password);
                $('#e_user_role').val(data.user_role);
                $('#e_employee_id').val(data._employee_id);
            },
            error: function(){
                alert("ayaw"); //XD
                alert(id);
        }
        });
    });
    // fetch data from table without reload/refresh page
    loadData();
    function loadData(){
        $.ajax({    //create an ajax request to display.php
            type: "POST",
            url: "php/functions/function_user.php",
            data: {
                'func':"disp"
            },                             
            success: function(response){                    
                $(".tablecontent").html(response); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
    function emptyForm(){

        $('#a_username').val();
        $('#a_password').val();
        $('#a_user_role').val();
        $('#a_employee_id').val();

        $('#e_username').val();
        $('#e_password').val();
        $('#e_user_role').val();
        $('#e_employee_id').val();

    }
    //insert into table without relaod/refresh page
    $("#insert").submit(function() {

        var username = $('#a_username').val();
        var password = $('#a_password').val();
        var user_role = $('#a_user_role').val();
        var employee_id = $('#a_employee_id').val();

        alert(username);

        $.ajax({
            method: "POST",
            url: "php/functions/function_user.php",
            cache:false,
            async: false,
            data: {
                'func': "insert",
                'username': username,
                'password': password,
                'user_role': user_role,
                'employee_id': employee_id
        
            },
            success: function(data) {
                $('#addUsersModal').hide();
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

        var username = $('#e_username').val();
        var password = $('#e_password').val();
        var user_role = $('#e_user_role').val();
        var employee_id = $('#e_employee_id').val();

        $.ajax({
            method: "POST",
            url: "php/functions/function_user.php",
            cache:false,
            async: false,
            data: {
                'func': "update",
                'username': username,
                'password': password,
                'user_role': user_role,
                'employee_id': employee_id
            },
            success: function(data) {
                $('#editUsersModal').hide();
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
            url: "php/functions/function_user.php",
            method: "POST",
            cache:false,
            data: {
                'func': "delete",
                'deleteID' : id
            },
            async: false, 
            success: function(response){
                $('#deleteUsersModal').hide();
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

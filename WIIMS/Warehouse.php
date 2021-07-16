<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
<main>
    <div class="main-containter">
        <div class="Warehouse">
            <div class="card">
            <form method="POST" action = "">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-warehouse"></span>
                        Warehouse
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addWarehouseModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
                            <button href = "#editWarehouseModal" class = "modalBtn btn-success" id = "edit_button" > Edit <span class="las la-edit"></span></button>
                            <button href = "#deleteWarehouseModal" class = "modalBtn btn-danger"> Delete <span class="las la-trash"></span></button>
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
                                        <td>Warehouse Code</td>
                                        <td>Warehouse Name</td>
                                        <td>Warehouse Address</td>
                                        <td>Warehouse Area</td>
                                        <td>Staff in Charge</td>
                                    </tr>
                                </thead>
                                <tbody class="tablecontent">
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
    <div id = "addWarehouseModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <form method ="POST" action ="">
                <div class="modal-body">
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "warehouse_code">Warehouse Code:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="a_warehouse_code" name = "warehouse_code" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "warehouse_name">Warehouse Name:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_warehouse_name" name = "warehouse_name" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="warehouse_address">Warehouse Address:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_warehouse_address" name = "warehouse_address" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "warehouse_area">Warehouse Area:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_warehouse_area" name = "warehouse_area" required> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "username">Username:</label>
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
                                    $sql = "SELECT username, user_role FROM user";
                                    $result = $con->query($sql) or die($con->error);
                                ?>
                                <select id= "a_username">
                                    <?php
                                        while($rows= $result-> fetch_assoc())
                                        {
                                            echo "<option value='".$rows['username']."'>".$rows['username']." - ".$rows['user_role']."</option>";
                                        }
                                        $con->close();
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <button class ="btn-submit" type=submit value="Confirm" id="insert" name="insert">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--add modal end-->
    <!--edit modal-->
    <div id = "editWarehouseModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <form method= "POST" action = "">
                <div class = "modal-body">
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "warehouse_code">Warehouse Code:</label>
                        </div>
                        <div class="input">
                            <input type="text" id="e_warehouse_code" name = "warehouse_code">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "warehouse_name">Warehouse Name:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_warehouse_name" name = "warehouse_name">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for ="warehouse_address">Warehouse Address:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_warehouse_address" name = "warehouse_address">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "warehouse_area">Warehouse Area:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_warehouse_area" name = "warehouse_area"> 
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "warehouse_area">Username:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_username" name = "username"> 
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
    <div id = "deleteWarehouseModal" class="modal fade">
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
    <script>

    $(document).ready(function(){
    //autofill edit inputs
    $("#edit_button").click(function() {
        var id = $('.selectable:checked').val();
        $.ajax({ 
            method: "POST",
            url: "php/functions/function_warehouse.php",
            cache:false,
            async: false,
            data: {
                'func': "auto_input",
                'edit_id':id
            },
            dataType:"json",
            success: function(data){
                $('#e_warehouse_code').val(data.warehouse_code);
                $('#e_warehouse_name').val(data.warehouse_name);
                $('#e_warehouse_address').val(data.warehouse_address);
                $('#e_warehouse_area').val(data.warehouse_area);
                $('#e_username').val(data.username);
            },
            error: function(){
                alert("ayaw"); //XD
            }
        });
    });
    // fetch data from table without reload/refresh page
    loadData();
    function loadData(){
        $.ajax({    //create an ajax request to display.php
            type: "POST",
            url: "php/functions/function_warehouse.php",
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

        $('#a_warehouse_code').val();
        $('#a_warehouse_name').val();
        $('#a_warehouse_address').val();
        $('#a_warehouse_area').val();
        $('#a_username').val();

        $('#e_warehouse_code').val();
        $('#e_warehouse_name').val();
        $('#e_warehouse_address').val();
        $('#e_warehouse_area').val();
        $('#e_username').val();

    }
    //insert into table without relaod/refresh page
    $("#insert").submit(function() {
        var warehouse_code = $('#a_warehouse_code').val();
        var warehouse_name = $('#a_warehouse_name').val();
        var warehouse_address = $('#a_warehouse_address').val();
        var warehouse_area = $('#a_warehouse_area').val();
        var username = $('#a_username').val();

        $.ajax({
            method: "POST",
            url: "php/functions/function_warehouse.php",
            cache:false,
            async: false,
            data: {
                'func': "insert",
                'warehouse_code': warehouse_code,
                'warehouse_name': warehouse_name,
                'warehouse_address': warehouse_address,
                'warehouse_area': warehouse_area,
                'username': username
        
            },
            success: function(data) {
                $('#addWarehouseModal').hide();
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

        var warehouse_code = $('#e_warehouse_code').val();
        var warehouse_name = $('#e_warehouse_name').val();
        var warehouse_address = $('#e_warehouse_address').val();
        var warehouse_area = $('#e_warehouse_area').val();
        var username = $('#e_username').val();

        $.ajax({
            method: "POST",
            url: "php/functions/function_warehouse.php",
            cache:false,
            async: false,
            data: {
                'func': "update",
                'warehouse_code': warehouse_code,
                'warehouse_name': warehouse_name,
                'warehouse_address': warehouse_address,
                'warehouse_area': warehouse_area,
                'username': username
            },
            success: function(data) {
                $('#editWarehouseModal').hide();
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
            url: "php/functions/function_warehouse.php",
            method: "POST",
            cache:false,
            data: {
                'func': "delete",
                'deleteID' : id
            },
            async: false, 
            success: function(response){
                $('#deleteWarehouseModal').hide();
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
    <!--delete modal end-->
</main>
<?php 
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>
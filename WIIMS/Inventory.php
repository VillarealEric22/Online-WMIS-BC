<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
<main>
    <div class="main-containter">
        <div class="inventory">
            <div class="card">
            <form method="POST">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-list"></span>
                        Inventory
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addInventoryModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
                            <button href = "#editInventoryModal" class = "modalBtn btn-success" id = "edit_button"> Edit <span class="las la-edit"></span></button>
                            <button href = "#deleteInventoryModal" class = "modalBtn btn-danger"> Delete <span class="las la-trash"></span></button>
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
                                        <td>Inventory ID</td>
                                        <td>Product Code</td>
                                        <td>Quantity</td>
                                        <td>Warehouse Code</td>
                                        <td>Date Created</td>
                                        <td>Stack Max Amount</td>
                                        <td>Amount in Stack</td>
                                        <td>Critical Amount</td>
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
        </div>
    </div>
    <!--add modal-->
    <div id = "addInventoryModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form method = "post" action ="">
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "inventory_id">Inventory ID:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="a_inventory_id" name = "inventory_id" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "product_code">Product Code:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_product_code" name = "product_code" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="quantity">Quantity:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_quantity" name = "quantity" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "warehouse_code">Warehouse Code:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_warehouse_code:" name = "warehouse_code" required> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "date_created">Date Created:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="a_date_created" name = "date_created" required> 
                            </div>
                        </div>
			            <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "stack_max_amt">Stack Max Amount:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="a_stack_max_amt" name = "stack_max_amt" required> 
                            </div>
                        </div>
			            <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "amt_in_stack">Amount in Stack:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="a_amt_in_stack" name = "amt_in_stack" required> 
                            </div>
                        </div>
			            <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "critical_amt">Critical Amount:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="a_critical_amt" name = "critical_amt" required> 
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <button class ="btn-submit" type = submit value="Confirm" id="insert" name="insert">Confirm</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--add modal end-->
    <!--edit modal-->
    <div id = "editInventoryModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action = "">
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "inventory_id">Inventory ID:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="e_inventory_id" name = "inventory_id">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "product_code">Product Code:</label>
                            </div>     
                            <div class="input-row">
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
                                    $sql = "SELECT product_code, product_name FROM products";
                                    $result = $con->query($sql) or die($con->error);
                                ?>
                                 <select id= "e_product_code">
                                    <?php
                                        while($rows= $result-> fetch_assoc())
                                        {
                                            echo "<option value='".$rows['product_code']."'>".$rows['product_code']." - ".$rows['product_name']."</option>";
                                        }
                                        $con->close();
                                    ?>
                                </select>
                            </div>
                        </div>                         
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="quantity">Quantity:</label>
                            </div>
                            <div class="input">
                            <input type ="text" id="e_quantity" name = "quantity">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "warehouse_code">Warehouse Code:</label>
                            </div>
                            <div class="input-row">
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
                                    $sql = "SELECT warehouse_code, warehouse_name FROM warehouses";
                                    $result = $con->query($sql) or die($con->error);
                                ?>
                                <select id= "e_warehouse_code">
                                    <?php
                                        while($rows= $result-> fetch_assoc())
                                        {
                                            echo "<option value='".$rows['warehouse_code']."'>".$rows['warehouse_code']." - ".$rows['warehouse_name']."</option>";
                                        }
                                        $con->close();
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "date_dreated">Date Created:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="date" id="e_date_created" name = "date_created" value = "<?php echo date("Y-m-d");?>"> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "stack_max_amt">Stack Max Amount:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="e_stack_max_amt" name = "stack_max_amt">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "amt_in_stack">Amount in Stack:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="e_amt_in_stack" name = "amt_in_stack">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "critical_amt">Critical Amount:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="e_critical_amt" name = "critical_amt">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-cancel" type="button">Cancel</button>
                        <button class ="btn-submit" value="Confirm" id ="update" name="update">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--edit modal end-->
    <!--delete modal-->
    <div id = "deleteInventoryModal" class="modal fade">
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
                    <button class ="btn-submit" name="delete" id="delete" value="confirm">Confirm</button>
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
            url: "php/functions/function_inventory.php",
            cache:false,
            async: false,
            data: {
                'func': "auto_input",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#e_inventory_id').val(data.inventory_id);
                $('#e_product_code').val(data.product_code);
                $('#e_quantity').val(data.quantity);
                $('#e_warehouse_code').val(data.warehouse_code);
                $('#e_date_created').val(data.date_created);
                $('#e_stack_max_amt').val(data.stack_max_amt);
                $('#e_amt_in_stack').val(data.amt_in_stack);
                $('#e_critical_amt').val(data.critical_amt);
                
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
            url: "php/functions/function_inventory.php",
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

        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

        $('#a_inventory_id').val();
        $('#a_product_code').val();
        $('#a_quantity').val();
        $('#a_warehouse_code').val();
        $('#a_date_created').val(today);
        $('#a_stack_max_amt').val();
        $('#a_amt_in_stack').val();
        $('#a_critical_amt').val();

        $('#e_inventory_id').val();
        $('#e_product_code').val();
        $('#e_quantity').val();
        $('#e_warehouse_code').val();
        $('#e_date_created').val(today);
        $('#e_stack_max_amt').val();
        $('#e_amt_in_stack').val();
        $('#e_critical_amt').val();

    }
    //insert into table without relaod/refresh page
    $("#insert").submit(function(e) {

        e.preventDefault();

        var inventory_id = $('#a_inventory_id').val();
        var product_code = $('#a_product_code').val();
        var quantity = $('#a_quantity').val();
        var warehouse_code = $('#a_warehouse_code').val();
        var date_created = $('#a_date_created').val();
        var stack_max_amt = $('#a_stack_max_amt').val();
        var amt_in_stack = $('#a_amt_in_stack').val();
        var critical_amt = $('#a_critical_amt').val();

        $.ajax({
            method: "POST",
            url: "php/functions/function_inventory.php",
            cache:false,
            async: false,
            data: {
            'func': "insert",
            'inventory_id': inventory_id,
            'product_code': product_code,
            'quantity': quantity,
            'warehouse_code': warehouse_code,
            'i_date': i_date,
            'stack_max_amt': stack_max_amt,
            'amt_in_stack': amt_in_stack,
            'critical_amt': critical_amt
        
            },
            success: function(data) {
                $('#addInventoryModal').hide();
                alert(data);
                loadData();
                emptyForm();
            },
            error: function(){
                alert("hagorn")
        }
        });
    });
    // update data from table without relaod/refresh page
    $("#update").click(function(e) {
            e.preventDefault();

            var inventory_id = $('#e_inventory_id').val();
            var product_code = $('#e_product_code').val();
            var quantity = $('#e_quantity').val();
            var warehouse_code = $('#e_warehouse_code').val();
            var date_created = $('#e_date_created').val();
            var stack_max_amt = $('#e_stack_max_amt').val();
            var amt_in_stack = $('#e_amt_in_stack').val();
            var critical_amt = $('#e_critical_amt').val();

            alert(inventory_id + product_code + warehouse_code + date_created + stack_max_amt + amt_in_stack + critical_amt);

            $.ajax({
                method: "POST",
                url: "php/functions/function_inventory.php",
                cache:false,
                async: false,
                data: {
                    'func': "update",
                    'inventory_id': inventory_id,
                'product_code': product_code,
                'quantity': quantity,
                'warehouse_code': warehouse_code,
                'i_date': i_date,
                'stack_max_amt': stack_max_amt,
                'amt_in_stack': amt_in_stack,
                'critical_amt': critical_amt
                },
                success: function(data) {
                    $('#editInventoryModal').hide();
                    alert(data);
                    loadData();
                    emptyForm();
                },
                error: function(){
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
            url: "php/functions/function_inventory.php",
            method: "POST",
            cache:false,
            data: {
                'func': "delete",
                'deleteID' : id
            },
            async: false, 
            success: function(response){
                $('#deleteInventoryModal').hide();
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
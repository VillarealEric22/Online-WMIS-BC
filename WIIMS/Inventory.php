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
                            <button href = "#editInventoryModal" class = "modalBtn btn-success" id = "edit_button" disabled = "disabled"> Edit <span class="las la-edit"></span></button>
                            <button href = "#deleteInventoryModal" class = "modalBtn btn-danger" id = "delete_button" disabled = "disabled"> Delete <span class="las la-trash"></span></button>
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
                                        <td id = "i_id">Inventory ID</td>
                                        <td id = "date">Date Created</td>
                                        <td id = "p_code">Product Name</td>
                                        <td id = "B_qty">Beginning Qty</td>
                                        <td id = "P_qty">Purchases</td>
                                        <td id = "qty">Current Stock</td>
                                        <td id = "crit">Critical Amount</td>                                   
                                        <td id = "w_code">Warehouse Name</td>                                       
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
                            <div class="input-row">
                                <input type="text" list = "d_product" id="a_product_code" required>
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
                                 <datalist id= "d_product">
                                    <?php
                                        while($rows= $result-> fetch_assoc())
                                        {
                                            echo "<option value='".$rows['product_code']."'>".$rows['product_name']."</option>";
                                        }
                                        $con->close();
                                    ?>
                                </datalist>
                            </div>
                        </div>         
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="quantity">Beginning Qty:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_bQty" name = "quantity" required>
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
                                <select id= "a_warehouse_code">
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
                                <label class = modal-form-label for = "date_created">Date Created:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="date" id="a_date_created" name = "date_created" value = "<?php echo date("Y-m-d");?>" required> 
                            </div>
                        </div>
                            <div class="input-label">
                                <label class = modal-form-label for = "critical_amt">Critical Amount:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="a_critical_amt" name = "critical_amt" required> 
                            </div>
                        </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <button class ="btn-submit" type ="submit" value="Confirm" id="insert" name="insert">Confirm</button>
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
                                <input type="text" id="e_inventory_id" name = "inventory_id" disabled>
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
                                <label class = modal-form-label for ="quantity">Beginning Qty:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="e_bQty" name = "quantity">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="quantity">Current Qty:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="e_cQty" name = "quantity" disabled>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="quantity">Purchase Qty:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="e_pQty" name = "quantity" disabled>
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
                                <label class = modal-form-label for = "date_created">Date Created:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="date" id="e_date_created" name = "date_created" value = "<?php echo date("Y-m-d");?>"> 
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
                        <button class ="btn-submit" value="Confirm" id="update" name="update">Confirm</button>
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
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
                $("#sortable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        //table sort by ascending/descending
        function sortTable(f,n){
            var rows = $('#sortable tbody tr').get();
            rows.sort(function(a, b) {
                var A = getVal(a);
                var B = getVal(b);

                if(A < B) {
                    return -1*f;
                }
                if(A > B) {
                    return 1*f;
                }
                return 0;
            });
            function getVal(elm){
                var v = $(elm).children('td').eq(n).text().toUpperCase();
                if($.isNumeric(v)){
                    v = parseInt(v,10);
                }
                return v;
            }
            $.each(rows, function(index, row) {
                $('#sortable').children('tbody').append(row);
            });
        }
        var f_iid = 1;
        var f_pcode = 1;
        var f_qty = 1;
        var f_wcode = 1;
        var f_date = 1;
        var f_crit = 1;
        $("#i_id").click(function(){
            f_iid *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_iid,n);
        });
        $("#p_code").click(function(){
            f_pcode *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_pcode,n);
        });
        $("#qty").click(function(){
            f_qty *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_qty,n);
        });
        $("#w_code").click(function(){
            f_wcode *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_wcode,n);
        });
        $("#date").click(function(){
            f_date *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_date,n);
        });
        $("#crit").click(function(){
            f_crit *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_crit,n);
        });
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
                $('#e_bQty').val(data.bQty);
                $('#e_pQty').val(data.pQty);
                $('#e_cQty').val(data.curr_quantity);
                $('#e_warehouse_code').val(data.warehouse_code);
                $('#e_date_created').val(data.date_created);
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
        $('#a_bQty').val();
        $('#a_warehouse_code').val();
        $('#a_date_created').val(today);
        $('#a_critical_amt').val();

        $('#e_inventory_id').val();
        $('#e_product_code').val();
        $('#e_bQty').val();
        $('#e_pQty').val();
        $('#e_cQty').val();
        $('#e_warehouse_code').val();
        $('#e_date_created').val(today);
        $('#e_critical_amt').val();

    }
    //insert into table without relaod/refresh page
    $("#insert").click(function() {

        var valid = this.form.checkValidity();
        var inventory_id = $('#a_inventory_id').val();
        var product_code = $('#a_product_code').val();
        var bQty = $('#a_bQty').val();
        var warehouse_code = $('#a_warehouse_code').val();
        var date_created = $('#a_date_created').val();
        var critical_amt = $('#a_critical_amt').val();

        // validationnnnn
        $("#valid").html(valid);
        if (valid) {
        event.preventDefault(); 

        $.ajax({
            method: "POST",
            url: "php/functions/function_inventory.php",
            cache:false,
            async: false,
            data: {
            'func': "insert",
            'inventory_id': inventory_id,
            'product_code': product_code,
            'bQty': bQty,
            'warehouse_code': warehouse_code,
            'i_date': date_created,
            'critical_amt': critical_amt
        
            },
            success: function(data) {
                $('#addInventoryModal').hide();
                alert(data);
                loadData();
                emptyForm();
            },
            error: function(){
                alert(data);
                alert("hagorn")
        }
        });
    }
    });
    // update data from table without relaod/refresh page
    $("#update").click(function(e) {
            e.preventDefault();

            var inventory_id = $('#e_inventory_id').val();
            var product_code = $('#e_product_code').val();
            var bQty = $('#e_bQty').val();
            var pQty = $('#e_pQty').val();
            var cQty = $('#e_cQty').val();
            var warehouse_code = $('#e_warehouse_code').val();
            var date_created = $('#e_date_created').val();
            var critical_amt = $('#e_critical_amt').val();

            $.ajax({
                method: "POST",
                url: "php/functions/function_inventory.php",
                cache:false,
                async: false,
                data: {
                'func': "update",
                'inventory_id': inventory_id,
                'product_code': product_code,
                'bQty': bQty,
                'pQty': pQty,
                'cQty': cQty,
                'warehouse_code': warehouse_code,
                'i_date': date_created,
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
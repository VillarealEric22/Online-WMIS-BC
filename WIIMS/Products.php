<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');

 
?>
<main>
    <div class="main-containter">
        <div class="products">
            <div class="card">
            <form method="POST">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-boxes"></span>
                            <Select name="tableName" id="tbName" onchange="location.href=this.value">
                                    <option value = "Products.php" > Products </option>
                                    <option value = "Packages.php" > Packages </option> 
                            </Select>
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addProductModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
                            <button href = "#editProductModal" class = "modalBtn btn-success" id = "edit_button"> Edit <span class="las la-edit"></span></button>
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
                                <label> Search: <input type="search" placeholder="" id = "searchInput"></label> 
                            </div>
                        </div>
                        <div class="row">
                            <table id="sortable" class="table" width = "100%">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td>Product Code</td>
                                        <td>Name</td>
                                        <td>Manufacturer</td>
                                        <td>Product Type</td>
                                        <td>Capacity</td>
                                        <td>Color</td>
                                        <td>Price</td>
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
    <div id = "addProductModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class = "modal-body">
                <form method = "POST">
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "product_type">Product Type:</label>
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
                                    $sql = "SELECT product_type FROM product_category";
                                    $result = $con->query($sql) or die($con->error);
                                ?>
                                <select id= "a_product_type">
                                    <?php
                                        while($rows= $result-> fetch_assoc())
                                        {
                                            echo "<option value='".$rows['product_type']."'>" .$rows['product_type']."</option>";
                                        }
                                        $con->close();
                                    ?>    
                                </select>
                            <button href = "#productTypeModal" class = "modalBtn"> ... </button>
                            </div>                           
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "product_name">Product Name:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_product_name" name = "product_name" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "product_code">Product Code:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="a_product_code" name = "product_code" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "capacity">Capacity:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="a_capacity" name = "capacity" required> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="manufacturer">Manufacturer:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_manufacturer" name = "manufacturer" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "color">Color:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_color" name = "color" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "item_price">Price:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_item_price" name = "item_price" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editdimensions">Dimensions:</label>
                            </div>
                            <Select name="unitLength" id="unitLength">
                                    <option value = "mm" > mm </option>
                                    <option value = "in" > in </option>
                                    <option value = "cm" > cm </option>
                            </Select>
                            <div class="input">
                                <!--<label>(L)</label>-->
                                <input type ="text" id="a_lenght" name = "lenght" placeholder="(L)">
                            </div>
                            <div class="input">
                                <!--<label>(W)</label>--> 
                                <input type ="text" id="a_width" name = "width" placeholder="(W)">
                            </div>
                            <div class="input">
                                <!--<label>(H)</label>-->
                                <input type ="text" id="a_height" name = "height" placeholder="(H)">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "supplier_id">Supplier Name:</label>
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
                                    $sql = "SELECT supplier_id, supplier_name FROM supplier";
                                    $result = $con->query($sql) or die($con->error);
                                ?>
                                <select id= "a_supplier_id">
                                    <?php
                                        while($rows= $result-> fetch_assoc())
                                        {
                                            echo "<option value='".$rows['supplier_id']."'>".$rows['supplier_id']." - ".$rows['supplier_name']."</option>";
                                        }
                                        $con->close();
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <button class ="btn-submit" type="submit" value="Confirm" id="insert" name="insert">Confirm</button>
                </div>
                </form>
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
                <form method = "POST">
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "edittype">Product Type:</label>
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
                                    $sql = "SELECT product_type FROM product_category";
                                    $result = $con->query($sql) or die($con->error);
                                ?>
                                <select id= "e_product_type">
                                    <?php
                                        while($rows= $result-> fetch_assoc())
                                        {
                                            echo "<option value='".$rows['product_type']."'>" .$rows['product_type']."</option>";
                                        }
                                        $con->close();
                                    ?>    
                                </select>
                            <button href = "#productTypeModal" class = "modalBtn"> ... </button>
                            </div>                           
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "product_name">Product Name:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="e_product_name" name = "product_name">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "product_code">Product Code:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="e_product_code" name = "product_code">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "capacity">Capacity:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="e_capacity" name = "capacity"> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="manufacturer">Manufacturer:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="e_manufacturer" name = "manufacturer">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "color">Color:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="e_color" name = "color">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "item_price">Price:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="e_item_price" name = "item_price">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editdimensions">Dimensions:</label>
                            </div>
                            <Select name="unitLength" id="unitLength">
                                    <option value = "mm" > mm </option>
                                    <option value = "in" > in </option>
                                    <option value = "cm" > cm </option>
                            </Select>
                            <div class="input">
                                <!--<label>(L)</label>-->
                                <input type ="text" id="e_lenght" name = "e_lenght" placeholder="(L)">
                            </div>
                            <div class="input">
                                <!--<label>(W)</label>-->
                                <input type ="text" id="e_width" name = "width" placeholder="(W)">
                            </div>
                            <div class="input">
                                <!--<label>(H)</label>-->
                                <input type ="text" id="e_height" name = "height" placeholder="(H)">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "supplier_id">Supplier Name:</label>
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
                                    $sql = "SELECT supplier_id, supplier_name FROM supplier";
                                    $result = $con->query($sql) or die($con->error);
                                ?>
                                <select id= "e_supplier_id">
                                    <?php
                                        while($rows= $result-> fetch_assoc())
                                        {
                                            echo "<option value='".$rows['supplier_id']."'>".$rows['supplier_id']." - ".$rows['supplier_name']."</option>";
                                        }
                                        $con->close();
                                    ?>
                                </select>
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
                    <button class ="btn-submit" value="submit" id="delete" name="delete">Confirm</button>
                </div>
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
        //autofill edit inputs
        $("#edit_button").click(function() {
            var id = $('.selectable:checked').val();
            $.ajax({
                method: "POST",
                url: "php/functions/function_product.php",
                cache:false,
                async: false,
                data: {
                    'func': "auto_input",
                    'edit_id':id
                },
                dataType:"json",
                success: function(data) {

                    $('#e_product_code').val(data.product_code);
                    $('#e_product_name').val(data.product_name);
                    $('#e_manufacturer').val(data.manufacturer);
                    $('#e_capacity').val(data.capacity);
                    $('#e_product_type').val(data.product_type);
                    $('#e_color').val(data.color);
                    $('#e_lenght').val(data.lenght);
                    $('#e_width').val(data.width);
                    $('#e_height').val(data.height);
                    $('#e_item_price').val(data.item_price);
                    $('#e_supplier_id').val(data.supplier_id);
                    
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
                url: "php/functions/function_product.php",
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

            $('#a_product_code').val();
            $('#a_product_name').val();
            $('#a_manufacturer').val();
            $('#a_capacity').val();
            $('#a_product_type').val();
            $('#a_color').val();
            $('#a_lenght').val();
            $('#a_width').val();
            $('#a_height').val();
            $('#a_item_price').val();
            $('#a_supplier_id').val();

            $('#e_product_code').val();
            $('#e_product_name').val();
            $('#e_manufacturer').val();
            $('#e_capacity').val();
            $('#e_product_type').val();
            $('#e_color').val();
            $('#e_lenght').val();
            $('#e_width').val();
            $('#e_height').val();
            $('#e_item_price').val();
            $('#e_supplier_id').val();
        }
        //insert into table without relaod/refresh page
        $("#insert").click(function(){
            var valid = this.form.checkValidity();
            var product_code = $('#a_product_code').val();
            var product_name = $('#a_product_name').val();
            var manufacturer = $('#a_manufacturer').val();
            var capacity = $('#a_capacity').val();
            var product_type = $('#a_product_type').val();
            var color = $('#a_color').val();
            var lenght = $('#a_lenght').val();
            var width= $('#a_width').val();
            var height= $('#a_height').val();
            var item_price = $('#a_item_price').val();
            var supplier_id= $('#a_supplier_id').val();

            // validationnnnn
            $("#valid").html(valid);
            if (valid) {
            event.preventDefault(); 

            $.ajax({
                method: "POST",
                url: "php/functions/function_product.php",
                cache:false,
                async: false,
                data: {
                    'func': "insert",
                    'product_code':product_code, 
                    'product_name':product_name,
                    'manufacturer':manufacturer,
                    'capacity':capacity, 
                    'product_type':product_type,
                    'color':color,
                    'lenght':lenght,
                    'width':width,
                    'height':height,
                    'item_price':item_price,
                    'supplier_id':supplier_id
                },
                
                success: function(data) {
                    $('#addProductModal').hide();
                    alert(data);
                    loadData();
                    emptyForm();
                    console.log(data);
                },
                error: function(){
                    alert(data);
                    alert("hagorn")
            }
            });
        }
        });
        // update data from table without relaod/refresh page
        $("#update").click(function() {
            event.preventDefault();
            var product_code= $('#e_product_code').val();
            var product_name= $('#e_product_name').val();
            var manufacturer= $('#e_manufacturer').val();
            var capacity= $('#e_capacity').val();
            var product_type= $('#e_product_type').val();
            var color= $('#e_color').val();
            var lenght= $('#e_lenght').val();
            var width= $('#e_width').val();
            var height= $('#e_height').val();
            var item_price = $('#e_item_price').val();
            var supplier_id= $('#e_supplier_id').val();

            $.ajax({
                method: "POST",
                url: "php/functions/function_product.php",
                cache:false,
                async: false,
                data: {
                    'func': "update",
                    'product_code':product_code, 
                    'product_name':product_name,
                    'manufacturer':manufacturer, 
                    'capacity':capacity,
                    'product_type':product_type,
                    'color':color,
                    'lenght':lenght,
                    'width':width,
                    'height':height,
                    'item_price':item_price,
                    'supplier_id':supplier_id
                },
                success: function(data) {
                    $('#editProductModal').hide();
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
                url: "php/functions/function_product.php",
                method: "POST",
                cache:false,
                data: {
                    'func': "delete",
                    'deleteID' : id},
                async: false, 
                success: function(response){
                    $('#deleteProductModal').hide();
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
    <div id = "productTypeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product Type</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="modal-message">
                        <table id="ptypeTable" class="modalTable" width = "100%">
                                <thead>
                                    <tr>
                                        <td>Product Type</td>
                                        <td>Description</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input class ="medium-input" type="string"></td>
                                        <td><input class ="medium-input" type="string"></td>
                                        <td><button><span class="las la-plus"></span></button></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Oven</td>
                                        <td class = "description">Oven tol</td>
                                        <td><button><span class="las la-trash"></span></button></td>
                                    </tr>
                                    <tr>
                                        <td>Oven</td>
                                        <td class = "description">Oven tol</td>
                                        <td><button><span class="las la-trash"></span></button></td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <button class ="btn-submit" value="Confirm" id="delete" name="delete">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>

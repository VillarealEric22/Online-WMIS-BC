<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
<main>
    <div class="main-containter">
        <div class="products">
            <div class="card">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-boxes"></span>
                            <Select name="tableName" id="tbName" onchange="location.href=this.value">
                                <option value = "Packages.php"> Packages </option>
                                <option value = "Products.php"> Products </option>
                            </Select>
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addProductModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
                            <button href = "#editProductModal" class = "modalBtn btn-success" id = "edit_button"> Edit <span class="las la-edit"></span></button>
                            <button href = "#deletePkgModal" class = "modalBtn btn-danger"> Delete <span class="las la-trash"></span></button>
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
                                        <td>Package ID</td>
                                        <td>Package Price</td>
                                        <td>Items</td>
                                    </tr>
                                </thead>
                                <tbody class = "tablecontent">
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
    <div id = "addProductModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addpkgname">Package Name:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_package_code" name = "addpkgname">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "items">Items:</label>
                            </div>
                            <div class="input">
                                <table id="prodCart" class="modalTable" width = "100%">
                                    <thead>
                                        <tr>
                                            <td>Product Code</td>
                                            <td>Qty</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input class ="medium-input" id = "a_product" type="string"></td>
                                            <td><input class ="small-input" id = "a_qty" type="number" min="0"></td>
                                            <td><button class = "addItem"><span class="las la-plus"></span></button></td>
                                        </tr>     
                                    </tbody>
                                </table>
                            </div>  
                        </div>    
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "pkgaddprice">Package Price:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_price" name = "pkgaddprice">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <button class ="btn-submit" value="Confirm" id="insert" name="insert">Confirm</button>
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
                <div class="modal-body">
                    <form method="POST">
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addpkgname">Package Name:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="e_package_code" name = "addpkgname">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "items">Items:</label>
                            </div>
                            <div class="input">
                                <table id="e_prodCart" class="modalTable" width = "100%">
                                    <thead>
                                        <tr>
                                            <td>Product Code</td>
                                            <td>Qty</td>
                                            <td></td>
                                    </thead>
                                    <tbody class = "tbModal">
                                        <tr>
                                            <td><input class ="medium-input" id = "e_product" type="string"></td>
                                            <td><input class ="small-input" id = "e_qty" type="number" min="0"></td>
                                            <td><button class = "addItem"><span class="las la-plus"></span></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>  
                        </div>    
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "pkgaddprice">Package Price:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="e_price" name = "pkgaddprice">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <button class ="btn-submit" value="Confirm" id="insert" name="insert">Confirm</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--edit modal end-->
    <!--delete modal-->
    <div id = "deletePkgModal" class="modal fade">
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
    <!--view modal-->
    <div id = "viewPkgItem" class="modal fade">
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
                        <table id="pdcsTable" class="modalTable" width = "100%">
                            <thead>
                                <tr>
                                    <td>Product </td>
                                    <td>Quantity </td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody class = "tbModal">

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
<script type="text/javascript">
    $(document).ready(function(){
        //add button click
        $(".addItem").click(function(e){
            e.preventDefault();
            var prod = $("#product").val();
            var qty = $("#qty").val();
            var prode = $("#e_product").val();
            var qtye = $("#e_qty").val();
            var insertRec = "<tr><td class = 'pkgitem'>"+ prod +"</td><td><input class ='small-input itemqty' type='number' min='0' value = "+ qty +"></td>" + "<td><button class = 'removeItem'><span class='las la-trash'></span></button></td></tr>";
            var insertRece = "<tr><td class = 'pkgitem'>"+ prode +"</td><td><input class ='small-input itemqty' type='number' min='0' value = "+ qtye +"></td>" + "<td><button class = 'removeItem'><span class='las la-trash'></span></button></td></tr>";
            $("#prodCart tbody").append(insertRec);
            $("#e_prodCart tbody").append(insertRece);
            $("#product").val("");
            $("#qty").val("");
            $("#e_product").val("");
            $("#e_qty").val("");
        });
        //remove button is clicked
        $("#prodCart").on('click', '.removeItem', function(e){
            e.preventDefault();
            $(this).parents("tr").remove(); //Remove field html
        });
        $("#e_prodCart").on('click', '.removeItem', function(e){
            e.preventDefault();
            $(this).parents("tr").remove(); //Remove field html
        });
    });
    $(document).ready(function(){
    // fetch data from table without reload/refresh page
    loadData();
    function loadData(){
        $.ajax({    //create an ajax request to display.php
            type: "POST",
            url: "php/functions/function_packages.php",
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
        alert("empty");
    }
    //autofill edit inputs
    $("#edit_button").click(function() {
        var id = $('.selectable:checked').val();
        $.ajax({
            method: "POST",
            url: "php/functions/function_packages.php",
            cache:false,
            async: false,
            data: {
                'func': "auto_input",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#e_package_code').val(data.package_code);
                $('#e_price').val(data.total_price);
            },
            error: function(){
                alert("ayaw");
                alert(id);
        }
        });
    });
    // view products
    $("#sortable").on("click",'.btn_view', function(e) {
        e.preventDefault();
        var id = $(this).val();    
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "php/functions/function_packages.php",
            cache:false,
            async: false,
            data: {
                'func': "view",
                'viewID':id
            },
            success: function(response) {
                $('#viewPkgItem').show();
                $(".tbModal").html(response);
            },
            error: function(){
                alert("ayaw");
            }
        });
    });
    //insert into table without relaod/refresh page
    $("#insert").click(function() {
        var package_code = $('#a_package_code').val();
        var package_price= $('#a_price').val();
        var product_code = [];
        var quantity = [];
        var arrPcode = [];
        $("tr").find(".pkgitem").each(function(){
            product_code.push($(this).text());
        });
        $(".itemqty").each(function(){
            quantity.push($(this).val());
            arrPcode.push(package_code);
        });
        $.ajax({
            method: "POST",
            url: "php/functions/function_packages.php",
            cache:false,
            async: false,
            data: {
                'func': "insert",
                'package_code':package_code,
                'package_price':package_price,
                'product_code':product_code,
                'quantity':quantity,
                'pkgcd':arrPcode,
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
        var package_code = $('#e_package_code').val();
        var package_price= $('#e_price').val();
        var product_code = [];
        var quantity = [];
        var arrPcode = [];
        $("tr").find(".pkgitem").each(function(){
            product_code.push($(this).text());
        });
        $(".itemqty").each(function(){
            quantity.push($(this).val());
            arrPcode.push(package_code);
        });
        $.ajax({
            method: "POST",
            url: "php/functions/function_packages.php",
            cache:false,
            async: false,
            data: {
                'func': "update",
                'e_id':e_id,
                'e_ln':e_ln,
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
            url: "php/functions/function_packages.php",
            method: "POST",
            cache:false,
            data: {
                'func': "delete",
                'deleteID' : id
            },
            async: false, 
            success: function(response){
                $('#deletePkgModal').hide();
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
<?php
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>

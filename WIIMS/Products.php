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
                                    <option value = "Products.php" > Products </option>
                                    <option value = "Packages.php" > Packages </option>
                            </Select>
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addProductModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
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
                    <form>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addptype">Product Type:</label>
                            </div>
                            <div class="input">
                            <Select name="tableName" id="tbName">
                                    <option value = "type 1" > type 1 </option>
                                    <option value = "type 2" > type 2 </option>
                                    <option value = "type 3" > type 3 </option>
                            </Select>
                            <button href = "#productTypeModal" class = "modalBtn"> ... </button>
                            </div>                           
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addproductname">Product Name:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addproductname" name = "addproductname">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addproductcode">Product Code:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="addproductcode" name = "addproductcode">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addcapacity">Capacity:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="addcapacity" name = "addcapacity"> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="addmanufacturer">Manufacturer:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addmanufacturer" name = "addmanufacturer">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addcolor">Color:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addcolor" name = "addcolor">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addprice">Price:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addprice" name = "addprice">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "adddimensions">Dimensions:</label>
                            </div>
                            <Select name="unitLength" id="unitLength">
                                    <option value = "mm" > mm </option>
                                    <option value = "in" > in </option>
                                    <option value = "cm" > cm </option>
                            </Select>
                            <div class="input">
                                <label>(L)</label>
                                <input type ="text" id="addlength" name = "addlength">
                            </div>
                            <div class="input">
                                <label>(W)</label>
                                <input type ="text" id="addwidth" nmae = "addwidth">
                            </div>
                            <div class="input">
                                <label>(H)</label>
                                <input type ="text" id="addheight" nmae = "addheight">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addsupplier">Supplier Name:</label>
                            </div>                              
                            <div class="input">                               
                            <Select name="addsuplier" id="addsupplier">
                                    <option value = "Products" > type 1 </option>
                                    <option value = "Packages" > type 2 </option>
                                    <option value = "Packages" > type 3 </option>
                            </Select>
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
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "edittype">Product Type:</label>
                            </div>
                            <div class="input">
                            <Select name="tableName" id="tbName">
                                    <option value = "type 1" > type 1 </option>
                                    <option value = "type 2" > type 2 </option>
                                    <option value = "type 3" > type 3 </option>
                            </Select>
                            <button href = "#productTypeModal" class = "modalBtn"> ... </button>
                            </div>                           
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editproductname">Product Name:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="editproductname" name = "editproductname">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editproductcode">Product Code:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="editproductcode" name = "editproductcode">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editcapacity">Capacity:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="editcapacity" name = "editcapacity"> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="editmanufacturer">Manufacturer:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="editmanufacturer" name = "editmanufacturer">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editcolor">Color:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="editcolor" name = "editcolor">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editprice">Price:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="editprice" name = "editprice">
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
                                <label>(L)</label>
                                <input type ="text" id="editlength" name = "editlength">
                            </div>
                            <div class="input">
                                <label>(W)</label>
                                <input type ="text" id="editwidth" nmae = "editwidth">
                            </div>
                            <div class="input">
                                <label>(H)</label>
                                <input type ="text" id="editheight" nmae = "editheight">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editsupplier">Supplier Name:</label>
                            </div>                              
                            <div class="input">                               
                            <Select name="editsuplier" id="editsupplier">
                                    <option value = "Products" > type 1 </option>
                                    <option value = "Packages" > type 2 </option>
                                    <option value = "Packages" > type 3 </option>
                            </Select>
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
    <script>
    $(document).ready(function(){
        // fetch data from table without reload/refresh page
        loadData();
        function loadData(){
            $.ajax({    //create an ajax request to display.php
                type: "POST",
                url: "php/functions/Display_products.php",                             
                success: function(response){                    
                    $(".tablecontent").html(response); 
                },
                error: function(){
                    alert("Something went wrong");
                }
            });
        }
        function emptyForm(){

            $('#a_product_code').val('');
            $('#a_product_name').val('');
            $('#a_manufacturer').val('');
            $('#a_capacity').val('');
            $('#a_product_type').val('');
            $('#a_color').val('');
            $('#a_item_price').val('');
            $('#a_purchase_price').val('');
        }
        //insert into table without relaod/refresh page
        $("#insert").click(function() {
            var p_code= $('#a_product_code').val();
            var p_name= $('#a_product_name').val();
            var p_mftr= $('#a_manufacturer').val();
            var p_capacity= $('#a_capacity').val();
            var p_ype= $('#a_product_type').val();
            var p_color= $('#a_color').val();
            var p_iprice = $('#a_item_price').val();
            var p_pprice= $('#a_purchase_price').val();

            $.ajax({
                method: "POST",
                url: "php/functions/Add_products.php",
                cache:false,
                async: false,
                data: {
                    'p_code':p_code, 
                    'p_name':p_name,
                    'p_mftr':p_mftr, 
                    'p_type':p_type,
                    'p_capcity':p_capcity,
                    'p_color':p_color,
                    'p_iprice':p_iprice,
                    'p_pprice':p_pprice,
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
            var p_code= $('#a_product_code').val();
            var p_name= $('#a_product_name').val();
            var p_mftr= $('#a_manufacturer').val();
            var p_capacity= $('#a_capacity').val();
            var p_ype= $('#a_product_type').val();
            var p_color= $('#a_color').val();
            var p_iprice = $('#a_item_price').val();
            var p_pprice= $('#a_purchase_price').val();

            $.ajax({
                method: "POST",
                url: "php/functions/Update_products.php",
                cache:false,
                async: false,
                data: {
                    'p_code':p_code, 
                    'p_name':p_name,
                    'p_mftr':p_mftr, 
                    'p_type':p_type,
                    'p_capcity':p_capcity,
                    'p_color':p_color,
                    'p_iprice':p_iprice,
                    'p_pprice':p_pprice,
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
                url: "php/functions/Delete_products.php",
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
                    <a class="btn-confirm" href="">Confirm</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>

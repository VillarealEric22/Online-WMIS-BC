<?php
    include('includes/navs.php');
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>Products</h2>
                <div class="crud-buttons">
                    <button href = "#product" class = "btn modalbtn blue" id = "add_btn">Add</button>
                    <button href = "#product" class = "btn modalbtn green" id = "edit_btn" disabled = "disabled">Edit</button>
                    <button href = "#delete" class = "btn modalbtn red" id = "delete_btn" disabled = "disabled">Delete</button>
                </div>
            </div>
            <div class="content-row">
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
                <div class="legend">
                    <span class = "status pending">Low Stocks</span>
                    <span class = "status return">Critical Amount</span>
                </div>
                <div class="table-search">
                    <label> Search: <input type="search" placeholder="" id = "searchInput"></label> 
                </div>
            </div>
        </div>
        <div class="content-row">
            <table id ="sortable">
                <thead>
                    <tr>
                        <td></td>
                        <td>Image</td>
                        <td id = 'code-h'>Product Code</td>
                        <td id = 'name-h'>Name</td>
                        <td id = 'type-h'>Type</td>                        
                        <td id = 'available_qty-h'>Qty Available</td>
                        <td id = 'price-h'>Price</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody id = "table-data">
                    
                </tbody>
            </table>
        </div>
        <div class="content-row bottom">
            <div class="table-pagination">
                <ul class = pagination>
                </ul>
            </div>
            <div class="table-info">
                Total rows: <span class = "t-rows"></span>
            </div>
        </div>
    </div>
</div>
<div id="product" class="modal">    
    <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action'> Add </span> Products</div><div class="close-div"><span href="#" class = "link-2 close"></span></button></div></div>
        <div class="content">
            <form action="#">
                <div class="input-details">
                    <div class="input-box">
                        <span class="label">Product Type</span>
                        <select id="product_type" autocomplete="off" style = "width:100%">
                        </select>
                        <button href = "#productCateg" type="button" class = "modalbtn" style="width:100%;">Add New</button>
                    </div>
                    <div class="input-box">
                        <span class="label">Supplier</span>
                        <select id="supplier_id" autocomplete="off" style = "width:100%">
                        </select>
                        <button href= "#supplier" type="button" class = "modalbtn" style="width:100%;">Add New</button>
                    </div>
                    <div class="input-box">
                        <span class="label">Product Code</span>
                        <input type="text" id = "product_code" placeholder="Product Code" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Product Name</span>
                        <input type="text" id = "product_name" placeholder="Product Name" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Price</span>
                        <input type="number" value = "0" min = "0" id ="price" placeholder="Price" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Warranty Code</span>
                        <select id="warranty_code" autocomplete="off" style = "width:100%">
                        </select>
                        <button href = "#warranty" type="button" class = "modalbtn" style="width:100%;">Add New</button>
                    </div>
                    <div class="input-box">
                        <span class="label">Manufacturer</span>
                        <input type="text" id = "manufacturer" placeholder="Manufacturer" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Color/Variation</span>
                        <input type="text" id ="color" placeholder="Color/Variation" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Safety Stock</span>
                        <input type="number" value = "0" min = "0" id = "critical_amt" placeholder="Critical Amount" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Re-order point</span>
                        <input type="number" value = "0" min = "0" id = "rop" placeholder="Re-order point" required>
                    </div>
                </div>
                <div class="extra-details">
                    <div class="input-box">
                        <span class="label">Re-order strategy</span>
                        <select id="ro_style" autocomplete="off" style = "width:100%">
                            <option value ='Safety'>Safety Stock</option>    
                            <option value ='JIT'>JIT</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="label">Description</span>
                        <textarea class = "desc" id = "descr" maxlength="250" placeholder="Item Description/ Extra Details here"></textarea>
                    </div>
                    <div class="input-box">
                        <span class="label">Product Image</span>
                        <input type ="file" id="image" accept="image/png, image/gif, image/jpeg">
                    </div>
                </div>
            </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate" class = 'btn-cancel'>Cancel</button>
                    <input type="submit" id = "form-submit" value="Insert"/>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="view" class="modal">    
    <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action'> View </span> Products</div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <div class="img-info-split">
                <div class="img-content">
                    <img src='' id ='fileimg' width="300px" height="300px" alt="Product_image">
                </div>
                <div class="info-content">
                    <ul>
                        <li class = 'prod-content'><strong>Product Code: </strong><span class = 'info' id = 'vproduct_code'></span></li>
                        <li class = 'prod-content'><strong>Product Name: </strong><span class = 'info' id = 'vproduct_name'></span></li>
                        <li class = 'prod-content'><strong>Supplier: </strong><span class = 'info' id = 'vsupplier_id'></span></li>
                        <li class = 'prod-content'><strong>Manufacturer: </strong><span class = 'info' id = 'vmanufacturer'></span></li>
                        <li class = 'prod-content'><strong>Product Type: </strong><span class = 'info' id = 'vproduct_type'></span></li>
                        <li class = 'prod-content'><strong>Item Price: </strong><span class = 'info' id = 'vprice'></span></li>
                        <li class = 'prod-content'><strong>Warranty: </strong><span class = 'info' id = 'vwarranty_code'></span></li>
                        <li class = 'prod-content'><strong>Color/Variant: </strong><span class = 'info' id = 'vcolor'></span></li>
                        <li class = 'prod-content'><strong>Critical Amount: </strong><span class = 'info' id = 'vcritical_amt'></span></li>
                        <li class = 'prod-content'><strong>Re-order Point: </strong><span class = 'info' id = 'vrop'></span></li>
                        <li class = 'prod-content'><strong>Restock Style: </strong><span class = 'info' id = 'vro_style'></span></li>
                        <li class = 'prod-content'><strong>Additional Info: </strong><span class = 'info' id = 'vdescr'></span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="productCateg" class="modal">
        <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"> Add Product Type </div><div class="close-div"><a href="" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <div class="extra-details">
                    <div class="input-box">
                        <span class="label">Product Type</span>
                        <input type="text" id = "ptname" placeholder="Product type" required>
                    </div>
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate" class = "btn-cancel">Cancel</button>
                    <input type="submit" id = "categ-submit" value="Insert"/>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="supplier" class="modal">
        <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action'> Add </span> Supplier </div><div class="close-div"><a href="" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <input type = 'hidden' id = 'sid' value = ''>
                <div class="extra-details">
                    <div class="input-box">
                        <span class="label">Supplier Name</span>
                        <input type="text" id = "sname" placeholder="Supplier Name" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Address</span>
                        <textarea class = "desc" id = "sdescr" maxlength="250" placeholder="Supplier Address"></textarea>
                    </div>
                    <div class="input-box">
                        <span class="label">Contact No.</span>
                        <input type="text" id = "contact" maxlength = '11' onkeypress='return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))' placeholder="Contact No." required>
                    </div>
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate" class = "btn-cancel">Cancel</button>
                    <input type="submit" id = "supplier-submit" value="Insert"/>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="warranty" class="modal">
        <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action'> Add </span> Warranty Code </div><div class="close-div"><a href="" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <input type = 'hidden' id = 'id' value = ''>
                <div class="extra-details">
                    <div class="input-box">
                        <span class="label">Warranty Code</span>
                        <input type="text" id = "wcode" placeholder="Warranty Code" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Return/Replacement Coverage</span>
                        <div class="sideselect">
                            <input type="number" id = "dur1" maxlength = '3' onkeypress='return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))' placeholder = "0" style = 'width:50%' required>
                            <select id = 'tp_1'  style = 'width:50%'>
                                <option value = 'days'>days</option>
                                <option value = 'months'>months</option>
                                <option value = 'years'>years</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-box">
                        <span class="label">Store Warranty Coverage</span>
                        <div class="sideselect">
                            <input type="number" id = "dur2" maxlength = '3' onkeypress='return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))' placeholder = "0" style = 'width:50%' required>
                            <select id = 'tp_2'  style = 'width:50%'>
                                <option value = 'days'>days</option>
                                <option value = 'months'>months</option>
                                <option value = 'years'>years</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-box">
                        <span class="label">Supplier/Manufacturer Warranty Coverage</span>
                        <div class="sideselect">
                            <input type="number" id = "dur3" maxlength = '3' onkeypress='return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))'  placeholder = "0" style = 'width:50%' required>
                            <select id = 'tp_3'  style = 'width:50%'>
                                <option value = 'days'>days</option>
                                <option value = 'months'>months</option>
                                <option value = 'years'>years</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate" class = "btn-cancel">Cancel</button>
                    <input type="submit" id = "warranty-submit" value="Insert"/>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="delete" class="modal">
        <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action-delete'> Delete </span> Product </div><div class="close-div"><a href="#product" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <div class="extra-details">
                    Are you sure you want to delete the selected items?
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate" class = "btn-cancel">Cancel</button>
                    <input type="submit" id = "delete-confirm" value="Delete"/>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    categ();
    warranty();
    supplier();
    loadData();
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
    var f_pcode = 1;
    var f_name = 1;
    var f_type = 1;
    var f_avail = 1;
    var f_price = 1;
    $("#code-h").click(function(){
        f_pcode *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_pcode,n);
    });
    $("#name-h").click(function(){
        f_name *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_name,n);
    });
    $("#type-h").click(function(){
        f_type *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_type,n);
    });
    $("#available_qty-h").click(function(){
        f_avail *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_avail,n);
    });
    $("#price-h").click(function(){
        f_price *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_price,n);
    });
    
    function loadData(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/load_data.php",
            data: {
                'func':"product"
            },                             
            success: function(response){                    
                $("#table-data").html(response); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    } 
    function emptyProductForm(){
        $('#product_type').val('').change();
        $('#supplier_id').val('').change();
        $('#product_code').val('');
        $('#product_name').val('');
        $('#price').val('');
        $('#warranty_code').val('').change();
        $('#manufacturer').val('');
        $('#color').val('');
        $('#critical_amt').val('');
        $('#rop').val('');
        $('#ro_style').val('Safety').change();
        $('#descr').val('');
        $('#image').val('');
    }
    function emptySupplierForm(){
        $('#sname').val('');
        $('#sdescr').val('');
        $('#contact').val('');
    }
    function emptyWarrantyForm(){
        $('#wcode').val('');
        $('#dur1').val('');
        $('#dur2').val('');
        $('#dur3').val('');
    }
    function emptyCategoryForm(){
        $('#ptname').val();
    }
    function autoInput(){
        var id = $('.selectable:checked').val();         
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            data: {
                'func': "product",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#product_code').val(data.product_code);
                $('#product_name').val(data.product_name);
                $('#manufacturer').val(data.manufacturer);   
                $('#product_type').val(data.product_type).change();
                $('#color').val(data.color);
                $('#price').val(data.item_price);
                $('#critical_amt').val(data.critical_amt);
                $('#rop').val(data.rop_min);
                $('#ro_style').val(data.ro_categ).change();
                $('#warranty_code').val(data.warranty_code).change();
                $('#supplier_id').val(data.supplier_id).change();
                $('#descr').val(data.description);
            },
            error: function(){
                alert("ayaw"); //XD
                alert(data);
        }
        });
    }
    function view(id){
        var id = id;   
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            data: {
                'func': "product",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#fileimg').attr('src', data.product_img);
                $('#vproduct_code').html(data.product_code);
                $('#vproduct_name').html(data.product_name);
                $('#vmanufacturer').html(data.manufacturer);   
                $('#vproduct_type').html(data.product_type);
                $('#vcolor').html(data.color);
                $('#vprice').html(data.item_price);
                $('#vcritical_amt').html(data.critical_amt);
                $('#vrop').html(data.rop_min);
                $('#vro_style').html(data.ro_categ);
                $('#vwarranty_code').html(data.warranty_code);
                $('#vsupplier_id').html(data.supplier_id);
                $('#vdescr').html(data.description);

            },
            error: function(data){
                alert(ayaw);
            }
        });
    }
    $('#edit_btn').click(function(){
        $('#form-submit').val("Update");
        $('#action').text('Update');
        autoInput();
    });
    $('#add_btn').click(function(){
        $('#form-submit').val("Insert");
        $('#action').text('Add New');
    });
    $("#form-submit").click(function(){

        var fd = new FormData();
        var files = $('#image')[0].files;
        
        // Check file selected or not
        if(files.length > 0 ){
           fd.append('file',files[0]);
        }
        var valid = this.form.checkValidity();
        var product_code = $('#product_code').val();
        var product_name = $('#product_name').val();
        var manufacturer = $('#manufacturer').val();
        var product_type = $('#product_type').val();
        var color = $('#color').val();
        var item_price = $('#price').val();
        var critical = $('#critical_amt').val();
        var reorder = $('#rop').val();
        var ro_style = $('#ro_style').val();
        var supplier_id= $('#supplier_id').val();
        var desc = $('#descr').val();
        var wty = $('#warranty_code').val();

        fd.append('func',"product");
        fd.append('product_code',product_code);
        fd.append('product_name',product_name);
        fd.append('manufacturer',manufacturer);
        fd.append('product_type',product_type);
        fd.append('color',color);
        fd.append('item_price',item_price);
        fd.append('critical',critical);
        fd.append('reorder',reorder);
        fd.append('ro_categ',ro_style);
        fd.append('wty',wty);
        fd.append('supplier_id',supplier_id);
        fd.append('desc',desc);

        var input = $('#form-submit').val();
        if(input == 'Insert'){
                // validationnnnn
            $("#valid").html(valid);
            if (valid) {
                event.preventDefault(); 
                $.ajax({
                    method: "POST",
                    url: "includes/functions/add_function.php",
                    cache:false,
                    async: false,
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function(data) {
                        emptyProductForm();
                        $('#product').hide();
                        alert(data);
                        loadData();
                    },
                    error: function(){
                        alert(data);
                        alert("hagorn");
                    }
                });
            }
        }
        else{
            for (var value of fd.values()) {
                console.log(value);
                }
            // validationnnnn
            $("#valid").html(valid);
            if (valid) {
                event.preventDefault(); 
                $.ajax({
                    method: "POST",
                    url: "includes/functions/update_function.php",
                    cache:false,
                    async: false,
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function(data) {
                        emptyProductForm();
                        $('#product').hide();
                        alert(data);
                        loadData();
                        console.log(data);
                    },
                    error: function(){
                        alert(data);
                    }
                });
            }
        }
    });
    $('#sortable').on('click', '.btn_view', function(){
        var id = this.value;
        view(id);
        $('#view').css("display", "flex");
        $('#view').show();
    });
    $("#supplier-submit").click(function() {

        var valid = this.form.checkValidity();
        var name = $('#sname').val();
        var s_address = $('#sdescr').val();
        var contact_number = $('#contact').val();

        // validationnnnn
        $("#valid").html(valid);
        if (valid) {
        event.preventDefault(); 

            $.ajax({
                method: "POST",
                url: "includes/functions/add_function.php",
                cache:false,
                async: false,
                data: {
                    'func': "supplier",
                    'name':name,
                    's_address': s_address,
                    'contact_number': contact_number
            
                },
                success: function(data) {

                    emptySupplierForm();
                    
                    $('#supplier').hide();
                    alert(data);
                    loadData();
                    supplier();
                    console.log(data);
                },
                error: function(){
                    alert(data);
                    alert("hagorn");
                }
            });
        }
    });
    $("#warranty-submit").click(function() {

        var valid = this.form.checkValidity();
        var wcode = $('#wcode').val();
        var dur1 = $('#dur1').val();
        var tp1 = $('#tp_1').val();
        var dur2 = $('#dur2').val();
        var tp2 = $('#tp_2').val();
        var dur3 = $('#dur3').val();
        var tp3 = $('#tp_3').val();

        // validationnnnn
        $("#valid").html(valid);
        if (valid) {
            event.preventDefault(); 

            $.ajax({
                method: "POST",
                url: "includes/functions/add_function.php",
                cache:false,
                async: false,
                data: {
                    'func': "warranty",
                    'wcode':wcode,
                    'dur1': dur1,
                    'tp1': tp1,
                    'dur2': dur2,
                    'tp2': tp2,
                    'dur3': dur3,
                    'tp3': tp3,
            
                },
                success: function(data){
                    emptyWarrantyForm();
                    $('#warranty').hide();
                    alert(data);
                    loadData();
                    $('.warranty').remove();
                    warranty();
                    console.log(data);
                },
                error: function(){
                    alert(data);
                    alert("hagorn");
                }
            });
        }
    });
    $("#categ-submit").click(function() {
        
        var valid = this.form.checkValidity();
        var product_type = $('#ptname').val();

        // validationnnnn
        $("#valid").html(valid);
        if (valid) {
        event.preventDefault(); 

            $.ajax({
                method: "POST",
                url: "includes/functions/add_function.php",
                cache:false,
                async: false,
                data: {
                    'func': "categ",
                    'ptype':product_type,
            
                },
                success: function(data) {                     
                    emptyCategoryForm();
                    $('#productCateg').hide();
                    alert(data);
                    loadData();
                    $('.product_type').remove();
                    categ();
                    console.log(data);
                },
                error: function(){
                    alert(data);
                    alert("hagorn");
                }
            });
        }
    });
    $('#delete-confirm').click(function(){
        var id = [];
        $(".selectable:checked").each(function(){
            id.push($(this).val());
        });
        $.ajax({
            url: "includes/functions/delete_function.php",
            method: "POST",
            cache:false,
            data: {
                'func': "product",
                'deleteID' : id
            },
            async: false, 
            success: function(response){
                alert(response);
                loadData();
                $('#delete').hide();
            },
            error: function(){
                alert(id);
            }
        });
    });
});
</script>
<?php 
    include('includes/foot.php');
?>

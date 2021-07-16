<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
<main>
    <div class="main-containter">
        <div class="Returns">
            <div class="card">
            <form method="POST">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-truck"></span>
                        Returns
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addReturnsModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
                            <button href = "#editReturnsModal" class = "modalBtn btn-success" id = "edit_button"> Edit <span class="las la-edit"></span></button>
                            <button href = "#deleteReturnsModal" class = "modalBtn btn-danger"> Delete <span class="las la-trash"></span></button>
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
                                        <td>Return ID</td>
                                        <td>Transaction No</td>
                                        <td>Product Code</td>
                                        <td>Item Price</td>
                                        <td>Quantity</td>
                                        <td>Total Price</td>
                                        <td>Return Type</td>
                                        <td>Return Date</td>
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
    <div id = "addReturnsModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form method="post" action ="">
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "return_id">Return ID:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="a_return_id" name = "return_id" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "transaction_no">Transaction No.:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_transaction_no" name = "transaction_no" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="product_code">Product Code:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_product_code" name = "product_code" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "quantity">Quantity:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_quantity" name = "quantity" required> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "item_price">Item Price:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="a_item_price" name = "item_price" required> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "total_price">Total Price:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_total_price" name = "total_price" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "return_type">Return Type:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_return_type" nmae = "return_type" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "return_date">Return Date:</label>
                            </div>
                            <div class="input">
                            <input type="date" id="a_return_date" name="return_date" value = "<?php echo date("Y-m-d");?>">
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
    <div id = "editReturnsModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class = "modal-body">
                <form method= "POST">
                <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "return_id">Return ID:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="e_return_id" name = "return_id">
                            </div>
                        </div>
                <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "transaction_no">Transaction No.:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_transaction_no" name = "transaction_no">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for ="product_code">Product Code:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_product_code" name = "product_code">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "quantity">Quantity:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_quantity" name = "quantity"> 
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "item_price">Item Price:</label>
                        </div>                              
                        <div class="input">                               
                            <input type ="text" id="e_item_price" name = "item_price"> 
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "total_price">Total Price:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_total_price" name = "total_price">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "return_type">Return Type:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_return_type" nmae = "return_type">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "return_date">Return Date:</label>
                        </div>
                        <div class="input">
                        <input type="date" id="e_return_date" name="return_date" value = "<?php echo date("Y-m-d");?>">
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
    <div id = "deleteReturnsModal" class="modal fade">
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
            url: "php/functions/function_return.php",
            cache:false,
            async: false,
            data: {
                'func': "auto_input",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {

            
                $('#e_return_id').val(data.return_id);
                $('#e_transaction_no').val(data.transaction_no);
                $('#e_product_code').val(data.product_code);
                $('#e_quantity').val(data.quantity);
                $('#e_item_price').val(data.item_price);
                $('#e_total_price').val(data.total_price);
                $('#e_return_type').val(data.return_type);
                $('#e_return_date').val(data.return_date);
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
            url: "php/functions/function_return.php",
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

        $('#a_return_id').val();
        $('#a_transaction_no').val();
        $('#a_product_code').val();
        $('#a_quantity').val();
        $('#a_item_price').val();
        $('#a_total_price').val();
        $('#a_return_type').val();
        $('#a_return_date').val();


        $('#e_return_id').val();
        $('#e_transaction_no').val();
        $('#e_product_code').val();
        $('#e_quantity').val();
        $('#e_item_price').val();
        $('#e_total_price').val();
        $('#e_return_type').val();
        $('#e_return_date').val();

    }
    //insert into table without relaod/refresh page
    $("#insert").submit(function() {

        var return_id = $('#a_return_id').val();
        var transaction_no = $('#a_transaction_no').val();
        var product_code = $('#a_product_code').val();
        var quantity = $('#a_quantity').val();
        var item_price = $('#a_item_price').val();
        var total_price = $('#a_total_price').val();
        var return_type = $('#a_return_type').val();
        var return_date = $('#a_return_date').val();

        //alert(return_id);

        $.ajax({
            method: "POST",
            url: "php/functions/function_return.php",
            cache:false,
            async: false,
            data: {
                'func': "insert",
                'return_id':return_id,
                'transaction_no':transaction_no,
                'product_code':product_code,
                'quantity':quantity,
                'item_price':item_price,
                'total_price':total_price,
                'return_type':return_type,
                'return_date':return_date
        
            },
            success: function(data) {
                $('#addReturnsModal').hide();
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

        var return_id = $('#e_return_id').val();
        var transaction_no = $('#e_transaction_no').val();
        var product_code = $('#e_product_code').val();
        var quantity = $('#e_quantity').val();
        var item_price = $('#e_item_price').val();
        var total_price = $('#e_total_price').val();
        var return_type = $('#e_return_type').val();
        var return_date = $('#e_return_date').val();

        $.ajax({
            method: "POST",
            url: "php/functions/function_return.php",
            cache:false,
            async: false,
            data: {
                'func': "update",
                'return_id':return_id,
                'transaction_no':transaction_no,
                'product_code':product_code,
                'quantity':quantity,
                'item_price':item_price,
                'total_price':total_price,
                'return_type':return_type,
                'return_date':return_date
            },
            success: function(data) {
                $('#editReturnsModal').hide();
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
            url: "php/functions/function_return.php",
            method: "POST",
            cache:false,
            data: {
                'func': "delete",
                'deleteID' : id
            },
            async: false, 
            success: function(response){
                $('#deleteReturnsModal').hide();
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
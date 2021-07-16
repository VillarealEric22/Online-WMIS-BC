<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
<main>
    <div class="main-containter">
        <div class="Suppliers">
            <div class="card">
            <form method="POST">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-user-tie"></span>
                        Suppliers
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addSuppliersModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
                            <button href = "#editSuppliersModal" class = "modalBtn btn-success" id = "edit_button" > Edit <span class="las la-edit"></span></button>
                            <button href = "#deleteSuppliersModal" class = "modalBtn btn-danger"> Delete <span class="las la-trash"></span></button>
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
                                        <td>Supplier ID</td>
                                        <td>Supplier Name</td>
                                        <td>Supplier Address</td>
                                        <td>Contact Number</td>
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
    <div id = "addSuppliersModal" class="modal fade">
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
                            <label class = modal-form-label for = "supplier_id">Supplier ID:</label>
                        </div>
                        <div class="input">
                            <input type="text" id="a_supplier_id" name = "supplier_id" required>
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "supplier_name">Supplier Name:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="a_supplier_name" name = "supplier_name" required>
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for ="s_address">Address:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="a_s_address" name = "s_address" required>
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for ="contact_number">Contact Number:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="a_contact_number" name = "contact_number" required>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <button class ="btn-submit" type = "submit" value="Confirm" id="insert" name="insert">Confirm</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--add modal end-->
    <!--edit modal-->
    <div id = "editSuppliersModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class = "modal-body">
                <form action="" method= "POST">
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "supplier_id">Supplier ID:</label>
                        </div>
                        <div class="input">
                            <input type="text" id="e_supplier_id" name = "supplier_id">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "supplier_name">Supplier Name:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_supplier_name" name = "supplier_name">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for ="s_address">Address:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_s_address" name = "s_address">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for ="contact_number">Contact Number:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_contact_number" name = "contact_number">
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
    <div id = "deleteSuppliersModal" class="modal fade">
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
                    <button class ="btn-submit" type=submit value="Confirm" id="delete" name="delete">Confirm</button>
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
            url: "php/functions/function_supplier.php",
            cache:false,
            async: false,
            data: {
                'func': "auto_input",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#e_supplier_id').val(data.supplier_id);
                $('#e_supplier_name').val(data.supplier_name);
                $('#e_s_address').val(data.s_address);
                $('#e_contact_number').val(data.contact_number);
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
            url: "php/functions/function_supplier.php",
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

        $('#a_supplier_id').val();
        $('#a_supplier_name').val();
        $('#a_s_address').val();
        $('#a_contact_number').val();

        $('#e_supplier_id').val();
        $('#e_supplier_name').val();
        $('#e_s_address').val();
        $('#e_contact_number').val();
        
    }
    
    //insert into table without relaod/refresh page
    
    $("#insert").click(function(){
        
        var supplier_id = $('#a_supplier_id').val();
        var supplier_name = $('#a_supplier_name').val();
        var s_address = $('#a_s_address').val();
        var contact_number = $('#a_contact_number').val();
        
       
        $.ajax({
        method: "POST",
        url: "php/functions/function_supplier.php",
        cache:false,
        async: false,
        data: {
            'func': "insert",
            'supplier_id': supplier_id,
            'supplier_name': supplier_name,
            's_address': s_address,
            'contact_number': contact_number
    
        },
        success: function(data) {
            $('#addSuppliersModal').hide();
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

        var supplier_id = $('#e_supplier_id').val();
        var supplier_name = $('#e_supplier_name').val();
        var s_address = $('#e_s_address').val();
        var contact_number = $('#e_contact_number').val();

        alert(supplier_id);

        $.ajax({
            method: "POST",
            url: "php/functions/function_supplier.php",
            cache:false,
            async: false,
            data: {
                'func': "update",
                'supplier_id': supplier_id,
                'supplier_name': supplier_name,
                's_address': s_address,
                'contact_number': contact_number
            },
            success: function(data) {
                $('#editSuppliersModal').hide();
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
            url: "php/functions/function_supplier.php",
            method: "POST",
            cache:false,
            data: {
                'func': "delete",
                'deleteID' : id
            },
            async: false, 
            success: function(response){
                $('#deleteSuppliersModal').hide();
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
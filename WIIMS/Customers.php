<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
<main>
    <div class="main-containter">
        <div class="Customers">
            <div class="card">
            <form method="POST">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-users"></span>
                        Customers
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addCustomersModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
                            <button href = "#editCustomersModal"  class = "modalBtn btn-success" id = "edit_button"> Edit <span class="las la-edit"></span></button>
                            <button href = "#deleteCustomersModal" class = "modalBtn btn-danger"> Delete <span class="las la-trash"></span></button>
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
                                        <td>Customer ID</td>
                                        <td>First Name</td>
                                        <td>Last Name</td>
                                        <td>Address</td>
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
    <div id = "addCustomersModal" class="modal fade">
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
                                <label class = modal-form-label for = "customer_id">Customer ID:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="a_customer_id" name = "customer_id" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "firstname">Firstname:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_firstname" name = "firstname" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="lastname">Lastname:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_lastname" name = "lastname" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "c_address">Address:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_c_address" name = "c_address" required> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "contact_number">Contact Number:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="a_contact_number" name = "contact_number" required> 
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
    <div id = "editCustomersModal" class="modal fade">
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
                            <label class = modal-form-label for = "customer_id">Customer ID:</label>
                        </div>
                        <div class="input">
                            <input type="text" id="e_customer_id" name = "customer_id">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "firstname">Firstname:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_firstname" name = "firstname">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for ="lastname">Lastname:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_lastname" name = "lastname">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "c_address">Address:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="e_c_address" name = "c_address"> 
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "contact_number">Contact Number:</label>
                        </div>                              
                        <div class="input">                               
                            <input type ="text" id="e_contact_number" name = "contact_number"> 
                        </div>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <button class ="btn-submit" value="Confirm" id="update" name="update">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <!--edit modal end-->
    <!--delete modal-->
    <div id = "deleteCustomersModal" class="modal fade">
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
            url: "php/functions/function_customer.php",
            cache:false,
            async: false,
            data: {
                'func': "auto_input",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#e_customer_id').val(data.customer_id);
                $('#e_firstname').val(data.firstname);
                $('#e_lastname').val(data.lastname);
                $('#e_c_address').val(data.c_address);
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
            url: "php/functions/function_customer.php",
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

        $('#a_customer_id').val();
        $('#a_firstname').val();
        $('#a_lastname').val();
        $('#a_c_address').val();
        $('#a_contact_number').val();

        $('#e_customer_id').val();
        $('#e_firstname').val();
        $('#e_lastname').val();
        $('#e_c_address').val();
        $('#e_contact_number').val();

    }
    //insert into table without relaod/refresh page
    $("#insert").click(function() {
        var valid = this.form.checkValidity();
        var customer_id = $('#a_customer_id').val();
        var firstname = $('#a_firstname').val();
        var lastname = $('#a_lastname').val();
        var c_address = $('#a_c_address').val();
        var contact_number = $('#a_contact_number').val();
        //alert(customer_id);

        // validationnnnn
        $("#valid").html(valid);
        if (valid) {
        event.preventDefault(); 

        $.ajax({
            method: "POST",
            url: "php/functions/function_customer.php",
            cache:false,
            async: false,
            data: {
                'func': "insert",
                'customer_id': customer_id,
                'firstname': firstname,
                'lastname': lastname,
                'c_address': c_address,
                'contact_number': contact_number
        
            },
            success: function(data) {
                $('#addCustomersModal').hide();
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

        var customer_id = $('#e_customer_id').val();
        var firstname = $('#e_firstname').val();
        var lastname = $('#e_lastname').val();
        var c_address = $('#e_c_address').val();
        var contact_number = $('#e_contact_number').val();

        $.ajax({
            method: "POST",
            url: "php/functions/function_customer.php",
            cache:false,
            async: false,
            data: {
                'func': "update",
                'customer_id': customer_id,
                'firstname': firstname,
                'lastname': lastname,
                'c_address': c_address,
                'contact_number': contact_number
            },
            success: function(data) {
                $('#editCustomersModal').hide();
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
            url: "php/functions/function_customer.php",
            method: "POST",
            cache:false,
            data: {
                'func': "delete",
                'deleteID' : id
            },
            async: false, 
            success: function(response){
                $('#deleteCustomersModal').hide();
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
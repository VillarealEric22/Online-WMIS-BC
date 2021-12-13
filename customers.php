<?php
    include('includes/navs.php');
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>Customers</h2>
                <div class="crud-buttons">
                    <button href = "#customer" class = "btn modalbtn blue" id = "add_btn">Add</button>
                    <button href = "#customer" class = "btn modalbtn green" id = "edit_btn" disabled = "disabled">Edit</button>
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
                        <td id = 'id-h'>id</td>
                        <td id = 'name-h'>Customer Name</td>
                        <td id = 'address-h'>Address</td>
                        <td id = 'cinfo-h'>Contact Info</td>
                    </tr>
                </thead>
                <tbody id = 'table-data'>
                   
                </tbody>
            </table>
        </div>
        <div class="content-row bottom">
            <div class="table-pagination">
                <ul class = pagination>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="customer" class="modal">
        <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action'> Add </span> Customer </div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <div class="extra-details">
                    <input type = 'hidden' id = 'id' value = ''>
                    <div class="input-box">
                        <span class="label">Customer Name</span>
                        <input type="text" id = "name" placeholder="Customer Name" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Address</span>
                        <textarea class = "desc" id = "descr" maxlength="250" placeholder="Customer Address"></textarea>
                    </div>
                    <div class="input-box">
                        <span class="label">Contact No.</span>
                        <input type="text" id = "contact" maxlength = '11' onkeypress='return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))' placeholder="Contact No.">
                    </div>
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate" class = "btn-cancel">Cancel</button>
                    <input type="submit" id = "form-submit" value="Insert"/>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="delete" class="modal">
        <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action-delete'> Delete </span> Customer </div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <div class="extra-details">
                    Delete Selected Items?
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate" class = "btn-cancel">Cancel</button>
                    <input type="submit" id = "delete-confirm" value="Delete"/>
                </div>
            </form>
        </div>
</div>
<script>
    $(document).ready(function(){
        loadData();
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
        var f_id = 1;
        var f_name = 1;
        var f_address = 1;
        var f_cinfo = 1;
        $("#id-h").click(function(){
            f_id *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_id,n);
        });
        $("#name-h").click(function(){
            f_name *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_name,n);
        });
        $("#address-h").click(function(){
            f_address *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_address,n);
        });
        $("#cinfo-h").click(function(){
            f_cinfo *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_cinfo,n);
        });
    function loadData(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/load_data.php",
            data: {
                'func':"customer"
            },                             
            success: function(response){                    
                $("#table-data").html(response); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
    function emptyCustomerForm(){
        $('#name').val('');
        $('#descr').val('');
        $('#contact').val('');
    }
    function autoInput(){
            var id = $('.selectable:checked').val();
            $.ajax({
                method: "POST",
                url: "includes/functions/auto_inputs.php",
                cache:false,
                async: false,
                data: {
                    'func': "customer",
                    'edit_id':id
                },
                dataType:"json",
                success: function(data) {
                    $('#id').val(data.customer_id);
                    $('#name').val(data.c_name);
                    $('#descr').val(data.c_address);
                    $('#contact').val(data.contact_number);
                },
                error: function(data){
                    alert(data);
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
    $("#form-submit").click(function() {
            var valid = this.form.checkValidity();
            var name = $('#name').val();
            var c_address = $('#descr').val();
            var contact_number = $('#contact').val();
            var id = $('#id').val();
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
                        data: {
                            'func': "customer",
                            'name':name,
                            'c_address': c_address,
                            'contact_number': contact_number
                    
                        },
                        success: function(data) {
                            emptyCustomerForm();
                            $('#customer').hide();
                            alert(data);
                            loadData();
                            console.log(data);
                        },
                        error: function(){
                            alert(data);
                            alert("hagorn");
                        }
                    });
                }
            }
            else{
                // validationnnnn
                $("#valid").html(valid);
                if (valid) {
                event.preventDefault(); 

                    $.ajax({
                        method: "POST",
                        url: "includes/functions/update_function.php",
                        cache:false,
                        async: false,
                        data: {
                            'func': "customer",
                            'id':id,
                            'name':name,
                            'c_address': c_address,
                            'contact_number': contact_number
                    
                        },
                        success: function(data) {
                            emptyCustomerForm();
                            $('#customer').hide();
                            alert(data);
                            loadData();
                            console.log(data);
                        },
                        error: function(){
                            alert(data);
                            alert("hagorn");
                        }
                    });
                }
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
                    'func': "customer",
                    'deleteID' : id
                },
                async: false, 
                success: function(response){
                    $('#delete').hide();
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
    include('includes/foot.php');
?>

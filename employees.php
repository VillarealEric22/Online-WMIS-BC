<?php
    include('includes/navs.php');
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>Employees</h2>
                <div class="crud-buttons">
                    <button href = "#employee" class = "btn modalbtn blue" id = "add_btn">Add</button>
                    <button href = "#employee" class = "btn modalbtn green" id = "edit_btn" disabled = "disabled">Edit</button>
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
                        <td id = 'id-h'>ID No.</td>
                        <td id = 'lname-h'>Last Name</td>
                        <td id = 'fname-h'>First Name</td>
                        <td id = 'mi-h'>M.I</td>
                        <td id = 'gender-h'>Sex</td>
                        <td id = 'address-h'>Address</td>
                        <td id = 'cno-h'>Contact Info.</td>
                        <td id = 'date-h'>Date</td>
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
<div id="employee" class="modal">
        <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action'> Add </span> Employee </div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <div class="extra-details">
                    <input type = 'hidden' id = 'emp_id' value = '1'>
                    <div class="input-box">
                        <span class="label">First Name</span>
                        <input type="text" id = "fname" placeholder="First Name" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Last Name</span>
                        <input type="text" id = "lname" placeholder="Last Name" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Middle Name</span>
                        <input type="text" id = "mname" placeholder="Middle Name" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Address</span>
                        <textarea class = "desc" id = "descr" maxlength="250" placeholder="Address"></textarea>
                    </div>
                    <div class="input-box">
                        <span class="label">Contact No.</span>
                        <input type="text" id = "contact" maxlength="11" placeholder="Contact No." required>
                    </div>
                    <div class="input-box">
                        <span class="label">Sex</span>
                        <select id="sex" style = "width:100%">
                            <option value = 'Male'>Male</option>
                            <option value = 'Female'>Female</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="label">Birthday</span>
                        <input type="date" id = "transaction_date" placeholder="Birthday" required>
                    </div>
                </div>
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate" class = "btn-cancel">Cancel</button>
                    <input type="submit" id = "form-submit" value="Insert"/>
                </div>
            </form>
        
    </div>
</div>
<div id="delete" class="modal">
        <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action-delete'> Delete </span> Employee </div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
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
        var f_lname = 1;
        var f_fname = 1;
        var f_mi = 1;
        var f_gender = 1;
        var f_address = 1;
        var f_cno = 1;
        var f_date = 1;
        $("#id-h").click(function(){
            f_id *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_id,n);
        });
        $("#lname-h").click(function(){
            f_lname *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_lname,n);
        });
        $("#fname-h").click(function(){
            f_fname *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_fname,n);
        });
        $("#mi-h").click(function(){
            f_mi *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_mi,n);
        });
        $("#gender-h").click(function(){
            f_gender *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_gender,n);
        });
        $("#address-h").click(function(){
            f_address *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_address,n);
        });
        $("#cno-h").click(function(){
            f_cno *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_cno,n);
        });
        $("#date-h").click(function(){
            f_date *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_date,n);
        });
    function loadData(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/load_data.php",
            data: {
                'func':"employee"
            },                             
            success: function(response){                    
                $("#table-data").html(response); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
    function autoInput(){
        var id = $('.selectable:checked').val();
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            data: {
                'func': "employee",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#emp_id').val(data.employee_id);
                $('#lname').val(data.lastname);
                $('#fname').val(data.firstname);
                $('#mname').val(data.middlename);
                $('#descr').val(data.emp_address);
                $('#contact').val(data.contact_number);
                $('#sex').val(data.sex).change();
                $('#transaction_date').val(data.birthday);
            },
            error: function(data){
                alert(data);
            }
        });
    }
    function emptyEmployeeForm(){
        $('#fname').val('');
        $('#lname').val('');
        $('#mname').val('');
        $('#descr').val('');
        $('#contact').val('');
        $('#sex').val('Male').change();
    }
    $('#edit_btn').click(function(){
        $('#form-submit').val("Update");
        $('#action').text('Update');
        autoInput();
    });
    $('#add_btn').click(function(){
        emptyEmployeeForm();
        $('#form-submit').val("Insert");
        $('#action').text('Add New');
    });
    $("#form-submit").click(function() {
            var valid = this.form.checkValidity();
            var e_id = $('#emp_id').val();
            var e_ln= $('#lname').val();
            var e_fn= $('#fname').val();
            var e_mi= $('#mname').val();
            var e_add= $('#descr').val();
            var e_cnum= $('#contact').val();
            var e_sx= $('#sex').val();
            var e_bday= $('#transaction_date').val();
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
                            'func': "employee",

                            'e_ln':e_ln,
                            'e_fn':e_fn,
                            'e_mi':e_mi,
                            'e_add':e_add,
                            'e_cnum':e_cnum,
                            'e_sx':e_sx,
                            'e_bday':e_bday
                        },
                        success: function(data) {
                            alert(data);
                            $('#employee').hide();
                            emptyEmployeeForm();
                            date();
                            loadData();
                            console.log(data);
                        },
                        error: function(data){
                            alert(data);
                    }
                    });
                }
            }
            else{
                // validationnnnn
                $("#valid").html(valid);
                event.preventDefault(); 
                    if (valid) {
                    $.ajax({
                        method: "POST",
                        url: "includes/functions/update_function.php",
                        cache:false,
                        async: false,
                        data: {
                            'func': "employee",
                            'e_id':e_id,
                            'e_ln':e_ln,
                            'e_fn':e_fn,
                            'e_mi':e_mi,
                            'e_add':e_add,
                            'e_cnum':e_cnum,
                            'e_sx':e_sx,
                            'e_bday':e_bday
                        },
                        success: function(data) {
                            emptyEmployeeForm();
                            $('#employee').hide();
                            alert(data);
                            loadData();
                            console.log(data);
                        },
                        error: function(data){
                            alert(data);
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
                'func': "employee",
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

<?php
    include('includes/navs.php');
?>
<?php
    if ($_SESSION["userrole"] != "Admin") {
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

       die("Invalid access, you do not have permission to be in this page");
    }
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>Users</h2>
                <div class="crud-buttons">
                    <button href = "#user" class = "btn modalbtn blue" id = "add_btn">Add</button>
                    <button href = "#user" class = "btn modalbtn green" id = "edit_btn" disabled = "disabled">Edit</button>
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
                        <td id = 'id-h'>User ID</td>
                        <td id = 'un-h'>Username</td>
                        <td id = 'Urole-h'>User Role</td>
                        <td id = 'name-h'>Employee Name</td>       
                    </tr>
                </thead>
                <tbody id ="table-data">
                   
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
<div id="user" class="modal">
    <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action'> Add </span> User </div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <div class="extra-details">
                    <input type = 'hidden' id = 'uid' value = ''>
                    <div class="input-box">
                        <span class="label">Employee ID</span>
                        <select id="employee_id" class = "e_id" autocomplete="off" style = "width:100%">
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="label">Username</span>
                        <input type="text" id = "username" placeholder="Username" disable = "disabled" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Password</span>
                        <input type="password" id = "password" placeholder="Password" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Role</span>
                        <select id="role" class = "u_role" autocomplete="off" style = "width:100%"> 
                            <option value = 'Admin'> Admin </option>
                            <option value = 'Sales'> Sales </option>
                            <option value = 'Inventory_clerk'> Inventory Clerk </option>
                        </select>
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
        <div class="title-box"><div class="title"><span id = 'action-delete'> Delete </span> Supplier </div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
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
        var f_un = 1;
        var f_role = 1;
        var f_name = 1;
        $("#id-h").click(function(){
            f_id *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_id,n);
        });
        $("#un-h").click(function(){
            f_un *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_un,n);
        });
        $("#Urole-h").click(function(){
            f_role *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_role,n);
        });
        $("#name-h").click(function(){
            f_name *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_name,n);
        });
    emp();
    function loadData(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/load_data.php",
            data: {
                'func':"user"
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
                'func': "user",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#uid').val(data.user_id);
                $('#username').val(data.username);
                $('#password').val(data.password);
                $('#role').val(data.user_role).change();
                $('#employee_id').val(data.employee_id).change();
            },
            error: function(){
                alert("ayaw"); //XD
                alert(id);
            }
        });
    }
    function emptyUserForm(){
        $('#employee_id').val('').change();
        $('#username').val('');
        $('#password').val('');
        $('#role').val('Default').change();
    }
    $('#edit_btn').click(function(){
        emptyUserForm();
        $('#form-submit').val("Update");
        $('#action').text('Update');

        autoInput();
    });
    $('#add_btn').click(function(){
        emptyUserForm();
        $('#username').removeAttr('disabled');
        $('#form-submit').val("Insert");
        $('#action').text('Add New');
    });
    $("#form-submit").click(function(){
        var valid = this.form.checkValidity();
        var uid = $('#uid').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var user_role = $('#role').val();
        var employee_id = $('#employee_id').val();
        
        var input = $('#form-submit').val();
        if(input == 'Insert'){
            // validationnnnn
            $("#valid").html(valid);
            if (valid) {
                $.ajax({
                    method: "POST",
                    url: "includes/functions/add_function.php",
                    cache:false,
                    async: false,
                    data: {
                        'func': "user",
                        'username': username,
                        'password': password,
                        'user_role': user_role,
                        'employee_id': employee_id
                    },
                    success: function(data) {
                        emptyUserForm();
                        $('#user').hide();
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
            // validationnnnn
            $("#valid").html(valid);
            if (valid) {
                $.ajax({
                    method: "POST",
                    url: "includes/functions/update_function.php",
                    cache:false,
                    async: false,
                    data: {
                        'func': "user",
                        'uid':uid,
                        'username': username,
                        'password': password,
                        'user_role': user_role,
                        'employee_id': employee_id
                    },
                    success: function(data) {
                        emptyUserForm();
                        $('#user').hide();
                        alert(data);
                        loadData();
                    },
                    error: function(){
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
                    'func': "user",
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

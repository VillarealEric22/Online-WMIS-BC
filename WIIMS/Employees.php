<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
<main>

    <div class="main-containter">
        <div class="Users">
            <div class="card">
                <form method="POST" action="">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-user"></span>
                        <select name = "tableName" id="tbName" onchange="location.href=this.value">
                            <option value = "Employees.php">Employees</option>
                            <option value = "Users.php">Users</option>
                        </select>
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addEmpModal" id = "add_button" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
                            <button href = "#editEmpModal" id = "edit_button" class = "modalBtn btn-success" disabled = "disabled"> Edit <span class="las la-edit"></span></button>
                            <button href = "#deleteEmpModal" id = "delete_button" class = "modalBtn btn-danger" disabled = "disabled" > Delete <span class="las la-trash"></span></button>
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
                                        <td id ="e_id">Employee ID</td>
                                        <td id ="ln">Lastname</td>
                                        <td id ="fn">Firstname</td>
                                        <td id ="mi">M.I.</td>
                                        <td id ="sx">Sex</td>
                                        <td id ="addr">Address</td>
                                        <td id ="contact">Contact No.</td>
                                        <td id ="birthday">Birthday</td>
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
    <div id = "addEmpModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Employee</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">                       
                    <form id ="employeeAdd" method = "POST" action = "">
                        Employee Details
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addEmployeeID">Employee ID:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id = "a_employee_id" name = "employee_id" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label>Name:</label>
                            </div>
                            <div class="input">
                                <label>Last Name</label>
                                <input type ="text" id = "a_lastname" name = "lastname" required>
                            </div>
                            <div class="input">
                                <label> First Name</label>
                                <input type ="text" id = "a_firstname" name = "firstname" required>
                            </div>
                            <div class="input">
                                <label>M.I </label>
                                <input type ="text" id = "a_middlename" name = "middlename" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label> Address:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id = "a_emp_address" name = "emp_address" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label> Contact No.:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id = "a_contact_number" name = "contact_number" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "sex">Sex:</label>
                            </div>
                            <div class="input">
                            <Select name="sex" id="a_sex">
                                    <option value = "Male" > Male </option>
                                    <option value = "Female" > Female </option>
                                    <option value = "Transexual(Male)" > Transexual(Male) </option>
                                    <option value = "Transexual(Female)" > Transexual(Female) </option>
                            </Select>
                            </div>                           
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label>Birth Date:</label>
                            </div>
                            <div class="input">
                                <input type="date" id="a_birthday" name="birthday" value = "<?php echo date("Y-m-d");?>" required>
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
    <div id = "editEmpModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class = "modal-body">
                    <form id = "employeeUpdate" method = "POST" action = "">
                            Employee Details
                            <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addEmployeeID">Employee ID:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id = "e_employee_id" name = "employee_id" disabled = "disabled">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label>Name:</label>
                            </div>
                            <div class="input">
                                <label>Last Name</label>
                                <input type ="text" id = "e_lastname" name = "lastname">
                            </div>
                            <div class="input">
                                <label> First Name</label>
                                <input type ="text" id = "e_firstname" name = "firstname">
                            </div>
                            <div class="input">
                                <label>M.I </label>
                                <input type ="text" id = "e_middlename" name = "middlename">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label> Address:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id = "e_emp_address" name = "emp_address">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label> Contact No.:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id = "e_contact_number" name = "contact_number">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "sex">Sex:</label>
                            </div>
                            <div class="input">
                            <Select name="sex" id="e_sex">
                                    <option value = "Male" > Male </option>
                                    <option value = "Female" > Female </option>
                                    <option value = "Transexual(Male)" > Transexual(Male) </option>
                                    <option value = "Transexual(Female)" > Transexual(Female) </option>
                            </Select>
                            </div>                           
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label>Birth Date:</label>
                            </div>
                            <div class="input">
                                <input type="date" id="e_birthday" name="birthday" value = "<?php echo date("Y-m-d");?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-cancel" type="button">Cancel</button>
                        <button class ="btn-submit" value="Confirm" id ="update" name="update">Confirm</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--edit modal end-->
    <!--delete modal-->
    <div id = "deleteEmpModal" class="modal fade">
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
                    <button class ="btn-submit" name="delete" id="delete" value="confirm">Confirm</button>
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
        //important note: please put id on <td> on table header. User it as identifier for event/action
        //table sort by ascending/descending
        function sortTable(f,n){
            //codes below will sort the table
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
        //variables below is needed per table column
        var f_eid = 1;
        var f_ln = 1;
        var f_fn = 1;
        var f_mi = 1;
        var f_sx = 1;
        var f_addr = 1;
        var f_con = 1;
        var f_bday = 1;
        //codes below will sort the table upon clicking the header
        $("#e_id").click(function(){
            f_eid *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_eid,n);
        });
        $("#ln").click(function(){
            f_ln *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_ln,n);
        });
        $("#fn").click(function(){
            f_fn *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_fn,n);
        });
        $("#mi").click(function(){
            f_mi *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_mi,n);
        });
        $("#sx").click(function(){
            f_sx *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_sx,n);
        });
        $("#addr").click(function(){
            f_addr *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_addr,n);
        });
        $("#contact").click(function(){
            f_con *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_con,n);
        });
        $("#bday").click(function(){
            f_bday *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_bday,n);
        });
        //autofill edit inputs
        $("#edit_button").click(function() {
            var id = $('.selectable:checked').val();
            $.ajax({
                method: "POST",
                url: "php/functions/function_employee.php",
                cache:false,
                async: false,
                data: {
                    'func': "auto_input",
                    'edit_id':id
                },
                dataType:"json",
                success: function(data) {
                    $('#e_employee_id').val(data.employee_id);
                    $('#e_lastname').val(data.lastname);
                    $('#e_firstname').val(data.firstname);
                    $('#e_middlename').val(data.middlename);
                    $('#e_emp_address').val(data.emp_address);
                    $('#e_contact_number').val(data.contact_number);
                    $('#e_sex').val(data.sex);
                    $('#e_birthday').val(data.birthday);
                },
                error: function(){
                    alert("ayaw");
                    alert(id);
            }
            });
        });
        // fetch data from table without reload/refresh page
        loadData();
        function loadData(){
            $.ajax({    //create an ajax request to display.php
                type: "POST",
                url: "php/functions/function_employee.php",
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

            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

            $('#a_employee_id').val('');
            $('#a_lastname').val('');
            $('#a_firstname').val('');
            $('#a_middlename').val('');
            $('#a_emp_address').val('');
            $('#a_contact_number').val('');
            $('#a_sex').val("Male");
            $('#a_birthday').val(today);

            $('#e_employee_id').val('');
            $('#e_lastname').val('');
            $('#e_firstname').val('');
            $('#e_middlename').val('');
            $('#e_emp_address').val('');
            $('#e_contact_number').val('');
            $('#e_sex').val("Male");
            $('#e_birthday').val(today);
        }
        //insert into table without relaod/refresh page
        $("#insert").click(function() {
            var valid = this.form.checkValidity();
            var e_id= $('#a_employee_id').val();
            var e_ln= $('#a_lastname').val();
            var e_fn= $('#a_firstname').val();
            var e_mi= $('#a_middlename').val();
            var e_add= $('#a_emp_address').val();
            var e_cnum= $('#a_contact_number').val();
            var e_sx= $('#a_sex').val();
            var e_bday= $('#a_birthday').val();

            // validationnnnn
            $("#valid").html(valid);
            if (valid) {
            event.preventDefault(); 
        
            $.ajax({
                method: "POST",
                url: "php/functions/function_employee.php",
                cache:false,
                async: false,
                data: {
                    'func': "insert",
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
                    $('#addEmpModal').hide();
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
            var e_id= $('#e_employee_id').val();
            var e_ln= $('#e_lastname').val();
            var e_fn= $('#e_firstname').val();
            var e_mi= $('#e_middlename').val();
            var e_add= $('#e_emp_address').val();
            var e_cnum= $('#e_contact_number').val();
            var e_sx= $('#e_sex').val();
            var e_bday= $('#e_birthday').val();

            $.ajax({
                method: "POST",
                url: "php/functions/function_employee.php",
                cache:false,
                async: false,
                data: {
                    'func': "update",
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
                url: "php/functions/function_employee.php",
                method: "POST",
                cache:false,
                data: {
                    'func': "delete",
                    'deleteID' : id
                },
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
</main>
<?php
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>
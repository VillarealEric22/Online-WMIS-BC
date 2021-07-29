        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="copyright text-center">
                    <span>Copyright &copy; Baker's Craft 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
        </main>
        <!--modals-->
        <!--account modal-->
        <div id = "userModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">User Settings</h5>
                        <button class="close" type="button">
                            <span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-message">
                            <form>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "username">Username:</label>
                                    </div>
                                    <div class="input">
                                        <input type="text" id="e_username" name = "username">
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "employee_id">Employee ID:</label>
                                    </div>
                                    <div class="input">
                                        <input type="text" id="e_employee_id" name = "employee_id">
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "password">Password:</label>
                                    </div>
                                    <div class="input">
                                        <input type ="text" id="e_password" name = "password">
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "rpassword">Re-Type Password:</label>
                                    </div>
                                    <div class="input">
                                        <input type ="text" id="rpassword" name = "rpassword">
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "user_image">User Image:</label>
                                    </div>
                                    <div class="input">
                                        <input type = "file" name = "user_image" id = "user_image">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-cancel" type="button">Cancel</button>
                        <button class ="btn-submit" type ="submit" value="Confirm" id="update" name="update">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <!--account modal end-->
        <!--user modal-->
        <div id = "accountModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">User Settings</h5>
                        <button class="close" type="button">
                            <span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-message">
                            <form>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for ="empName">Fullname:</label>
                                    </div>
                                    <div class="input">
                                        <input type ="text" id="e_firstname" name = "firstname" class = short> <input type ="text" id="e_middlename" name = "middlename" class = shortest> <input type ="text" id="e_lastname" name = "lastname" class = short>
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "sex">Sex:</label>
                                    </div>
                                    <div class="input">
                                        <Select id="e_sex" name = "Sex">
                                            <option value = "Male" > Male </option>
                                            <option value = "Female" > Female </option>
                                        </Select>
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "birthday">Birthday:</label>
                                    </div>                              
                                    <div class="input">                               
                                        <input type ="text" id="e_birthday" name = "birthday"> 
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "email">Email:</label>
                                    </div>
                                    <div class="input">
                                        <input type ="text" id="e_email_address" name = "email">
                                    </div>
                                </div>
                                <div class="input-row">
                                    <div class="input-label">
                                        <label class = modal-form-label for = "contact_number">Contact No.:</label>
                                    </div>
                                    <div class="input">
                                        <input type ="text" id="e_contact_number" nmae = "contact_number">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-cancel" type="button">Cancel</button>
                        <button class ="btn-submit" type ="submit" value="Confirm" id="edit" name="edit">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <!--user modal end-->
            <!--logout modal-->
            <div id = "logoutModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ready to Leave?</h5>
                            <button class="close" type="button">
                                <span>×</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-message">
                                Select "Logout" below if you are ready to end your current session.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn-cancel" type="button">Cancel</button>
                            <a class="btn-confirm" href="logout.php"> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        <!--AJAX-->  
    <script>
    $(document).ready(function(){
        $("edit_button").click(function(){
            var id; //need muna makuha value ni session.
            $.ajax({
            method: "POST",
            url: "php/functions/function_Usetting.php",
            cache:false,
            async: false,
            data: {
                'func': "auto_input",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#e_username').val(data.username);
                $('#e_employee_id').val(data.employee_id);
            },
            error: function(){
                alert("ayaw"); //XD
                alert(id);
                }
            });
        });
    
    $("#account_edit").click(function() {
        var id;
        $.ajax({
            method: "POST",
            url: "php/functions/function_Asetting.php",
            cache:false,
            async: false,
            data: {
                'func': "auto_input",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
            $('#e_firstname').val(data.firstname);
            $('#e_lastname').val(data.lastname);
            $('#e_middlename').val(data.middlename);
            $('#e_sex').val(data.sex);
            $('#e_birthday').val(data.birthday);
            $('#e_email_address').val(data.email_address);
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

        $('#e_username').val();
        $('#e_employee_id').val();
        $('#e_password').val();
        
        $('#e_firstname').val();
        $('#e_lastname').val();
        $('#e_middlename').val();
        $('#e_sex').val();
        $('#e_birthday').val();
        $('#e_email_address').val();
        $('#e_contact_number').val();
    
    }

    $("#update").click(function() {
        event.preventDefault();

        var username = $('#e_username').val();
        var employee_id = $('#e_employee_id').val();
        var password = $('#e_password').val();

        $.ajax({
            method: "POST",
            url: "php/functions/function_Usetting.php",
            cache:false,
            async: false,
            data: {
                'func': "update",
                'username': username,
                'employee_id': employee_id,
                'password': password
            },
            success: function(data) {   
                $('#userModal').hide();
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
    $("#edit").click(function() {
        event.preventDefault();

        var firstname = $('#e_firstname').val();
        var lastname = $('#e_lastname').val();
        var middlename = $('#e_middlename').val();
        var sex = $('#e_sex').val();
        var birthday = $('#e_birthday').val();
        var email_address = $('#e_email_address').val();
        var contact_number = $('#e_contact_number').val();

        $.ajax({
            method: "POST",
            url: "php/functions/function_Asetting.php",
            cache:false,
            async: false,
            data: {
                'func': "update",
                'firstname': firstname,
                'lastname': lastname,
                'middlename': middlename,
                'sex': sex,
                'birthday': birthday,
                'email_address': email_address,
                'contact_number': contact_number
            },
            success: function(data) {
                $('#accountModal').hide();
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
});
</script>
        <!--logout modal end-->
        <!--End modals-->
</div>
</body>
</html>
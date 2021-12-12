        </div>
    </div>
<div id="acct" class="modal">
    <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action'> Update </span> Account </div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <div class="extra-details">
                    <input type = 'hidden' id = 'euid' value = ''>
                    <div class="input-box">
                        <span class="label">Username</span>
                        <input type="text" id = "eusername" placeholder="Username" disabled = "disabled" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Password</span>
                        <input type="password" id = "epassword" placeholder="Password" required>
                    </div>
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate" class = "btn-cancel">Cancel</button>
                    <input type="submit" id = "eform-submit" value="Update"/>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="useracct" class="modal">
        <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action'> Update </span> Employee Information </div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <div class="extra-details">
                    <input type = 'hidden' id = 'eemp_id' value = '1'>
                    <div class="input-box">
                        <span class="label">First Name</span>
                        <input type="text" id = "efname" placeholder="First Name" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Last Name</span>
                        <input type="text" id = "elname" placeholder="Last Name" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Middle Name</span>
                        <input type="text" id = "emname" placeholder="Middle Name" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Address</span>
                        <textarea class = "desc" id = "edescr" maxlength="250" placeholder="Address"></textarea>
                    </div>
                    <div class="input-box">
                        <span class="label">Contact No.</span>
                        <input type="text" id = "econtact" maxlength="11" placeholder="Contact No." required>
                    </div>
                    <div class="input-box">
                        <span class="label">Sex</span>
                        <select id="esex" style = "width:100%">
                            <option value = 'Male'>Male</option>
                            <option value = 'Female'>Female</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="label">Birthday</span>
                        <input type="date" id = "b_date" placeholder="Birthday" required>
                    </div>
                </div>
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate" class = "btn-cancel">Cancel</button>
                    <input type="submit" id = "fform-submit" value="Update"/>
                </div>
            </form>
    </div>
</div>

<script>
    $(document).on('click', '.userSetting', function(){
        $('#useracct').css("display", "flex");
        $('#useracct').show();
        user();
    });
    $(document).on('click', '.accountSetting', function(){
        $('#acct').css("display", "flex");
        $('#acct').show();
        acct();
    });
    function acct(){
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            data: {
                'func': "user1",
            },
            dataType:"json",
            success: function(data) {
                $('#euid').val(data.user_id);
                $('#eusername').val(data.username);
                $('#epassword').val(data.password);
            },
            error: function(){
                alert("ayaw"); //XD
                alert(id);
            }
        });
    }
    function user(){
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            data: {
                'func': "emp1",
            },
            dataType:"json",
            success: function(data) {
                $('#eemp_id').val(data.employee_id);
                $('#elname').val(data.lastname);
                $('#efname').val(data.firstname);
                $('#emname').val(data.middlename);
                $('#edescr').val(data.emp_address);
                $('#econtact').val(data.contact_number);
                $('#esex').val(data.sex).change();
                $('#b_date').val(data.birthday);
            },
            error: function(data){
                alert(data);
            }
        });
    }
    $("#eform-submit").click(function(){
        var valid = this.form.checkValidity();
        var uid = $('#euid').val();
        var username = $('#eusername').val();
        var password = $('#epassword').val();
        
        // validationnnnn
        $("#valid").html(valid);
        if (valid) {
            $.ajax({
                method: "POST",
                url: "includes/functions/update_function.php",
                cache:false,
                async: false,
                data: {
                    'func': "uacct",
                    'uid':uid,
                    'username': username,
                    'password': password,
                },
                success: function(data) {
                    $('#useracct').hide();
                    alert(data);
                },
                error: function(){
                    alert(data);
                }
            });
        } 
    });
    $("#fform-submit").click(function() {
            var valid = this.form.checkValidity();
            var e_id = $('#eemp_id').val();
            var e_ln= $('#elname').val();
            var e_fn= $('#efname').val();
            var e_mi= $('#emname').val();
            var e_add= $('#edescr').val();
            var e_cnum= $('#econtact').val();
            var e_sx= $('#esex').val();
            var e_bday= $('#b_date').val();

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
                        emptyForm();
                        $('#acct').hide();
                        alert(data);
                        console.log(data);
                    },
                    error: function(data){
                        alert(data);
                }
                });
            }
    function emptyForm(){
        $('#efname').val('');
        $('#elname').val('');
        $('#emname').val('');
        $('#edescr').val('');
        $('#econtact').val('');
        $('#esex').val('Male').change();
    }
    });
    </script>
    <script src = js/select_data.js></script>
	<script src = js/controls.js></script>
    <script src = js/auto_ids.js></script>
    <script src = js/calc.js></script>
</body>
</html>
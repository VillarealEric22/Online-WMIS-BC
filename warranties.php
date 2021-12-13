<?php
    include('includes/navs.php');
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>Warranties</h2>
                <div class="crud-buttons">
                    <button href = "#warranty" class = "btn modalbtn blue" id = "add_btn">Add</button>
                    <button href = "#warranty" class = "btn modalbtn green" id = "edit_btn" disabled = "disabled">Edit</button>
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
                        <td id = 'code-h'>Warranty Code</td>
                        <td id = 'name-h'># of products</td>
                        <td id = 'type-h'>Return / Replacement</td>                        
                        <td id = 'available_qty-h'>Warranty</td>
                        <td id = 'price-h'>Supplier Warranty</td>
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
        </div>
    </div>
</div>
<div id="view" class="modal">    
    <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action'> View </span>Warranty Code</div><div class="close-div"><a href="" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <li class = 'prod-content'><strong>Warranty Code: </strong>&nbsp;&nbsp;<span class = 'info' id = 'vwty_code'></span></li>
            <li class = 'prod-content'><strong>Replace / Refund: </strong>&nbsp;&nbsp;<span class = 'info' id = 'vrefund'></span></li>
            <li class = 'prod-content'><strong>Store Warranty: </strong>&nbsp;&nbsp;<span class = 'info' id = 'vwarranty'></span></li>
            <li class = 'prod-content'><strong>Manufacturer Warranty: </strong>&nbsp;&nbsp;<span class = 'info' id = 'vmfgr'></span></li>
            <table id ="sortable" class="modalTable" style = 'display:block; overflow-y:auto; max-height: 600px;'>
                <thead>
                    <tr>
                        <td style = 'font-weight:500;'>Product code</td>
                        <td style = 'font-weight:500;'>Product name</td>           
                    </tr>
                </thead>   
                <tbody id = "itemRows">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="warranty" class="modal">
        <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action_span'> Add </span> Warranty Code </div><div class="close-div"><a href="" class = "link-2 close"></a></button></div></div>
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
        var f_code = 1;
        var f_name = 1;
        var f_type = 1;
        var f_qty = 1;
        var f_price = 1;
        $("#code-h").click(function(){
            f_code *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_code,n);
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
            f_qty *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_qty,n);
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
                'func':"warranty"
            },                             
            success: function(response){                    
                $("#table-data").html(response); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
    function emptyWarrantyForm(){
        $('#id').val('');
        $('#wcode').val('');
        $('#dur1').val('');
        $('#dur2').val('');   
        $('#dur3').val('');
        $('#tp_1').val('');
        $('#tp_2').val('');   
        $('#tp_3').val('');
    }
    function autoInput(){
        var id = $('.selectable:checked').val();      
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            data: {
                'func': "wty",
                'id':id
            },
            dataType:"json",
            success: function(data) {
                $('#id').val(data.id);
                $('#wcode').val(data.warranty_code);
                $('#dur1').val(data.rep_dur);
                $('#dur2').val(data.s_warranty);   
                $('#dur3').val(data.sp_warranty);
                $('#tp_1').val(data.tp1);
                $('#tp_2').val(data.tp2);   
                $('#tp_3').val(data.tp3);
            },
            error: function(data){
                alert(data);
        }
        });
    }
     $('#edit_btn').click(function(){
        $('#warranty-submit').val("Update");
        $('#action_span').html('Update');
        autoInput();
    });
    $('#add_btn').click(function(){
        $('#warranty-submit').val("Insert");
        $('#action_span').html('Add New');
    });
    $("#warranty-submit").click(function(){

        var valid = this.form.checkValidity();
        var wcode = $('#wcode').val();
        var dur1 = $('#dur1').val();
        var tp1 = $('#tp_1').val();
        var dur2 = $('#dur2').val();
        var tp2 = $('#tp_2').val();
        var dur3 = $('#dur3').val();
        var tp3 = $('#tp_3').val();
        var id = $('#id').val();

        var input = $('#warranty-submit').val();

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
                        'func':"warranty",
                        'id':id,
                        'wcode':wcode,
                        'dur1': dur1,
                        'tp1': tp1,
                        'dur2': dur2,
                        'tp2': tp2,
                        'dur3': dur3,
                        'tp3': tp3
                    },
                    success: function(data) {
                        emptyWarrantyForm();
                        $('#warranty').hide();
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
                event.preventDefault(); 
                $.ajax({
                    method: "POST",
                    url: "includes/functions/update_function.php",
                    cache:false,
                    async: false,
                    data: {
                        'id':id,
                        'func': "warranty",
                        'wcode': wcode,
                        'dur1': dur1,
                        'tp1': tp1,
                        'dur2': dur2,
                        'tp2': tp2,
                        'dur3': dur3,
                        'tp3': tp3
            
                    },
                    success: function(data) {
                        emptyWarrantyForm();
                        $('#warranty').hide();
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
    function view(id){
        var id = id;
        $.ajax({
            method: "POST",
            url: "includes/functions/reportscript.php",
            cache:false,
            async: false,
            data: {
                'func': "wty_stats",
                'id':id
            },
		    success: function(response) {
                $("#itemRows").html(response);
                info(id);
            },
            error: function(response){
                alert(response);
            }
        });
    }
    function info(id){
        var id = id;
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            dataType:'JSON',
            data: {
                'func': "wty-1",
                'id':id
            },
            success: function(data) {
                $('#vwty_code').html(data.warranty_code);
                $('#vrefund').html(data.refund);
                $('#vwarranty').html(data.warranty);   
                $('#vmfgr').html(data.mfgr)();
            },
            error: function(data){
                alert(data);
            }
        });
    }
    $('#sortable').on('click', '.btn_view', function(){
        var id = this.value;
        view(id);
        $('#view').css("display", "flex");
        $('#view').show();
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
                'func': "warranty",
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

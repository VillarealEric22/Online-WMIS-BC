<?php
    include('includes/navs.php');
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>Categories</h2>
                <div class="crud-buttons">
                    <button href = "#productCateg" class = "btn modalbtn blue" id = "add_btn">Add</button>
                    <button href = "#productCateg" class = "btn modalbtn green" id = "edit_btn" disabled = "disabled">Edit</button>
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
                        <td id = 'code-h'>Product Type</td>
                        <td id = 'name-h'># of products</td>
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
        <div class="title-box"><div class="title"><span id = 'action'> View </span> Product Type</div><div class="close-div"><a href="" class = "link-2 close"></a></button></div></div>
        <div class="content">
        <li class = 'prod-content'><strong>Product Type: </strong>&nbsp;&nbsp;<span class = 'info' id = 'vptype'></span></li>
            <table id ="sortable" class="modalTable" width = "100%" style = 'display:block; overflow-y:auto; max-height: 600px;'>
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
<div id="productCateg" class="modal">
        <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action_span'>Add </span> Product Type </div><div class="close-div"><a href="" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <div class="extra-details">
                    <div class="input-box">
                        <input type = 'hidden' id = 'id' value = ''>
                        <span class="label">Product Type</span>
                        <input type="text" id = "ptname" placeholder="Product type" required>
                    </div>
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate" class = "btn-cancel">Cancel</button>
                    <input type="submit" id = "categ-submit" value="Insert"/>
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
</div></div>
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
        var f_code = 1;
        var f_name = 1;
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
        
    function loadData(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/load_data.php",
            data: {
                'func':"categ"
            },                             
            success: function(response){                    
                $("#table-data").html(response); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    } 
    function emptyCategoryForm(){
        $('#ptname').val();
    }
    function autoInput(){
        var id = $('.selectable:checked').val();      
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            data: {
                'func': "ptype-1",
                'id':id
            },
            dataType:"json",
            success: function(data) {
                $('#id').val(data.id);
                $('#ptname').val(data.product_type);
            },
            error: function(data){
                alert(data);
        }
        });
    }
    $('#edit_btn').click(function(){
        $('#categ-submit').val("Update");
        $('#action_span').text('Update');
        autoInput();
    });
    $('#add_btn').click(function(){
        $('#categ-submit').val("Insert");
        $('#action_span').text('Add New');
    });
    function view(id){
        var id = id;
        $.ajax({
            method: "POST",
            url: "includes/functions/reportscript.php",
            cache:false,
            async: false,
            data: {
                'func': "ptype_stats",
                'id':id
            },
            success: function(response) {
                $("#itemRows").html(response); 
                info(id);
            },
            error: function(data){
                alert(data);
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
                'func': "ptype-1",
                'id':id
            },
            success: function(data) {
                $('#vptype').html(data.product_type);
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
    $("#categ-submit").click(function() {
        
        var valid = this.form.checkValidity();
        var id = $('#id').val();
        var product_type = $('#ptname').val();
        var input = $('#categ-submit').val();

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
                            'func': "categ",
                            'id':id,
                            'ptype':product_type
                    
                        },
                        success: function(data) {                     
                            emptyCategoryForm();
                            $('#productCateg').hide();
                            alert(data);
                            loadData();
                            $('.product_type').remove();
                            categ();
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
                            'func': "categ",
                            'id':id,
                            'ptype':product_type,
                    
                        },
                        success: function(data) {                     
                            emptyCategoryForm();
                            $('#productCateg').hide();
                            alert(data);
                            loadData();
                            $('.product_type').remove();
                            categ();
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
                'func': "ptype",
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

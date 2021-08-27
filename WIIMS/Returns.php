<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
<main>
    <div class="main-containter">
        <div class="Returns">
            <div class="card">
            <form method="POST">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-truck"></span>
                        Returns
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addReturnsModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
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
                                        <td id = "r_id">Return ID</td>
                                        <td id = "t_no">Transaction No</td>
                                        <td id = "p_code">Product Name</td>
                                        <td id = "qty">Quantity</td>
                                        <td id = "item_p">Item Price</td>
                                        <td id = "total_p">Total Price</td>
                                        <td id = "r_type">Return Type</td>
                                        <td id = "r_date">Return Date</td>
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
    <div id = "addReturnsModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form method="post" action ="">
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "return_id">Return ID:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="a_return_id" name = "return_id" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "transaction_no">Transaction No.:</label>
                            </div>
                            <div class="input" id = "transactions">
                                <input type ="text" id="a_transaction_no" name = "transaction_no" required>
                                <div id="transactionList" class = "autoSuggest"></div>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="product_code">Product Code:</label>
                            </div>
                            <div class="input" id = "product">
                                <input type ="text" id="a_product_code" name = "product_code" required>
                                <div id="itemList" class = "autoSuggest"></div>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "quantity">Quantity:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_quantity" name = "quantity" required> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "item_price">Item Price:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="a_item_price" name = "item_price" required> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "total_price">Total Price:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_total_price" name = "total_price" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "return_type">Return Type:</label>
                            </div>
                            <div class="input">
                                <Select name="return_type" id="a_return_type">
                                    <option value = "Replacement" > Replacement </option>
                                    <option value = "Refund" > Refund </option>
                                </Select>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "return_date">Return Date:</label>
                            </div>
                            <div class="input">
                            <input type="date" id="a_return_date" name="return_date" value = "<?php echo date("Y-m-d");?>">
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
    <script>
    $(document).ready(function(){
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
                $("#sortable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
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
        var f_rid = 1;
        var f_tno = 1;
        var f_pcode = 1;
        var f_qty = 1;
        var f_itemp = 1;
        var f_totalp = 1;
        var f_rtype = 1;
        var f_rdate = 1;
        $("#r_id").click(function(){
            f_rid *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_rid,n);
        });
        $("#t_no").click(function(){
            f_tno *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_tno,n);
        });
        $("#p_code").click(function(){
            f_pcode *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_pcode,n);
        });
        $("#qty").click(function(){
            f_qty *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_qty,n);
        });
        $("#item_p").click(function(){
            f_itemp *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_itemp,n);
        });
        $("#total_p").click(function(){
            f_totalp *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_totalp,n);
        });
        $("#r_type").click(function(){
            f_rtype *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_rtype,n);
        });
        $("#r_date").click(function(){
            f_rdate *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_rdate,n);
        });
    // fetch data from table without reload/refresh page
    loadData();
    function loadData(){
        $.ajax({    //create an ajax request to display.php
            type: "POST",
            url: "php/functions/function_return.php",
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

        $('#a_return_id').val("");
        $('#a_transaction_no').val("");
        $('#a_product_code').val("");
        $('#a_quantity').val("");
        $('#a_item_price').val("");
        $('#a_total_price').val("");
        $('#a_return_type').val("");
        $('#a_return_date').val("");

    }
    $('#a_transaction_no').keyup(function(){
            var query = $(this).val();
            if(query != ''){
                $.ajax({
                    url: "php/functions/function_autocomplete_returns.php",
                    method: "POST",
                    data:{
                        query:query,
                        'func':"at_transact"
                    },
                    success:function(data){
                        $('#transactionList').fadeIn();  
                        $('#transactionList').html(data);  
                     }  
                });  
           }  
      });
      $("#transactions").on('click', 'li', function(){  
           $('#a_transaction_no').val($(this).text());
           $('#transactionList').fadeOut(); 
      });
    $('#a_product_code').keyup(function(){
            var query = $(this).val();
            var transaction_no = $('#a_transaction_no').val();
            if(query != ''){
                $.ajax({
                    url: "php/functions/function_autocomplete_returns.php",
                    method: "POST",
                    data:{
                        query:query,
                        'transaction_no':transaction_no,
                        'func':"at_pd"
                    },
                    success:function(data){
                        $('#itemList').fadeIn();  
                        $('#itemList').html(data);  
                     }  
                });  
           }  
      });
      $("#product").on('click', 'li', function(){  
           $('#a_product_code').val($(this).text());
           $('#itemList').fadeOut();
           var id = $('#a_product_code').val();
            $.ajax({
                url: "php/functions/function_autocomplete_returns.php",
                method: "POST",
                dataType:"json",
                data:{
                    'id':id,
                    'func':"autoprice"
                },
                success:function(data){
                    $('#a_item_price').val(data.item_price); 
                },
                error:function(data){
                }
            });
      });
    //insert into table without relaod/refresh page
    $("#insert").click(function() {

        var valid = this.form.checkValidity();
        var return_id = $('#a_return_id').val();
        var transaction_no = $('#a_transaction_no').val();
        var product_code = $('#a_product_code').val();
        var quantity = $('#a_quantity').val();
        var item_price = $('#a_item_price').val();
        var total_price = $('#a_total_price').val();
        var return_type = $('#a_return_type').val();
        var return_date = $('#a_return_date').val();

        // validationnnnn
        $("#valid").html(valid);
        if (valid) {
        event.preventDefault(); 

        $.ajax({
            method: "POST",
            url: "php/functions/function_return.php",
            cache:false,
            async: false,
            data: {
                'func': "insert",
                'return_id':return_id,
                'transaction_no':transaction_no,
                'product_code':product_code,
                'quantity':quantity,
                'item_price':item_price,
                'total_price':total_price,
                'return_type':return_type,
                'r_date':return_date
        
            },
            success: function(data) {
                $('#addReturnsModal').hide();
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
});
</script>
    <!--delete modal end-->
</main>
<?php 
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>
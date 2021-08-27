<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
<main>
    <div class="main-containter">
        <div class="sales">
            <div class="card">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-cash-register"></span>
                        <Select name="tableName" id="tbName" onchange="location.href=this.value">
                            <option value = "Orders.php"> Orders (Pending) </option>
                            <option value = "Orders-R.php"> Orders (Received) </option>
                        </Select>
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addOrdersModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
                            <button href = "#receiveOrdersModal" class = "modalBtn btn-danger" id="delete_button" disabled="disabled"> Received <span class="las la-check"></span></button>
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
                                        <td id = "o_id">Order ID</td>
                                        <td id = "s_id">Supplier Name</td>
                                        <td id = "totalItems">Items Total</td>
                                        <td id = "total">Total Price</td>
                                        <td id = "date">Transaction Date</td>
                                        <td id = "status">Status</td>
                                        <td></td>
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
            </div>  
        </div>
    </div>
    <!--add modal-->
    <div id = "addOrdersModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "transactionID">Purchase Order ID:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="a_purchase_order_No">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label>Supplier:</label>
                            </div>
                            <div class="input">
                                <input type ="text" list="d_supplier" id="a_supplier_id">
                                <?php
                                    //connection info.
                                    $DATABASE_HOST = 'localhost';
                                    $DATABASE_USER = 'root';
                                    $DATABASE_PASS = '';
                                    $DATABASE_NAME = 'db_inventory';
                                    //connect using data above.
                                    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
                                    if ( mysqli_connect_errno() ) {
                                        // If there is an error with the connection, stop the script and display the error.
                                        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
                                    }
                                    $sql = "SELECT supplier_id, supplier_name FROM supplier";
                                    $result = $con->query($sql) or die($con->error);
                                ?>
                                <datalist id="d_supplier">
                                    <?php
                                        while($rows= $result-> fetch_assoc())
                                        {
                                            echo "<option value='".$rows['supplier_id']."'>" .$rows['supplier_name']."</option>";
                                        }
                                        $con->close();
                                    ?>    
                                </datalist>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "items">Items:</label>
                            </div>
                            <div class="input">
                                <table id="prodCart" class="modalTable" width = "100%">
                                    <thead>
                                        <tr>
                                            <td>Product Code</td>
                                            <td>Qty</td>
                                            <td>Item Price</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input class ="medium-input" id = "a_product" type="string" disabled = "disabled" list = "productOptions"><datalist id="productOptions"></datalist></td>
                                            <td><input class ="small-input" id = "a_qty" type="number" min="1" disabled = "disabled"></td>
                                            <td><input class ="small-input" id = "a_iprice" type="number" min="1" disabled = "disabled"></td>
                                            <td><button class = "addItem" id = "addProd"><span class="las la-plus" disabled = "disabled"></span></button></td>
                                        </tr>     
                                    </tbody>
                                </table>
                            </div>
                        </div>                        
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "price">Price:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_Tprice" nmae = "price" disabled = "disabled">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "color">Transaction Date:</label>
                            </div>
                            <div class="input">
                                <input type="date" id="transactiondate" name="transactiondate">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <button class ="btn-submit" value="Confirm" id="insert" name="insert">Confirm</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--add modal end-->
    <!--view modal-->
    <div id = "viewSoldItem" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product Type</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="modal-message">
                        <table id="pdcsTable" class="modalTable" width = "100%">
                            <thead>
                                <tr>
                                    <td>Product Code</td>
                                    <td>Product Name</td>
                                    <td>Quantity </td>
                                    <td>Price</td>
                                </tr>
                            </thead>
                            <tbody class = "tbModal">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <button class ="btn-submit" value="Confirm" id="delete" name="delete">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <!--recieve order modal-->
    <div id = "receiveOrdersModal" class="modal fade">
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
                        Please confirm if orders are received. Once received, actions are irreversible
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <button class ="btn-submit" name="delete" id="receive" value="confirm">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</main>
    <script type="text/javascript">
       $(document).ready(function(){
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
                $("#sortable tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        //disable textboxes until  is selected
        $("#a_supplier_id").on("input",function() {
            if ($('#a_supplier_id').val().length === 0) {
                $('#a_product').attr('disabled', 'disabled');
                $('#a_iprice').attr('disabled', 'disabled');
                $('#a_qty').attr('disabled', 'disabled');
                $('#a_Tprice').attr('disabled', 'disabled');
                $('.product').remove();
                $('#a_product').val("");
                $('#a_iprice').val("");
                $('#a_qty').val("");
            }
            else {
                $('#a_product').removeAttr('disabled');
                $('#a_iprice').removeAttr('disabled');
                $('#a_qty').removeAttr('disabled');
                $('#a_Tprice').removeAttr('disabled');
            }
            //datalist for products
            var options = {};
                var supid = $("#a_supplier_id").val();
                options.url = "php/functions/function_orders.php",
                options.type = "POST",
                options.data = {
                    'func':'autosug',
                    'supid':supid
                },
                options.dataType = "json";
                options.success = function(data) {
                    $.each(data, function(){
                        var insert = "<option class = 'product' value='" + this.product_code + "'>'" + this.product_code + "'</option>";
                        $("#productOptions").append(insert);
                    })
                },
                options.error =  function(){
                    alert("error loading product list");
                };
                $.ajax(options);
        });
        
        $("#a_product").on('input', function () {
            var val = this.value;
            if($('#productOptions option').filter(function(){
                return this.value.toUpperCase() === val.toUpperCase();        
            }).length) {
                //send ajax request
                var id = $('#a_product').val();
                $.ajax({
                    url: "php/functions/function_autocomplete_product.php",
                    method: "POST",
                    dataType:"json",
                    data:{
                        'id':id,
                        'func':"autoprice"
                    },
                    success:function(data){
                        $('#a_iprice').val(data.item_price); 
                    },
                    error:function(data){
                    }
                });
            }
        });
        function emptyForm(){
            $('.arow').remove();
            $('#a_product').val("");
            $('#a_iprice').val("");
            $('#a_qty').val("");
            $('#a_purchase_order_No').val("");
            $('#a_supplier_id').val("");
            $('#a_Tprice').val("");
            $('#transactiondate').val("");
            $('.product').remove();
        }
        function totalPrice(){
            var qty;
            var price;
            var grandTotal = 0;
            $(".arow").each(function () {
               // get the values from this row:
                var $qty = $('.itemqty', this).val();
                var $price = $('.itemprice', this).val();
                var $total = ($qty * 1) * ($price * 1);
               // set total for the row

               grandTotal += $total;
           });
           $('#a_Tprice').val(grandTotal);
        }
        $('.close').click(function(){
            emptyForm();
        });
        $('.btn-cancel').click(function(){
            emptyForm();
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
        var f_oid = 1;
        var f_sid = 1;
        var f_price = 1;
        var f_date = 1;
        $("#o_id").click(function(){
            f_oid *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_oid,n);
        });
        $("#s_id").click(function(){
            f_sid *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_sid,n);
        });
        $("#total").click(function(){
            f_price *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_price,n);
        });
        $("#date").click(function(){
            f_date *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_date,n);
        });
        //add button click
        $("#addProd").click(function(e){
            e.preventDefault();
            var prod = $("#a_product").val();
            var qty = $("#a_qty").val();
            var item_price = $("#a_iprice").val();
            var insertRow= "<tr class = 'arow'><td class = 'item'>"+ prod +"</td><td><input class ='small-input itemqty' type='number' min='0' value = "+ qty +"></td><td><input class ='small-input itemprice' type='number' min='0' value = "+ item_price +"></td><td><button class = 'removeItem'><span class='las la-trash'></span></button></td></tr>";
            $("#prodCart tbody").append(insertRow);
            $("#a_product").val("");
            $("#a_qty").val("");
            $("#a_iprice").val("");
            totalPrice();
        });
        //remove button is clicked
        $("#prodCart").on('click', '.removeItem', function(e){
            e.preventDefault();
            $(this).parents("tr").remove(); //Remove field html
            totalPrice();
        });
        
    // fetch data from table without reload/refresh page
    loadData();
    function loadData(){
        $.ajax({    //create an ajax request to display.php
            type: "POST",
            url: "php/functions/function_orders.php",
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
    // view products
    $("#sortable").on("click",'.btn_view', function(e) {
        e.preventDefault();
        var id = $(this).val();    
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "php/functions/function_orders.php",
            cache:false,
            async: false,
            data: {
                'func': "view",
                'viewID':id
            },
            success: function(response) {
                $('#viewSoldItem').show();
                $(".tbModal").html(response);
                
            },
            error: function(){
                alert("ayaw");
            }
            
        });
        
    });
    //insert into table without relaod/refresh page
    $("#insert").click(function() {
        var transaction_no = $('#a_purchase_order_No').val();
        var cID = $('#a_supplier_id').val();
        var total_price= $('#a_Tprice').val();
        var tDate = $('#transactiondate').val();
        var product_code = [];
        var quantity = [];
        var price = [];
        var arrtNo = [];
        $("tr").find(".item").each(function(){
            product_code.push($(this).text());
        });
        $(".itemqty").each(function(){
            quantity.push($(this).val());
            arrtNo.push(transaction_no);
        });
        $(".itemprice").each(function(){
            price.push($(this).val());
        });
        alert(arrtNo);
        $.ajax({
            method: "POST",
            url: "php/functions/function_orders.php",
            cache:false,
            async: false,
            data: {
                'func': "insert",
                'purchase_order_id': transaction_no,
                'supplier_ID': cID,
                'total_price': total_price,
                'order_date': tDate,
                'product_code': product_code,
                'quantity': quantity,
                'price_ea': price,
                'tNumber': arrtNo
            },
            success: function(data) {
                $('#addOrdersModal').hide();
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
    $('#receive').click(function(){
        var id = [];
        $(".selectable:checked").each(function(){
            id.push($(this).val());
        });
        alert(id);
        $.ajax({
            url: "php/functions/function_orders.php",
            method: "POST",
            cache:false,
            data: {
                'func': "receive",
                'orderID' : id
            },
            async: false, 
            success: function(response){
                $('#receiveOrdersModal').hide();
                alert(response);
                loadData();
            },
            error: function(){
                alert("error");
            }
        });
    });
});
    </script>
<?php 
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>
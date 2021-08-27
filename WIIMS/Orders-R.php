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
                            <option value = "Orders-R.php"> Orders (Received) </option>
                            <option value = "Orders.php"> Orders (Pending) </option>
                        </Select>
                    </h2>
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
        
    // fetch data from table without reload/refresh page
    loadData();
    function loadData(){
        $.ajax({    //create an ajax request to display.php
            type: "POST",
            url: "php/functions/function_orders.php",
            data: {
                'func':"disp1"
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
});
    </script>
<?php 
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>
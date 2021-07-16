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
                        Sales
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addSalesModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
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
                                <label> Search: <input type="search" placeholder=""/></label> 
                            </div>
                        </div>
                        <div class="row">
                            <table id="sortable" class="table" width = "100%">
                                <thead>
                                    <tr>
                                        <td>Transaction ID</td>
                                        <td>Customer ID</td>
                                        <td>Product Code</td>
                                        <td>Item Price</td>
                                        <td>Quantity</td>
                                        <td>Total Price</td>
                                        <td>Transaction Date</td>
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
    <div id = "addSalesModal" class="modal fade">
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
                                <label class = modal-form-label for = "transactionID">Transaction ID:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="a_transaction_No">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label>Customer:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="a_customer_id" >
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
                                            <td><input class ="medium-input" id = "a_product" type="string"></td>
                                            <td><input class ="small-input" id = "a_qty" type="number" min="0"></td>
                                            <td><input class ="small-input" id = "a_iprice" type="number" min="0"></td>
                                            <td><button class = "addItem" id = "addProd"><span class="las la-plus"></span></button></td>
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
                                <input type ="text" id="a_Tprice" nmae = "price">
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
</main>
    <script type="text/javascript">
       $(document).ready(function(){
        //add button click
        $("#addProd").click(function(e){
            e.preventDefault();
            var prod = $("#a_product").val();
            var qty = $("#a_qty").val();
            var item_price = $("#a_iprice").val();
            var insertRow= "<tr><td class = 'item'>"+ prod +"</td><td><input class ='small-input itemqty' type='number' min='0' value = "+ qty +"></td><td><input class ='small-input itemprice' type='number' min='0' value = "+ item_price +"></td><td><button class = 'removeItem'><span class='las la-trash'></span></button></td></tr>";
            $("#prodCart tbody").append(insertRow);
            $("#a_product").val("");
            $("#a_qty").val("");
            $("#a_iprice").val("");
        });
        //remove button is clicked
        $("#prodCart").on('click', '.removeItem', function(e){
            e.preventDefault();
            $(this).parents("tr").remove(); //Remove field html
        });
    });
    $(document).ready(function(){
    // fetch data from table without reload/refresh page
    loadData();
    function loadData(){
        $.ajax({    //create an ajax request to display.php
            type: "POST",
            url: "php/functions/function_sales.php",
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
        alert("empty");
    }
    // view products
    $("#sortable").on("click",'.btn_view', function(e) {
        e.preventDefault();
        var id = $(this).val();    
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "php/functions/function_sales.php",
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
        var transaction_no = $('#a_transaction_No').val();
        var cID = $('#a_customer_id').val();
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
            url: "php/functions/function_sales.php",
            cache:false,
            async: false,
            data: {
                'func': "insert",
                'transaction_no': transaction_no,
                'customer_ID': cID,
                'total_price': total_price,
                'transaction_date': tDate,
                'product_code': product_code,
                'quantity': quantity,
                'item_price': price,
                'tNumber': arrtNo
            },
            success: function(data) {
                $('#addSalesModal').hide();
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
<?php 
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>
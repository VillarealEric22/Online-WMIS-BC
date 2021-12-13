<?php
    include('includes/navs.php');
?>
<div class = "transaction-split">
    <div class="input-container">
        <div class="title-box"><div class="title">Add New Sale</div></div>
        <div class="content">
            <form action="#">
                <div class="extra-details">
                <input type="hidden" value="0" id="counter">
                    <div class="input-box">
                        <span class="label">Customer</span>
                        <select id="customer_id" autocomplete="off" style = "width:100%" required>
                            <option></option>
                        </select>
                        <button formnovalidate="formnovalidate" class = "modalbtn" href="#customer" style="width:100%;">Add New</button>
                    </div>
                    <div class="selection-details">
                        <div>Address: <span id = "c_add"></span></div>
                        <div>Contact: <span id = "c_cont"> </span></div>
                    </div>
                </div>
                <div class="input-details">
                    <div class="input-box">
                        <span class="label">OR Number</span>
                        <input type="text" id = 'transaction_no' placeholder="OR Number" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Transaction Date</span>
                        <input type="date" id = 'transaction_date' required>
                    </div>
                </div>
                <div class="input-tb" id="tb-input">
                    <table id="prodCart" class="modalTable" width = "100%">
                        <thead>
                            <tr>
                                <td>Qty</td>
                                <td>Item Price</td>
                                <td>Amount</td>
                                <td>Action</td>             
                            </tr>
                        </thead>   
                        <tbody id = "itemRows">
                            
                        </tbody>
                    </table>
                </div>
                <div class="extra-details">
                    <div class="input-box">
                        <span class="label">Grand Total</span>
                        Php <input type = 'hidden' id = 'gTotal' value ='0'><span class="grand-total" id = "grandTotal">0.00</span>
                    </div>
                    <div class="input-box">
                        <span class="label">Remarks</span>
                        <textarea class = "desc" maxlength="250" placeholder="Extra Details here" id = 'remark'></textarea>
                    </div>
                </div>
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate"><a href = 'sales.php'>Cancel</a></button>
                    <input type="submit" id='form-submit' value="Confirm">
                </div>
            </form>
        
    </div>
    <div class = "table-view">
        <div class="function-row">
            <div class="content-row">
                <div class="table-length">
                    <Select name="tableCatSearch" id="product_type-s" placeholder = "Select Category">
                        <option value = "" >All</option>
                    </Select>
                    <input type="search" placeholder="Search Product Code" id = "searchInput"></label> 
                </div>
            </div>
        </div>
        <div class="content-row">
            <table id ="sortable">
                <thead>
                    <tr>
                        <td>Image</td>
                        <td>Code</td>
                        <td>Name</td>
                        <td>Category</td>
                        <td>Qty. Available</td>
                        <td>Price</td>
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
            <div class="table-info">
            </div>
        </div>
    </div>
</div>
</div>
<div id="customer" class="modal">
        <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action'> Add </span> Customer </div><div class="close-div"><a href="#product" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <input type = 'hidden' id = 'id' value = ''>
                <div class="extra-details">
                    <div class="input-box">
                        <span class="label">Customer Name</span>
                        <input type="text" id = "cname" placeholder="Customer Name" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Address</span>
                        <textarea class = "desc" id = "descr-c" maxlength="250" placeholder="Supplier Address"></textarea>
                    </div>
                    <div class="input-box">
                        <span class="label">Contact No.</span>
                        <input type="text" id = "contact" maxlength = '11' onkeypress='return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))' placeholder="Contact No.">
                    </div>
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate" class = "btn-cancel">Cancel</button>
                    <input type="submit" id = "customer-submit" value="Insert"/>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    
$(document).ready(function(){
    product();
    id_sales();
    customer();
    loadData();
    categ2();
    function loadData(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/load_data.php",
            data: {
                'func':"product-pos"
            },                             
            success: function(response){                    
                $("#table-data").html(response); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
    //here
    function emptySalesForm(){
        $('#customer_id').val('').change();
        $('#transaction_no').val('');
        $('#gTotal').val('');
        $('#remark').val('');
        $('#c_add').html('');
        $('#c_cont').html('');
        id_sales();
    }
    function emptyCustomerForm(){
        $('#cname').val('');
        $('#descr-c').val('');
        $('#contact').val('');
    }
    function clearTb(){
        $('.pdIn').each(function(){
            var pid = $(this).attr('id');
            var arr = pid.split('-');
            var id = arr[1];
            $('#p'+ pid).remove();
            $('#w'+ pid).remove();
            $('#r'+ pid).remove();
            $('#row-' + id).remove();
            $('#counter').val('0');
            grandTotal();
        });
    }
    $("#customer_id").on('select2:select', function () {
            var val = this.value;
            if($('#customer_id option').filter(function(){
                return this.value.toUpperCase() === val.toUpperCase();        
            }).length) {
            $.ajax({
                method: "POST",
                url: "includes/functions/auto_inputs.php",
                cache:false,
                async: false,
                data: {
                    'func': "customer-data",
                    'customer_id':val
                },
                dataType:"json",
                success: function(data) {
                    $('#c_add').text(data.c_address);
                    $('#c_cont').text(data.contact_number);
                },
                error: function(data){
                    alert(data);
                }
            });
        }
    });
    $(document).on('select2:select', '.sel-warehouse_code', function (){
        var wh = this.value;    

        var cval = $(this).attr('id');
        var arr = cval.split('_');
        cval = arr[1];

        var val =  $("#sel-product_code_"+cval).val();
        if($('.sel-product_code option').filter(function(){
            return this.value.toUpperCase() === val.toUpperCase();        
        }).length) {
            $.ajax({
                method: "POST",
                url: "includes/functions/auto_inputs.php",
                cache:false,
                async: false,
                data: {
                    'func': "set_max",
                    'id':val,
                    'wh':wh
                },
                dataType:"json",
                success: function(data) {
                    $('#alert-'+cval).val(data.quantity);
                    $('#amount_'+cval).attr({"max" : data.quantity});
                    $('#amount_'+cval).val('1');
                    rowTotal(cval);
                    grandTotal();
                },
                error: function(data){
                    alert(data);
                }
            });
        }
    });
    $("#form-submit").click(function() {
        var valid = this.form.checkValidity();
        var transaction_no = $('#transaction_no').val();
        var cID = $('#customer_id').val();
        var total_price= $('#gTotal').val();
        var tDate = $('#transaction_date').val();
        var remarks = $('.desc').val();
        var product_code = [];
        var quantity = [];
        var price = [];
        var totprice = [];
        var arrtNo = [];
        var arrtWh = [];

        $(".row-total").each(function(){
            totprice.push($(this).val());
        });
        $(".sel-product_code").each(function(){
            product_code.push($(this).val());
        });
        $(".qty").each(function(){
            quantity.push($(this).val());
            arrtNo.push(transaction_no);
        });
        $(".price_ea").each(function(){
            price.push($(this).val());
        });
        $(".sel-warehouse_code").each(function(){
            arrtWh.push($(this).val());
        });
        var itemsTotal = 0;
            for (var i = 0; i < quantity.length; i++) {
                itemsTotal +=
                 quantity[i] << 0;
            }
        $("#valid").html(valid);
        if (valid) {
            $.ajax({
                method: "POST",
                url: "includes/functions/add_function.php",
                cache:false,
                async: false,
                data: {
                    'func': "sales",
                    'transaction_no': transaction_no,
                    'customer_ID': cID,
                    'total_price': total_price,
                    'transaction_date': tDate,
                    'product_code': product_code,
                    'quantity': quantity,
                    'item_price': price,
                    'itemsTotal':itemsTotal,
                    'tNumber': arrtNo,
                    'wh_code':arrtWh,
                    'totprice':totprice,
                    'remarks':remarks
                },
                success: function(data) {
                    
                    emptySalesForm();
                    alert(data);
                    loadData();
                    clearTb();
                },
                error: function(){
                    alert(data);
                    alert("error");
                }
            });
        }
    });
    $("#customer-submit").click(function() {

        var valid = this.form.checkValidity();
        var name = $('#cname').val();
        var c_address = $('#descr-c').val();
        var contact_number = $('#contact').val();
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
                    'func': "customer",
                    'name':name,
                    'c_address': c_address,
                    'contact_number': contact_number
            
                },
                success: function(data) {
                    emptyCustomerForm();
                    $('#customer').hide();
                    $('.customer').remove();
                    customer();
                    alert(data);
                    loadData();
                    console.log(data);
                },
                error: function(){
                    alert(data);
                    alert("hagorn");
                }
            });
        }
    });
});
</script>
<?php 
    include('includes/foot.php');
?>

<?php
    include('includes/navs.php');
?>
<div class = "transaction-single">
    <div class="input-container">
        <div class="title-box"><div class="title">Returns (Customer)</div></div>
        <div class="content">
            <form action="#">
                <input type = 'hidden' value ='0' id = 'counter'>
                <div class="extra-details">
                    <div class="input-box">
                        <span class="label">OR Number</span>
                        <select id="transaction_id" autocomplete="off" style ="width:100%" required>
                            <option></option>
                        </select>
                    </div>
                    <div class="selection-details">
                        <span class = "label">Customer Details</span>
                        <div class="selection-details">
                            <div>Name: <span id = "c_name"></span></div>
                            <div>Address: <span id = "c_add"></span></div>
                            <div>Contact: <span id = "c_cont"></span></div>
                        </div>
                    </div>
                </div>
                <div class="input-details">
                    <div class="input-box">
                        <span class="label">Return Reference #</span>
                        <input type="text" placeholder="Return reference #" value ='1' id = 'return_id' required>
                    </div>
                    <div class="input-box">
                        <span class="label">Date</span>
                        <input type="date" id = 'transaction_date' required>
                    </div>
                </div>
                <div class="input-tb">
                    <table id="prodCart" class="modalTable" width = "100%">
                        <thead>
                            <tr>
                                <td>Qty</td>
                                <td>Item Price</td>
                                <td>Amount</td>
                                <td>Action</td>             
                            </tr>
                        </thead>   
                        <tbody id = 'itemRows'>
                            
                        </tbody>
                    </table>
                </div>
                <div class="extra-details">
                    <div class="input-box">
                        <span class="label">Total Value</span>
                        Php <input type = 'hidden' id = 'gTotal' value ='0'><span class="grand-total" id = "grandTotal">0.00</span>
                    </div>
                    <div class="input-box">
                        <span class="label">Warehouse</span>
                        <select id="warehouse_code" autocomplete="off" style = "width:100%" required>
                            <option></option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="label">Remarks</span>
                        <textarea class = "desc" id = 'descr' maxlength="250" placeholder="Extra Details here"></textarea>
                    </div>
                </div>
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate"><a href = 'returns.php'>Cancel</a></button>
                    <input type="submit" id = 'form-submit' value="Confirm">
                </div>
            </form>
        </div>
    </div>
<script>
$(document).ready(function(){
    id_return();
    returnOR();
    warehouseCode2();
    var cvalue = $('#counter').val();

    $('#transaction_id').on("select2:select", function(){
        autoCustomer();
        clearTb();
        var val = this.value;
        if($('#transaction_id option').filter(function(){
            return this.value.toUpperCase() === val.toUpperCase();        
        }).length) {
            $.ajax({
                method: "POST",
                url: "includes/functions/auto_inputs.php",
                cache: false,
                async: false,
                data: {
                    'func': "return",
                    't_id': val
                },
                dataType:"json",
                success: function(data) {
                    $.each(data, function(cvalue){

                        var dat = "<tr id='ppid-"+cvalue+"'><td class = 'table-input' colspan='4'><select id = 'sel-product-code_"+cvalue+"' class='sel-product_code' autocomplete='off' style = 'width:100%' disabled = 'disabled'><option value = '"+this.product_code+"'>"+this.product_code+"</option></select></td></tr><tr id='wpid-"+cvalue+"'><td class = 'table-input' colspan='4'><select id = 'ret-"+cvalue+"' class='return_type' autocomplete='off' style = 'width:100%'><option value = 'Refund'>Refund</option><option value = 'Warranty'>For Warranty</option><option value = 'Replacement'>Replacement</option></select></td></tr><tr id ='row-"+cvalue+"'><td class = 'table-input'><input type='number' min ='0' placeholder ='0' value = '1' max = '"+this.quantity+"' id='amount_"+cvalue+"' class = 'qty' required></td><td class = 'table-input'><input type='number' min ='0' placeholder = '0' id='price_"+cvalue+"' class = 'price_ea' value = '"+this.price_ea+"' disabled = 'disbaled' required></td><td class = 'table-input'><input type = 'hidden' class = 'pdIn' id='pid-"+cvalue+"'><p>Php<input type = 'hidden' id = 'rowTot"+cvalue+"' class = 'row-total' value = '"+this.price_tot+"'><span id = 'rowTotal-"+cvalue+"' class = 'rowTotal'>"+this.price_tot+"</span></td><td class = 'table-input'><button formnovalidate='formnovalidate' class = 'removeItem'>remove</button></td></tr>";

                        cvalue+1;
                        $('#itemRows').append(dat);
                        rowTotal(cvalue);
                        
                    });
                    grandTotal();
                    
                    $(".sel-product_code").each(function() {
                        initializeSelect2($(this));
                    });
                    $(".return_type").each(function() {
                        initializeSelect2Ret($(this));
                    });
                    checkValid();
                },
                error: function(data){
                    alert(data);
                }
            });
        }
    });

    function emptyReturnForm(){
        $('#transaction_id').val('').change();
        $('#return_id').val('');
        $('#gTotal').val('');
        $('#warehouse_code').val('').change();
        $('#descr').val('');
        $('#c_name').html('');
        $('#c_add').html('');
        $('#c_cont').html('');
        id_return();
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
    function checkValid(){
        $('.pdIn').each(function(){
            var pid = $(this).attr('id');
            var arr = pid.split('-');
            var id = arr[1];
            var pcode = $('#sel-product-code_'+id).val();
            var t_no = $("#transaction_id").val();
            $.ajax({
                method: "POST",
                url: "includes/functions/load_data.php",
                cache: false,
                async: false,
                data: {
                    'func': "check_validity",
                    'pcode':pcode,
                    't_no':t_no
                },
                dataType:"json",
                success: function(data) {
                    if(data == "invalid"){

                        $('#p'+ pid).remove();
                        $('#w'+ pid).remove();
                        $('#r'+ pid).remove();
                        $('#row-' + id).remove();
                        
                        alert("an item in order is past its warranty coverage, item is removed from table");
                        return false;
                    }
                    else if(data == "wty_only"){
                        $(""+'#ret-'+id+" option[value='Refund']").remove();
                        $(""+'#ret-'+id+" option[value='Replacement']").remove();
                    }
                    else{
                        
                    }
                },
                error: function(data){
                    alert(data);
                }
            });   
        });
    }
    function autoCustomer(){
    var transaction_id = $('#transaction_id').val();
    
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache: false,
            async: false,
            data: {
                'func': "customer-data1",
                'transaction_id':transaction_id
            },
            dataType:"json",
            success: function(data) {
                $('#c_name').html(data.c_name);
                $('#c_add').html(data.c_address);
                $('#c_cont').html(data.contact_number);
            },
            error: function(data){
                alert(data);
            }
        })
    }
    $("#form-submit").click(function() {

    event.preventDefault();

    var valid = this.form.checkValidity();
    var return_id = $('#return_id').val();
    var transaction_no = $('#transaction_id').val();;
    var total_price = $('#gTotal').val();
    var return_date = $('#transaction_date').val();
    var return_wh = $('#warehouse_code').val();
    var remarks = $('#descr').val();
    var retType = [];
    var whCode = [];
    var totPrice = [];
    var product_code = [];
    var quantity = [];
    var price = [];
    var arrtNo = [];
    var arro_id = [];

    $(".row-total").each(function(){
        totPrice.push($(this).val());
    });
    $(".sel-product_code").each(function(){
        product_code.push($(this).val());
    });
    $(".qty").each(function(){
        quantity.push($(this).val());
        arrtNo.push(return_id);
        arro_id.push(transaction_no);
        whCode.push(return_wh);
    });
    $(".price_ea").each(function(){
        price.push($(this).val());
    });
    $(".return_type").each(function(){
        retType.push($(this).val());
    });
    
    var itemsTotal = 0;
        for (var i = 0; i < quantity.length; i++) {
            itemsTotal += quantity[i] << 0;
        }
    // validation
    $("#valid").html(valid);
    if (valid) {
        event.preventDefault(); 

        $.ajax({
            method: "POST",
            url: "includes/functions/add_function.php",
            cache:false,
            async: false,
            data: {
                'func': "return",
                'return_id':return_id,
                'transaction_no':transaction_no,
                'product_code':product_code,
                'quantity':quantity,
                'item_price':price,
                'tNumber':arro_id,
                'arrNo':arrtNo,
                'totPrice':totPrice,
                'total_price':total_price,
                'itemsTotal':itemsTotal,
                'r_date':return_date,
                'whCode':whCode,
                'retType':retType,
                'remarks':remarks
        
            },
            success: function(data) {
                clearTb();
                emptyReturnForm();
                alert(data);
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
<?php 
    include('includes/foot.php');
?>

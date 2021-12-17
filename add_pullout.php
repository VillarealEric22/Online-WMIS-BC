    <?php
    include('includes/navs.php');
?>
<div class = "transaction-single">
    <div class="input-container">
        <div class="title-box"><div class="title">Return to Supplier</div></div>
        <div class="content">
            <form action="#">
                <input type = 'hidden' value ='0' id = 'counter'>
                <div class="extra-details">
                    <div class="input-box"> 
                        <span class="label">Purchase Order ID</span>
                        <select id="purchase_id" autocomplete="off" style ="width:100%" required>
                            <option></option>
                        </select>
                    </div>
                    <div class="selection-details">
                       
                        <div class="selection-details">
                            <div>Name: <span id = "s_name"></span></div>
                            <div>Address: <span id = "s_add"></span></div>
                            <div>Contact: <span id = "s_cont"></span></div>
                        </div>
                    </div>
                </div>
                <div class="input-details">
                    <div class="input-box">
                        <span class="label">Pullout Reference #</span>
                        <input type="text" placeholder="Return reference #" value ='1' id = 'pullout_id' required>
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
                        <span class="label">Remarks</span>
                        <textarea class = "desc" id = 'descr' maxlength="250" placeholder="Extra Details here"></textarea>
                    </div>
                </div>
            </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate"><a href = 'pullout.php'>Cancel</a></button>
                    <input type="submit" id = 'form-submit' value="Confirm">
                </div>
            </form>
        
    </div>
</div>
<script>
$(document).ready(function(){
    pullout_pid();
    id_pullout();
    var cvalue = $('#counter').val();
    $('#purchase_id').on("select2:select", function(){
        autoSupplier();
        clearTb();
        var val = this.value;
        if($('#purchase_id option').filter(function(){
            return this.value.toUpperCase() === val.toUpperCase();        
        }).length) {
            $.ajax({
                method: "POST",
                url: "includes/functions/auto_inputs.php",
                cache: false,
                async: false,
                data: {
                    'func': "pullout",
                    't_id': val
                },
                dataType:"json",
                success: function(data) {
                    $.each(data, function(cvalue){

                        var dat = "<tr id='ppid-"+cvalue+"'><td class = 'table-input' colspan='4'><select id = 'sel-product-code_"+cvalue+"' class='sel-product_code' autocomplete='off' style = 'width:100%' disabled = 'disabled' required><option value = '"+this.product_code+"'>"+this.product_code+"</option></select></td></tr><tr id='wpid-"+cvalue+"'><td class = 'table-input' colspan=4'><select id = 'sel-warehouse-code_"+cvalue+"' class='sel-warehouse_code' autocomplete='off' style = 'width:100%' required><option></option></select></td></tr><tr id='rpid-"+cvalue+"'><td class = 'table-input' colspan='4'><select id = 'ret-"+cvalue+"' class='return_type' autocomplete='off' style = 'width:100%' required><option value = 'damaged'>Damaged Item</option><option value = 'incorrect'>Incorrect Item</option></select></td></tr><tr id ='row-"+cvalue+"'><td class = 'table-input'><input type='number' min ='0' placeholder ='0' value = '1' max = '"+this.quantity+"' id='amount_"+cvalue+"' class = 'qty' required></td><td class = 'table-input'><input type='number' min ='0' placeholder = '0'  id='price_"+cvalue+"' class = 'price_ea' value = '"+this.price+"' disabled = 'disbaled' required></td><td class = 'table-input'><input type = 'hidden' class = 'pdIn' id='pid-"+cvalue+"'><p>Php<input type = 'hidden' id = 'rowTot"+cvalue+"' class = 'row-total' value = '"+this.price_tot+"'><span id = 'rowTotal-"+cvalue+"' class = 'rowTotal'>"+this.price_tot+"</span></td><td class = 'table-input'><button formnovalidate='formnovalidate' class = 'removeItem'>remove</button></td></tr>";

                        cvalue+1;
                        $('#itemRows').append(dat);
                        rowTotal(cvalue);
                        warehouseCode(cvalue);
                        
                    });
                    grandTotal();
                    
                    $(".sel-product_code").each(function() {
                        initializeSelect2($(this));
                    });
                    $(".return_type").each(function() {
                        initializeSelect2Ret($(this));
                    });
                    $(".sel-warehouse_code").each(function() {
                        initializeSelect2WH($(this));
                    });
                   
                    checkValid();
                },
                error: function(data){
                    alert(data);
                }
            });
        }
        
    });

    function emptyPullOutForm(){
        $('#purchase_id').val('').change();
        $('#pullout_id').val('');
        $('#gTotal').val('');
        $('#grandtotal').html('');
        $('#descr').val('');
        $('#s_name').html('');
        $('#s_add').html('');
        $('#s_cont').html('');
        id_pullout();
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
    function autoSupplier(){
    var transaction_id = $('#purchase_id').val();
    
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache: false,
            async: false,
            data: {
                'func': "supplier-data1",
                'transaction_id':transaction_id
            },
            dataType:"json",
            success: function(data) {
                $('#s_name').text(data.supplier_name);
                $('#s_add').text(data.supplier_address);
                $('#s_cont').text(data.contact_number);
            },
            error: function(data){
                alert(data);
            }
        })
    }
    function checkValid(){
        alert("Items in order past its warranty coverage are removed automatically from table");
        $('.pdIn').each(function(){
            var pid = $(this).attr('id');
            var arr = pid.split('-');
            var id = arr[1];
            var pcode = $('#sel-product-code_'+id).val();
            var t_no = $("#purchase_id").val();
            $.ajax({
                method: "POST",
                url: "includes/functions/load_data.php",
                cache: false,
                async: false,
                data: {
                    'func': "check_validity_s",
                    'pcode':pcode,
                    't_no':t_no
                },
                dataType:"json",
                success: function(data, count) {
                    var count = count;
                    if(data == "invalid"){
                        $('#p'+ pid).remove();
                        $('#w'+ pid).remove();
                        $('#r'+ pid).remove();
                        $('#row-' + id).remove();
                        grandTotal();
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
    $('#form-submit').click(function (){
        event.preventDefault();
        
        var valid = this.form.checkValidity();
        var pullout_id = $('#pullout_id').val();
        var purchase_id = $('#purchase_id').val();
        var total_price = $('#gTotal').val();
        var return_date = $('#transaction_date').val();
        var remarks = $('#descr').val();

        var return_type = [];
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

        $(".sel-warehouse_code").each(function(){
            whCode.push($(this).val());
        });

        $(".qty").each(function(){
            quantity.push($(this).val());
            arrtNo.push(pullout_id);
            arro_id.push(purchase_id);
        });

        $(".price_ea").each(function(){
            price.push($(this).val());
        });

        $(".return_type").each(function(){
            return_type.push($(this).val());
        });

        var itemsTotal = 0;
            for (var i = 0; i < quantity.length; i++) {
                itemsTotal += quantity[i] << 0;
            }
        console.log(whCode);
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
                    'func': "pullout",
                    'pullout_id':pullout_id,
                    'product_code':product_code,
                    'quantity':quantity,
                    'item_price':price,
                    'arrNo':arrtNo,
                    'whCode':whCode,
                    'totPrice':totPrice,
                    'total_price':total_price,
                    'itemsTotal':itemsTotal,
                    'return_type':return_type,
                    'r_date':return_date,
                    'remarks':remarks,
                    'po_id':purchase_id
                },
                success: function(data) {
                    emptyPullOutForm();
                    alert(data);
                    clearTb();
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

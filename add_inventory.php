<?php
    include('includes/navs.php');
?>
<div class = "transaction-single">
    <div class="input-container">
        <div class="title-box"><div class="title">Add To Inventory</div></div>
        <div class="content">
            <form action="#">
            <input type="hidden" value="0" id="counter">
                <div class="extra-details">
                    <div class="input-box">
                        <span class="label">Order Number</span>
                        <select id="purchase_id" autocomplete="off" style = "width:100%" required>
                            <option></option>
                        </select>
                    </div>
                    <div class="selection-details">
                        <span id = "s_add"></span>
                        <span id = "s_cont"><span>
                    </div>
                </div>
                <div class="input-details">
                    <div class="input-box">
                        <span class="label">Inventory Reference #</span>
                        <input type="text" placeholder="Inventory Reference #" id ='inventory_id' value = '1' required>
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
                        <span class="label">Warehouse</span>
                        <select id="warehouse_code" class="warehouse_code" autocomplete="off" style = "width:100%" required>
                            <option></option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="label">Remarks</span>
                        <textarea class = "desc" maxlength="250" placeholder="Extra Details here"></textarea>
                    </div>
                </div>
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate"><a href = 'inventory.php'>Cancel</a></button>
                    <input type="submit" id = "form-submit" value="Confirm">
                </div>
            </form>
    </div>
</div>
<script>
$(document).ready(function(){
    inventoryOR();
    id_inventory();
    warehouseCode2();
    $('#purchase_id').on("select2:select", function(){
        clearTb();
        var val = this.value;
        if($('#purchase_id option').filter(function(){
            return this.value.toUpperCase() === val.toUpperCase();        
        }).length) {
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            data: {
                'func': "order-data",
                'o_id':val
            },
            dataType:"json",
            success: function(data) {
                $('#s_add').text(data.supplier_address);
                $('#s_cont').text(data.contact_number);
            },
            error: function(data){
                alert(data);
            }
        });
        }
        items();
    });
    $('#warehouse_code').on("select2:select", function(){
        alert(this.value);
    });
    function emptyInventoryForm(){
        $('#purchase_id').val('').change();
        $('#inventory_id').val('');
        $('#gTotal').val('');
        $('#warehouse_code').val('').change();
        id_inventory();
    }
    function clearTb(){
        $('.pdIn').each(function(){
            var pid = $(this).attr('id');
            var arr = pid.split('-');
            var id = arr[1];
            $('#p'+ pid).remove();
            $('#r'+ pid).remove();
            $('#w'+ pid).remove();
            $('#row-' + id).remove();
            $('#counter').val('0');
            grandTotal();
        });
    }
    function items(){
        var id = $('#purchase_id').val();
        var cvalue = $('#counter').val();
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache: false,
            async: false,
            data: {
                'func': "inventory_order",
                'o_id':id
            },
            dataType:"json",
            success: function(data) {
                $.each(data, function(cvalue){
                    var dat = "<tr id='ppid-"+cvalue+"'><td class = 'table-input' colspan='4'><select id = 'sel-product_code"+cvalue+"' class='sel-product_code' autocomplete='off' style = 'width:100%' disabled = 'disabled' required><option value = '"+this.product_code+"'>"+this.product_code+"</option></select></td></tr><tr id = 'wpid-"+cvalue+"'><td class = 'table-input'><input type='number' min ='0' placeholder ='0' value = '"+this.remain_qty+"' max = '"+this.remain_qty+"' id='amount_"+cvalue+"' class = 'qty' required></td><td class = 'table-input'><input type='number' min ='0' placeholder = '0' id='price_"+cvalue+"' class = 'price_ea' value = '"+this.price+"' disabled = 'disbaled' required></td><td class = 'table-input'><input type = 'hidden' class = 'pdIn' id='pid-"+cvalue+"'><p>Php<input type = 'hidden' id = 'rowTot"+cvalue+"' class = 'row-total' value = '"+this.price_tot+"'><span id = 'rowTotal-"+cvalue+"' class = 'rowTotal'>"+this.price_tot+"</span></td><td class = 'table-input'><button formnovalidate='formnovalidate' class = 'removeItem'>remove</button></td></tr>";
                    cvalue+1;
                    $('#itemRows').append(dat);
                });
                
                $(".sel-product_code").each(function() {
                    initializeSelect2($(this));
                });
            },
            error: function(data){
                alert(data);
            }
        }); 
        grandTotal();
    }
    $("#form-submit").click(function() {
        event.preventDefault();
        var valid = this.form.checkValidity();
        var inventory_id = $('#inventory_id').val();
        var purchaseorder = $('#purchase_id').val();
        var warehouse_code = $('#warehouse_code').val();
        var total_price= $('#gTotal').val();
        var tDate = $('#transaction_date').val();
        var remarks = $('.desc').val();
        var totPrice = [];
        var product_code = [];
        var quantity = [];
        var price = [];
        var arrtNo = [];
        var arrWhse = [];
        var arro_id = [];

        $(".row-total").each(function(){
            totPrice.push($(this).val());
        });
        $(".sel-product_code").each(function(){
            product_code.push($(this).val());
        });
        $(".qty").each(function(){
            quantity.push($(this).val());
            arrtNo.push(inventory_id);
            arrWhse.push(warehouse_code);
            arro_id.push(purchaseorder);
        });
        $(".price_ea").each(function(){
            price.push($(this).val());
        });
        var itemsTotal = 0;
            for (var i = 0; i < quantity.length; i++) {
                itemsTotal +=
                 quantity[i] << 0;
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
                    'func': "inventory",
                    'inventory_id':inventory_id,
                    'purchaseorder': purchaseorder,
                    'warehouse_code': warehouse_code,
                    'total_price': total_price,
                    'transaction_date': tDate,
                    'product_code': product_code,
                    'quantity': quantity,
                    'price_ea': price,
                    'totPrice': totPrice,
                    'itemsTotal': itemsTotal,
                    'tNumber': arrtNo,        
                    'whseCode':arrWhse,
                    'order_id':arro_id,
                    'desc':remarks
                },
                success: function(data) {
                    emptyInventoryForm();
                    clearTb();
                    alert(data);
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

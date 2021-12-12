<?php
    include('includes/navs.php');
?>
<div class = "transaction-single">
<div class="input-container">
        <div class="title-box"><div class="title">Purchase Order</div></div>
        <div class="content">
            <form action="#">
            <div class="extra-details">
                    <input type="hidden" value="0" id="counter">
                    <div class="input-box">
                        <span class="label">Supplier</span>
                        <select id="supplier_id" autocomplete="off" style = "width:100%" required>
                            <option></option>
                        </select>
                    </div>
                    <div class="selection-details">
                        <div>Address: <span id = "s_add"></span></div>
                        <div>Contact: <span id = "s_cont"></span></div>
                    </div>
                </div>
                <div class="input-details">
                    <div class="input-box">
                        <span class="label">Order Reference #</span>
                        <input type="text" id = "purchase_order_id" placeholder="OR Number" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Order Date</span>
                        <input type="date" id = "transaction_date" required>
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
                            <tr id='ppid-0'>
                                <td class = 'table-input' colspan='4'>
                                    <select id='sel-product_code0'class='sel-product_code' autocomplete='off' style = 'width:100%' disabled = "disabled" required><option></option></select>
                                </td>
                            </tr>
                            <tr id = 'rpid-0'>
                                <td class = 'table-input'>
                                    <input type='number' id='amount_0' min ='0' placeholder ='0' class = 'qty' disabled = "disabled" required>
                                </td>
                                <td class = 'table-input'>                              
                                    <span class="unit"> &#8369;</span><input type='number' id='price_0' min ='0' placeholder = '0' value='0' class = 'price_ea' disabled = "disabled" required>
                                </td>
                                <td class = 'table-input'>
                                    <input type = 'hidden' id = 'rowTot0' class = 'row-total' value = '0'><span> &#8369; </span> &nbsp; <span id = 'rowTotal-0' class = 'rowTotal'>0.00</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button formnovalidate="formnovalidate" id ="orderProduct" disabled = 'disabled'>Add Row</button>
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
                    <button formnovalidate="formnovalidate"><a href = 'orders.php'>Cancel</a></button>
                    <input type="submit" id = "form-submit" value="Confirm">
                </div>
            </form>
    </div>
</div>
<script>
$(document).ready(function(){
    var cvalue = $("#counter").val();
    supplier();
    id_order();
    $("#supplier_id").on('select2:select', function (){
        var val = this.value;
        clearTb();
        clearRow();
        if($('#supplier_id option').filter(function(){
            return this.value.toUpperCase() === val.toUpperCase();        
        }).length) {
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            data: {
                'func': "supplier-data",
                'supplier_id':val
            },
            dataType:"json",
            success: function(data) {
                $('#s_add').text(data.supplier_address);
                $('#s_cont').text(data.contact_number);
                supplierItem(cvalue);
                $('#orderProduct').removeAttr('disabled');
                $('.sel-product_code').removeAttr('disabled');
                $('.qty').removeAttr('disabled');
                $('.price_ea').removeAttr('disabled');
            },
            error: function(data){
                alert(data);
            }
        });
    }
});
    function emptyOrderForm(){
        $('#supplier_id').val('').change();
        $('#purchase_order_id').val('');
        $('#sel-product_code0').val('').change();
        $('#amount_0').val('');
        $('#price_0').val('');
        $('#gTotal').val('');
        $('#remark').val('');
        $('.rowTotal-0').html('');
        $('#s_add').html('');
        $('#s_cont').html('');
        id_order();
        $('#orderProduct').attr('disabled');
        $('.sel-product_code').attr('disabled');
        $('.qty').attr('disabled');
        $('.price_ea').attr('disabled');
    }
    function clearTb(){
        $('.pdIn').each(function(){
            var pid = $(this).attr('id');
            var arr = pid.split('-');
            var id = arr[1];
            $('#p'+ pid).remove();
            $('#r'+ pid).remove();
            $('#row-' + id).remove();
            $('#counter').val('0');
            grandTotal();
        });
    }
    function clearRow(){
        $('#sel-product_code0').val('').change();
        $('#amount_0').val('');
        $('#price_0').val('');
        $('#gTotal').val('');
        $('#remark').val('');
        $('#s_add').html('');
        $('#s_cont').html('');
        $('#rowTot0').val(0);
        $('#rowTotal-0').html('0.00');
        grandTotal();
    }
    $("#form-submit").click(function(){
        var valid = this.form.checkValidity();
        var transaction_no = $('#purchase_order_id').val();
        var s_id = $('#supplier_id').val();
        var total_price= $('#gTotal').val();
        var tDate = $('#transaction_date').val();
        var remarks = $('.desc').val();
        var totPrice = [];
        var product_code = [];
        var quantity = [];
        var price = [];
        var arrtNo = [];

        $(".row-total").each(function(){
            totPrice.push($(this).val());
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
                    'func': "orders",
                    'purchase_order_id': transaction_no,
                    'supplier_ID': s_id,
                    'total_price': total_price,
                    'order_date': tDate,
                    'product_code': product_code,
                    'quantity': quantity,
                    'price_ea': price,
                    'totPrice': totPrice,
                    'status':"pending",
                    'itemsTotal': itemsTotal,
                    'tNumber': arrtNo,
                    'desc':remarks
                },
                success: function(data) {
                    emptyOrderForm();
                    alert(data);
                    clearTb();
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
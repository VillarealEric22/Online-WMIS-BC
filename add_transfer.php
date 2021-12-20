<?php
    include('includes/navs.php');
?>
<?php
    if ($_SESSION["userrole"]!= "Admin" || $_SESSION["userrole"]!="Inventory_clerk") {
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

       die("Invalid access, you do not have permission to be in this page");
    }
?>
<div class = "transaction-single">
    <div class="input-container">
        <div class="title-box"><div class="title">Transfer Inventory</div></div>
        <div class="content">
            <form action="#">
                <div class="extra-details">
                    <input type="hidden" value="0" id="counter">
                    <div class="input-box">
                        <span class="label">Transfer From</span>
                        <select id="warehouse_code" class = "warehouse_code" autocomplete="off" style = "width:100%" required>
                            <option></option>
                        </select>
                    </div>
                    <div class="selection-details">
                        <p id = "w_add"></p>
                        <p id = "w_cont"></p>
                    </div>
                </div>
                <div class="input-details">
                    <div class="input-box">
                        <span class="label">Transfer Reference #</span>
                        <input type="text" id = "transfer_id-in" placeholder="OR Number" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Date</span>
                        <input type="date" id = 'transaction_date' required>
                    </div>
                </div>
                <div class="input-tb" id="tb-input">
                    <table id="prodCart" class="modalTable" width = "100%">
                        <thead>
                            <tr>
                                <td>Qty Remaining</td>
                                <td>Qty to Transfer</td>
                                <td>Action</td>             
                            </tr>
                        </thead>   
                        <tbody id = "itemRows">
                            <tr id="ppid-0">
                                <td class = "table-input" colspan="4">
                                    <select class="sel-product_code required" required id='sel-product-code_0' autocomplete="off" style = "width:100%">
                                        <option></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class = "table-input"><input type="number" id ='alert-0' min ="0" placeholder = "0" class = "qty_avail" disabled></td>
                                <td class = "table-input"><input type="number" id ='amount_0' min ="0" placeholder = "0" class = "qty" required></td>
                                <td class = "table-input"></td>     
                            </tr>
                        </tbody>
                    </table>
                    <button formnovalidate="formnovalidate" id ="addProduct" disabled='disabled'>Add Row</button>
                </div>
                <div class="extra-details">
                    <div class="input-box">
                        <span class="label">Transfer To</span>
                        <select id="warehouse_dest" class="warehouse_dest required" required autocomplete="off" style = "width:100%">
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
                    <button formnovalidate="formnovalidate"><a href = 'transfer.php'>Cancel</a></button>
                    <input type="submit" id = "form-submit" value="Confirm">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    warehouseCode2();
    id_transfer();
    var cvalue = $("#counter").val();
    $("#warehouse_code").on('select2:select', function (){
        var val = this.value;
        $('.wh_code1').remove();
        if($('#warehouse_code option').filter(function(){
            return this.value.toUpperCase() === val.toUpperCase();        
        }).length) {
            $.ajax({
                method: "POST",
                url: "includes/functions/populate_sources.php",
                cache:false,
                async: false,
                data: {
                    'func': "wh_dest",
                    'id':val
                },
                dataType:"json",
                success: function(data) {
                    $.each(data, function(){
                        var insert = "<option class = 'wh_code1' value='" + this.warehouse_code + "'>" + this.warehouse_name + "</option>";
                        $('#warehouse_dest').append(insert);
                    });
                    whItem(cvalue);
                    $('#addProduct').removeAttr('disabled');  
                },
                error: function(data){
                    alert(data);
                }
            });
        }
    });
    function emptyTransferForm(){
        $('#warehouse_code').val('').change();
        $('#transfer_id-in').val('');
        $('#sel-product-code_0').val('').change();
        $('#alert-0').val('');
        $('#amount_0').val('');
        $('#warehouse_dest').val('').change();
        $('#descr').val('');
    
    }
    $(document).on('select2:select', '.sel-product_code', function (){
        var val = this.value;
        var wh =  $("#warehouse_code").val();

        var cval = $(this).attr('id');
        var arr = cval.split('_');
        cval = arr[1];
        
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
                },
                error: function(data){
                    alert(data);
                }
            });
        }
    });
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
    $("#warehouse_code").on('select2:unselect', function (){
        $('.product').remove();
        $('#alert-0').val(0);
        $('#amount_0').val(0);
        clearTb();
    });
    $("#warehouse_code").on('select2:selecting', function (){
        $('.product').remove();
        $('#alert-0').val(0);
        $('#amount_0').val(0);
        clearTb();
    });
    $("#form-submit").click(function() {
        event.preventDefault();
        var valid = this.form.checkValidity();
        var transfer_id = $('#transfer_id-in').val();
        var whSource = $('#warehouse_code').val();
        var whDest = $('#warehouse_dest').val();
        var date_created = $('#transaction_date').val();
        var remarks = $('#descr').val();
        var product_code = [];
        var quantity = [];
        var arrtNo = [];
        
            $(".sel-product_code").each(function(){
                product_code.push($(this).val());
            });
            $(".qty").each(function(){
                quantity.push($(this).val());
                arrtNo.push(transfer_id);
            });
            var itemsTotal = 0;
                for (var i = 0; i < quantity.length; i++) {
                    itemsTotal += quantity[i] << 0;
                }
        $("#valid").html(valid);
        if (valid) {
            $.ajax({
                method: "POST",
                url: "includes/functions/add_function.php",
                cache: false,
                async: false,
                data: {
                    'func': "transfer",
                    'transfer_id': transfer_id,
                    'product_code': product_code,
                    'quantity': quantity,
                    'itemsTotal': itemsTotal,
                    'tNumber': arrtNo,
                    'warehouse_source': whSource,
                    'warehouse_dest': whDest,
                    'date_created': date_created,
                    'remarks':remarks
                },
                success: function(data) {
                    emptyTransferForm();
                    alert(data);
                    clearTb();
                    id_transfer();
                },
                error: function(){
                    alert(data);
                    alert("error")
                }
            });
        }
    });
})
</script>
<?php 
include('includes/foot.php');
?>

<?php
    include('includes/navs.php');
?>
<?php
    if ($_SESSION["userrole"] == "Inventory_clerk") {
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
                        <span class="label">Transfer Reference #</span> 
                        <select id="transfer_id" class = "transfer_id" autocomplete="off" style = "width:100%" required>
                            <option></option>
                        </select>
                    </div>
                    <div class="input-box">
                        <span class="label">Transfer From</span>
                        <select id="warehouse_code" class = "warehouse_code"autocomplete="off" style = "width:100%" disabled = "disabled">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="input-details">
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
                                <td>Qty to Receive</td>
                                <td>Action</td>             
                            </tr>
                        </thead>   
                        <tbody id = "itemRows">
                            
                        </tbody>
                    </table>
                </div>
                <div class="extra-details">
                    <div class="input-box">
                        <span class="label">Transfer To</span>
                        <select id="warehouse_dest" class="warehouse_dest" autocomplete="off" style = "width:100%" disabled = "disabled" required>
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
                    <button formnovalidate="formnovalidate"><a href = 'transfer-approved.php'>Cancel</a></button>
                    <input type="submit" id = "form-submit" value="Confirm">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    transfer();
    warehouseCode2();
    var cvalue = $("#counter").val();
    $('#transfer_id').on('select2:select', function(){
        clearTb();
        var id = this.value;
        transfer_wh(id);
        items();
    });
    function items(){
        var tid = $('#transfer_id').val();
        var cvalue = $('#counter').val();
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache: false,
            async: false,
            data: {
                'func': "transfer",
                'o_id':tid
            },
            dataType:"json",
            success: function(data) {
                $.each(data, function(cvalue){

                    var dat = "<tr id='ppid-"+cvalue+"'><td class = 'table-input' colspan='4'><select id = 'sel-product-code_"+cvalue+"' class='sel-product_code' autocomplete='off' style = 'width:100%' disabled = 'disabled'><option value = '"+this.product_code+"'>"+this.product_code+"</option></select></td></tr><tr id = 'wpid-"+cvalue+"'><td class = 'table-input'><input type='number' min ='0' placeholder ='0' id ='alert-"+cvalue+"'  max = '"+this.remain_qty+"' value = '"+this.remain_qty+"' class = 'qty_avail' disabled></td><td class = 'table-input'><input type='number' min ='0' placeholder = '0'  max = '"+this.remain_qty+"' id='amount_"+cvalue+"' class = 'qty' value = '"+this.remain_qty+"' required></td><td class = 'table-input'><input type = 'hidden' class = 'pdIn' id='pid-"+cvalue+"'><button formnovalidate='formnovalidate' class = 'removeItem'>remove</button></td></tr>"
                    $('#itemRows').append(dat);
                    $('#warehouse_code').val(this.warehouse_source).change();
                    $('#warehouse_dest').val(this.warehouse_dest).change();
                    //onload: call the select2 initialize function
                });      
                $(".sel-product_code").each(function() {
                    initializeSelect2($(this));
                });
                
            },
            error: function(data){
                alert(data);
            }
        });
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
    function emptyTransferForm(){
        $('#warehouse_code').val('').change();
        $('#transfer_id').val('').change();
        $('#warehouse_dest').val('').change();
        $('#descr').val('');
    }
    $("#form-submit").click(function() {
        event.preventDefault();
        
        var transfer_id = $('#transfer_id').val();
        var whSource = $('#warehouse_code').val();
        var whDest = $('#warehouse_dest').val();
        var date_created = $('#transaction_date').val();
        var remarks = $('#descr').val();
        var product_code = [];
        var quantity = [];
        var arrtNo = [];
        var wh_source = [];
        var wh_dest = [];

        $(".sel-product_code").each(function(){
            product_code.push($(this).val());
        });
        $(".qty").each(function(){
            quantity.push($(this).val());
            arrtNo.push(transfer_id);
            wh_source.push(whSource);
            wh_dest.push(whDest);

        });
        var itemsTotal = 0;
            for (var i = 0; i < quantity.length; i++) {
                itemsTotal += quantity[i] << 0;
            }
        $.ajax({
            method: "POST",
            url: "includes/functions/update_function.php",
            cache: false,
            async: false,
            data: {
                'func': "transfer-receive",
                'transfer_id': transfer_id,
                'product_code': product_code,
                'quantity': quantity,
                'itemsTotal': itemsTotal,
                'tNumber': arrtNo,
                'warehouse_source': whSource,
                'warehouse_dest': whDest,
                'wh_source': wh_source,
                'wh_dest': wh_dest,
                'date_created': date_created,
                'remarks':remarks
            },
            success: function(data) {
                emptyTransferForm();
                alert(data);
                clearTb();
            },
            error: function(){
                alert(data);
                alert("error")
            }
        });
    });
})
</script>
<?php 
    include('includes/foot.php');
?>

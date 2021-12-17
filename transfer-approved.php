<?php
    include('includes/navs.php');
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>Approved Transfer</h2>
                <div class="crud-buttons">
                    <button onclick = "location.href = 'receive_transfer.php'" class = "btn blue" id = "add_btn">Receive</button>
                    <button href = "#cancel" class = "btn modalbtn red" id = "delete_btn" disabled = "disabled">Cancel</button>
                </div>
            </div>
            <div class="content-row">
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
        </div>
        <div class="content-row">
            <table id ="sortable">
                <thead>
                    <tr>
                        <td></td>
                        <td id = 'code-h'>Code</td>
                        <td id = 'date-h'>Date</td>
                        <td id = 'total-h'>Total Item</td>
                        <td id = 'source-h'>Warehouse Source</td>
                        <td id = 'destination-h'>Warehouse Destination</td>
                        <td id = 'employee-h'>Employee</td>
                        <td id = 'status-h'>Status</td>
                        <td></td>
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
        </div>
    </div>
</div>
<div id="cancel" class="modal">
        <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action-delete'> Cancel </span> Transfer Request</div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <div class="extra-details">
                    Cancel selected approved transfer requests? This action is not reversible.
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate" class = "btn-cancel">Cancel</button>
                    <input type="submit" id = "submit-confirm" value="Confirm"/>
                </div>
            </form>
        </div>
    </div>
</div>
<div id = "view" class = "modal">
     <!-- Modal content -->
    <div class="input-container">
    <div class="title-box"><div class="title">Transfer Approved View</div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <div class="extra-details">
                    <input type="hidden" value="0" id="counter">
                    <div class="input-box">
                        <span class="label">Transfer From</span>
                        <input type = "text" id="warehouse_code-a" class = "warehouse_code required"autocomplete="off" style = "width:100%" disabled ="disabled" >
                    </div>
                    <div class="selection-details">
                        <p id = "w_add"></p>
                        <p id = "w_cont"></p>
                    </div>
                </div>
                <div class="input-details">
                    <div class="input-box">
                        <span class="label">Transfer Reference #</span>
                        <input type="text" id = "transfer_id-in" placeholder="OR Number" disabled ="disabled" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Date</span>
                        <input type="date" id = 'transaction_date' required disabled ="disabled" >
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

                        </tbody>
                    </table>
                </div>
                <div class="extra-details">
                    <div class="input-box">
                        <span class="label">Transfer To</span>
                        <input type = "text" id="warehouse_dest-a" class="warehouse_dest required" autocomplete="off" style = "width:100%" disabled ="disabled" >
                    </div>
                    <div class="input-box">
                        <span class="label">Remarks</span>
                        <textarea class = "desc" id = 'descr' maxlength="250" placeholder="Extra Details here" disabled ="disabled" ></textarea>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    loadData();
    $('#submit-confirm').click(function(){
        var id = $('.selectable:checked').val();
        $.ajax({
            method: "POST",
            url: "includes/functions/update_function.php",
            cache: false,
            async: false,
            data: {
                'func': "transfer-cancel",
                'id':id
            },
            success: function(data){
                alert(data);
                $('#cancel').hide();
            },
            error: function(){
                alert("somehting is wrong");
            }
        });
    });
    
    
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
    var f_code = 1;
    var f_date = 1;
    var f_total = 1;
    var f_source = 1;
    var f_destination = 1;
    var f_employee = 1;
    var f_status = 1;
    $("#code-h").click(function(){
        f_code *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_code,n);
    });
    $("#date-h").click(function(){
        f_date *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_date,n);
    });
    $("#total-h").click(function(){
        f_total *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_total,n);
    });
    $("#source-h").click(function(){
        f_source *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_source,n);
    });
    $("#destination-h").click(function(){
        f_destination *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_destination,n);
    });
    $("#employee-h").click(function(){
        f_employee *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_employee,n);
    });
    $("#status-h").click(function(){
        f_status *= -1;
        var n = $(this).prevAll().length;
        sortTable(f_status,n);
    });
    function loadData(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/load_data.php",
            data: {
                'func':"transfer-approved"
            },                             
            success: function(response){                    
                $("#table-data").html(response); 
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
    function view(id){
        var id = id;   
        var cvalue = $('#counter').val();
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            data: {
                'func': "transfer-1",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#warehouse_code-a').val(data.warehouse_source);
                $('#transfer_id-in').val(data.transfer_id);
                $('#transaction_date').val(data.request_date);
                $('#warehouse_dest-a').val(data.warehouse_dest);
                $('#descr').val(data.remarks);
                viewTable(id);
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
        });
    }
    function viewTable(id){
        var id = id;
        var cvalue = $('#counter').val();
        
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            data: {
                'func': "transfer-2",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $.each(data, function(cvalue){
                    var dat = "<tr id='ppid-"+cvalue+"'><td class = 'table-input' colspan='3'><input type = 'text' id = 'sel-product-code_"+cvalue+"' class='sel-product_code' value = '"+this.product_code+"' autocomplete='off' style = 'width:100%'  disabled = 'disabled'></td></tr><tr id ='rpid-"+cvalue+"'><td class = 'table-input'><input type='number' min ='0' placeholder ='0' id ='alert-"+cvalue+"' value = '"+this.remain_qty+"' class = 'qty_avail' disabled></td><td class = 'table-input'><input type='number' min ='0' placeholder = '0' id='amount_"+cvalue+"' value = '"+this.quantity+"' class = 'qty' required disabled = 'disabled'></td><td class = 'table-input'><input type = 'hidden' class = 'pdIn' id='pid-"+cvalue+"'></td></tr>"
                    $('#itemRows').append(dat);
                }); 
            },
            error: function(data){
                alert(data);
            }
        });
    }
    $('#sortable').on('click', '.btn_view', function(){
        clearTb();
        var id = this.value;
        view(id);
        $('#view').css("display", "flex");
        $('#view').show();
    });
});
</script>
<?php 
    include('includes/foot.php');
?>

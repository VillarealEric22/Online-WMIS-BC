<?php
    include('includes/navs.php');
?>
<?php
    if ($_SESSION["userrole"]!= "Admin") {
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

       die("Invalid access, you do not have permission to be in this page");
    }
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>Inventory</h2>
                <div class="crud-buttons">
                    <button onclick = "location.href = 'add_inventory.php'" class = "btn blue" id = "add_btn">Add</button>
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
                        <td id = 'pid-h'>Purchase ID</td>
                        <td id = 'item-h'>Total Item</td>
                        <td id = 'value-h'>Total Value</td>
                        <td id = 'warehouse-h'>Warehouse</td>
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
<div id="view" class="modal">    
    <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action'> View </span> Inventory </div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
            <div class="content">
                <form action="#">
                <input type="hidden" value="0" id="counter">
                    <div class="extra-details">
                        <div class="input-box">
                            <span class="label">Order Number</span>
                            <input type = "text" id="purchase_id-v" autocomplete="off" style = "width:100%" required disabled = "disabled">
                        </div>
                        <div class="selection-details">
                            <span id = "s_add"></span>
                            <span id = "s_cont"><span>
                        </div>
                    </div>
                    <div class="input-details">
                        <div class="input-box">
                            <span class="label">Inventory Reference #</span>
                            <input type="text" placeholder="Inventory Reference #" id ='inventory_id' value = '1' required  disabled = "disabled">
                        </div>
                        <div class="input-box">
                            <span class="label">Date</span>
                            <input type="date" id = 'transaction_date' required  disabled = "disabled">
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
                            &#8369; <input type = 'hidden' id = 'gTotal' value ='0'><span class="grand-total" id = "grandTotal">0.00</span>
                        </div>
                        <div class="input-box">
                            <span class="label">Warehouse</span>
                            <input type = "text" id="warehouse_code-v" class="warehouse_code" autocomplete="off" style = "width:100%" required  disabled = "disabled">
                        </div>
                        <div class="input-box">
                            <span class="label">Remarks</span>
                            <textarea class = "desc" maxlength="250" placeholder="Extra Details here" disabled = "disabled"></textarea>
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
        var f_icode = 1;
        var f_idate = 1;
        var f_iid = 1;
        var f_iitem = 1;
        var f_ivalue = 1;
        var f_iwarehouse = 1;
        $("#code-h").click(function(){
            f_icode *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_icode,n);
        });
        $("#date-h").click(function(){
            f_idate *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_idate,n);
        });
        $("#pid-h").click(function(){
            f_iid *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_iid,n);
        });
        $("#item-h").click(function(){
            f_iitem *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_iitem,n);
        });
        $("#value-h").click(function(){
            f_ivalue *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_ivalue,n);
        });
        $("#warehouse-h").click(function(){
            f_iwarehouse *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_iwarehouse,n);
        });
    function loadData(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/load_data.php",
            data: {
                'func':"inventory"
            },                             
            success: function(response){                    
                $("#table-data").html(response); 
            },
            error: function(){
                alert("Something went wrong");
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
    function view(id){
        var id = id;   
        var cvalue = $('#counter').val();
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            data: {
                'func': "inventory-1",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#inventory_id').val(data.inventory_id);
                $('#purchase_id-v').val(data.purchase_order_id);
                $('#warehouse_code-v').val(data.warehouse_code);
                $('#grandTotal').html(data.totalVal);
                $('#transaction_date').val(data.date_created);
                $('.desc').val(data.remarks);
                viewTable(id);
            },
            error: function(data){
                alert(ayaw);
            }
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
                'func': "inventory-2",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $.each(data, function(cvalue){
                    var dat = "<tr id='ppid-"+cvalue+"'><td class = 'table-input' colspan='4'><input type = 'text' id = 'sel-product_code"+cvalue+"' class='sel-product_code-v' autocomplete='off' style = 'width:100%' disabled = 'disabled' required value = '"+this.product_code+"'></td></tr><tr id = 'wpid-"+cvalue+"'><td class = 'table-input'><input type='number' min ='0' placeholder ='0' value = '"+this.quantity+"' max = '"+this.quantity+"' id='amount_"+cvalue+"' class = 'qty' disabled = 'disabled' required></td><td class = 'table-input'><span class='unit'> &#8369; </span><input type='text' min ='0' placeholder = '0' id='price_"+cvalue+"' class = 'price_ea' value = '"+this.unit_price+"' disabled = 'disbaled' required></td><td class = 'table-input'><input type = 'hidden' class = 'pdIn' id='pid-"+cvalue+"'><p> &#8369; <input type = 'hidden' id = 'rowTot"+cvalue+"' class = 'row-total' value = '"+this.total_price+"'><span id = 'rowTotal-"+cvalue+"' class = 'rowTotal'>"+this.total_price+"</span></td><td class = 'table-input'></tr>";
                    cvalue+1;
                    $('#itemRows').append(dat);
                });
            },
            error: function(data){
                alert(ayaw);
            }
        });
    }
    $('#sortable').on('click', '.btn_view', function(){
        var id = this.value;
        clearTb();
        view(id);       
        $('#view').css("display", "flex");
        $('#view').show();
    });
})
</script>
<?php 
    include('includes/foot.php');
?>

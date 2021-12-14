<?php
    include('includes/navs.php');
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>Completed Orders</h2>
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
                        <td id = 'supplier-h'>Supplier</td>
                        <td id = 'total-h'>Total Item</td>
                        <td id = 'grand-h'>Grand Total</td>
                        <td id = 'date-h'>Date</td>
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
<div id = "view" class = "modal">
    <div class="input-container">
    <div class="title-box"><div class="title">View Purchase Order</div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
            <div class="extra-details">
                    <input type="hidden" value="0" id="counter">
                    <div class="input-box">
                        <span class="label">Supplier</span>
                        <input type = "text" id="supplier_id-v" autocomplete="off" style = "width:100%" disabled = "disabled" required>
                    </div>
                    <div class="selection-details">
                        <div>Address: <span id = "s_add"></span></div>
                        <div>Contact: <span id = "s_cont"></span></div>
                    </div>
                </div>
                <div class="input-details">
                    <div class="input-box">
                        <span class="label">Order Reference #</span>
                        <input type="text" id = "purchase_order_id" placeholder="OR Number"  disabled = "disabled" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Order Date</span>
                        <input type="date" id = "transaction_date" disabled = "disabled" required>
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
                        <textarea class = "desc" maxlength="250" placeholder="Extra Details here"  disabled = "disabled" id = 'remark'></textarea>
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
        var f_code = 1;
        var f_supplier = 1;
        var f_total = 1;
        var f_grand = 1;
        var f_date = 1;
        var f_status = 1;
        $("#code-h").click(function(){
            f_code *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_code,n);
        });
        $("#supplier-h").click(function(){
            f_supplier *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_supplier,n);
        });
        $("#total-h").click(function(){
            f_total *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_total,n);
        });
        $("#grand-h").click(function(){
            f_grand *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_grand,n);
        });
        $("#date-h").click(function(){
            f_date *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_date,n);
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
                'func':"orders-c"
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
                'func': "order-1",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#supplier_id-v').val(data.supplier_id);
                $('#purchase_order_id').val(data.purchase_order_id);
                $('#transaction_date').val(data.order_date);
                $('#grandTotal').html(data.total_price);
                $('#remark').val(data.remarks);
                $('#s_add').html(data.supplier_address);
                $('#s_cont').html(data.contact_number);
                viewTable(id);
            },
            error: function(data){
                alert(data);
            }
        });
    }
    function viewTable(id){
        var id = id;
        var pid = $('#counter').val();
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            data: {
                'func': "order-2",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $.each(data, function(pid){
                    var dat = "<tr id='ppid-"+pid+"'><td class = 'table-input' colspan='4'><input type = 'text' id = 'sel-product_code_"+pid+"' class='sel-product_code' autocomplete='off' value = '"+this.product_code+"'style = 'width:100%' disabled='disabled'></td></tr><tr id = 'rpid-"+pid+"'><td class = 'table-input'><input type='hidden' id='alert-'" + pid + "' value=''><input type='number' id='amount_"+pid+"' value = '"+this.quantity+"' min ='0' placeholder ='0' class = 'qty' required disabled='disabled'></td><td class = 'table-input'><span class='unit'> &#8369; </span><input type='number' min ='0' placeholder = '"+ this.price + "' id='price_"+pid+"' class = 'price_ea' value='"+ this.price + "' required disabled='disabled'></td><td class = 'table-input'><input type = 'hidden' class = 'pdIn' id='pid-"+pid+"' value ='"+pid+"'><input type = 'hidden' id = 'rowTot"+pid+"' class = 'row-total' value = '0'><span> &#8369; </span> &nbsp; <span id = 'rowTotal-"+pid+"' class = 'rowTotal'>"+this.price_tot+"</span></td><td class = 'table-input'></td></tr>"
                    $('#itemRows').append(dat);
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
    $('#sortable').on('click', '.btn_view', function(){
        clearTb();
        var id = this.value;
        view(id)
        $('#view').css("display", "flex");
        $('#view').show();
    });
})

</script>
<?php 
    include('includes/foot.php');
?>

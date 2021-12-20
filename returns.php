<?php
    include('includes/navs.php');
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>Returns</h2>
                <div class="crud-buttons">
                    <button onclick = "location.href = 'add_returns.php'" class = "btn blue" id = "add_btn">Add</button>
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
                        <td id = 'id-h'>ID</td>
                        <td id = 'transac-h'>Transaction No.</td>
                        <td id = 'item-h'>Items Total</td>
                        <td id = 'price-h'>Total Price</td>
                        <td id = 'mark-h'>Remarks</td>
                        <td id = 'date-h'>Return Date</td>
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
<div class="input-container">
        <div class="title-box"><div class="title">View Returns (Customer)</div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <input type = 'hidden' value ='0' id = 'counter'>
                <div class="extra-details">
                    <div class="input-box">
                        <span class="label">OR Number</span>
                        <input type = "text" id="transaction_id-v" autocomplete="off" style ="width:100%" disabled = "disabled" required>
                    </div>
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
                        <input type="text" placeholder="Return reference #" value ='1' id = 'return_id' disabled = "disabled" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Date</span>
                        <input type="date" id = 'transaction_date' required disabled = "disabled">
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
                        &#8369; <input type = 'hidden' id = 'gTotal' value ='0'><span class="grand-total" id = "grandTotal">0.00</span>
                    </div>
                    <div class="input-box">
                        <span class="label">Warehouse</span>
                        <input type = "text" id="warehouse_code-v" autocomplete="off" style ="width:100%" disabled = "disabled" required>
                    </div>
                    <div class="input-box">
                        <span class="label">Remarks</span>
                        <textarea class = "desc" id = 'descr' maxlength="250" placeholder="Extra Details here" disabled = "disabled"></textarea>
                    </div>
                </div>
                </div>
            </form>
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
        var f_id = 1;
        var f_transac = 1;
        var f_item = 1;
        var f_price = 1;
        var f_mark = 1;
        var f_date = 1;
        $("#id-h").click(function(){
            f_id *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_id,n);
        });
        $("#transac-h").click(function(){
            f_transac *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_transac,n);
        });
        $("#item-h").click(function(){
            f_item *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_item,n);
        });
        $("#price-h").click(function(){
            f_price *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_price,n);
        });
        $("#mark-h").click(function(){
            f_mark *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_mark,n);
        });
        $("#date-h").click(function(){
            f_date *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_date,n);
        });
    function loadData(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/load_data.php",
            data: {
                'func':"returns"
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
                'func': "return-1",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#transaction_id-v').val(data.transaction_no);
                $('#return_id').val(data.return_id);
                $('#transaction_date').val(data.return_date);
                $('#grandTotal').html(data.total_price);
                $('#warehouse_code-v').val(data.warehouse_code);
                $('#descr').val(data.remarks);
                $('#c_name').html(data.warehouse_name);
                $('#c_add').html(data.warehouse_address);
                $('#c_cont').html(data.contact_no);
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
                'func': "return-2",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $.each(data, function(cvalue){
                    var dat = "<tr id='ppid-"+cvalue+"'><td class = 'table-input' colspan='4'><input type = 'text' id = 'sel-product-code_"+cvalue+"' class='sel-product_code' value = '"+this.product_code+"' autocomplete='off' style = 'width:100%' disabled = 'disabled'></td></tr><tr id='wpid-"+cvalue+"'><td class = 'table-input' colspan='4'><input type = 'text' id = 'ret-"+cvalue+"' class='return_type' autocomplete='off' value = '"+this.return_type+"' style = 'width:100%' disabled = 'disabled'></td></tr><tr id ='row-"+cvalue+"'><td class = 'table-input'><input type='number' min ='0' placeholder ='0' value = '1' max = '"+this.quantity+"' id='amount_"+cvalue+"' class = 'qty' required disabled = 'disabled'></td><td class = 'table-input'><span class='unit'> &#8369; </span><input type='text' min ='0' placeholder = '0' id='price_"+cvalue+"' class = 'price_ea' value = '"+this.item_price+"' disabled = 'disbaled' required></td><td class = 'table-input'><input type = 'hidden' class = 'pdIn' id='pid-"+cvalue+"'><p> &#8369;<input type = 'hidden' id = 'rowTot"+cvalue+"' class = 'row-total' value = '"+this.price_total+"'><span id = 'rowTotal-"+cvalue+"' class = 'rowTotal'>"+this.price_total+"</span></td></tr>";
                    $('#itemRows').append(dat);
                });
            },
            error: function(data){
                alert(ayaw);
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
        view(id);
        $('#view').css("display", "flex");
        $('#view').show();
    });
})
</script>
<?php 
    include('includes/foot.php');
?>

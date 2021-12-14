<?php
    include('includes/navs.php');
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>Sales</h2>
                <div class="crud-buttons">
                    <button onclick = "location.href = 'add_sales.php'" class = "btn blue" id = "add_btn">Add</button>
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
                        <td id = 'name-h'>Name</td>
                        <td id = 'price-h'>Quantity</td>
                        <td id = 'payment-h'>Total Price</td>
                        <td id = 'employee-h'>Employee</td>
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
        <div class="title-box"><div class="title">View Sales Record</div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <div class="extra-details">
                <input type="hidden" value="0" id="counter">
                    <div class="input-box">
                        <span class="label">Customer</span>
                        <input type = "text" id="customer_id-v" autocomplete="off" style = "width:100%" disabled = "disabled" required>
                    </div>
                    <div class="selection-details">
                        <div>Address: <span id = "c_add"></span></div>
                        <div>Contact: <span id = "c_cont"> </span></div>
                    </div>
                </div>
                <div class="input-details">
                    <div class="input-box">
                        <span class="label">OR Number</span>
                        <input type="text" id = 'transaction_no' placeholder="OR Number" required disabled = "disabled">
                    </div>
                    <div class="input-box">
                        <span class="label">Transaction Date</span>
                        <input type="date" id = 'transaction_date' required disabled = "disabled">
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
                        <textarea class = "desc" maxlength="250" placeholder="Extra Details here" id = 'remark' disabled = "disabled"></textarea>
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
        var f_code = 1;
        var f_date = 1;
        var f_name = 1;
        var f_price = 1;
        var f_payment = 1;
        var f_employee = 1;
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
        $("#name-h").click(function(){
            f_name *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_name,n);
        });
        $("#price-h").click(function(){
            f_price *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_price,n);
        });
        $("#payment-h").click(function(){
            f_payment *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_payment,n);
        });
        $("#employee-h").click(function(){
            f_employee *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_employee,n);
        });
    function loadData(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/load_data.php",
            data: {
                'func':"sales"
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
                'func': "sales",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#customer_id-v').val(data.c_name);
                $('#transaction_no').val(data.transaction_no);
                $('#transaction_date').val(data.transaction_date);
                $('#grandTotal').html(data.total_price);
                $('#remark').val(data.remarks);
                $('#c_add').html(data.c_address);
                $('#c_cont').html(data.contact_number);
                viewTable(id);
            },
            error: function(data){
                alert(ayaw);
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
                'func': "sales-1",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $.each(data, function(pid){
                    var data = "<tr id='ppid-"+pid+"'><td class = 'table-input' colspan='4'><input type = 'text' id = 'sel-product_code_"+pid+"' class='sel-product_code' autocomplete='off' value = '"+this.product_code+"'style = 'width:100%' disabled='disabled'></td></tr><tr id = 'rpid-"+pid+"'><td class = 'table-input'><input type='hidden' id='alert-'" + pid + "' value=''><input type='number' id='amount_"+pid+"' value = '"+this.quantity+"' min ='0' placeholder ='0' class = 'qty' required disabled='disabled'></td><td class = 'table-input'><span class='unit'> &#8369; </span><input type='number' min ='0' placeholder = '"+ this.price_ea + "' id='price_"+pid+"' class = 'price_ea' value='"+ this.price_ea + "' required disabled='disabled'></td><td class = 'table-input'><input type = 'hidden' class = 'pdIn' id='pid-"+pid+"' value ='"+pid+"'><input type = 'hidden' id = 'rowTot"+pid+"' class = 'row-total' value = '0'><span> &#8369; </span> &nbsp; <span id = 'rowTotal-"+pid+"' class = 'rowTotal'>"+this.price_tot+"</span></td><td class = 'table-input'></td></tr>"
                    $('#itemRows').append(data);
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
        view(id)
        $('#view').css("display", "flex");
        $('#view').show();
        return false;
    });
})
</script>
<?php 
    include('includes/foot.php');
?>

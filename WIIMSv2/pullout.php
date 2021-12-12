<?php
    include('includes/navs.php');
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>Item Returns (Supplier) </h2>
                <div class="crud-buttons">
                    <button onclick = "location.href = 'add_pullout.php'" class = "btn blue" id = "add_btn">Add</button>
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
                        <td id = 'item-h'>Total Items</td>
                        <td id = 'value-h'>Total Value</td>
                        <td id = 'date-h'>Date</td>
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
            <div class="table-info">
                Total rows: 9999
            </div>
        </div>
    </div>
</div>
<div id = "view" class = "modal">
<div class="input-container">
        <div class="title-box"><div class="title">Pullout View</div><div class="close-div"><a href="#" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <input type = 'hidden' value ='0' id = 'counter'>
                <div class="input-details">
                    <div class="input-box">
                        <span class="label">Pullout Reference #</span>
                        <input type="text" placeholder="Return reference #" value ='1' id = 'pullout_id' required disabled = "disabled">
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
                        Php <input type = 'hidden' id = 'gTotal' value ='0'><span class="grand-total" id = "grandTotal">0.00</span>
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
        var f_item = 1;
        var f_value = 1;
        var f_date = 1;
        $("#id-h").click(function(){
            f_id *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_id,n);
        });
        $("#item-h").click(function(){
            f_item *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_item,n);
        });
        $("#value-h").click(function(){
            f_value *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_value,n);
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
            'func':"pullout"
        },                             
        success: function(response){                    
            $("#table-data").html(response); 
        },
        error: function(){
            alert("Something went wrong");
        }
    });
    function view(id){
        var id = id;   
        var cvalue = $('#counter').val();
        $.ajax({
            method: "POST",
            url: "includes/functions/auto_inputs.php",
            cache:false,
            async: false,
            data: {
                'func': "pullout-1",
                'edit_id':id
            },
            dataType:"json",
            success: function(data) {
                $('#pullout_id').val(data.pullout_id);
                $('#transaction_date').val(data.date);
                $('#grandTotal').html(data.total_price);
                $('#descr').val(data.remarks);
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
            dataType: 'JSON',
            data: {
                'func': "pullout-2",
                'edit_id':id
            },
            success: function(data) {
                $.each(data, function(pid){
                    
                    var dat = "<tr id='ppid-"+pid+"'><td class = 'table-input' colspan='4'><input type = 'text' id = 'sel-product-code_"+pid+"' class='sel-product_code' autocomplete='off' value = '"+this.product_code+"' style = 'width:100%' disabled = 'disabled' required></td></tr><tr id='rpid-"+pid+"'><td class = 'table-input' colspan='4'><input type = 'text' id = 'ret-"+pid+"' class='return_type' value = '"+this.return_type+"' autocomplete='off' style = 'width:100%' disabled = 'disabled' required></td></tr><tr id ='row-"+pid+"'><td class = 'table-input'><input type='number' min ='0' placeholder ='0' value = '"+this.quantity+"' max = '"+this.quantity+"' id='amount_"+pid+"' class = 'qty' disabled = 'disabled' required></td><td class = 'table-input'><input type='number' min ='0' placeholder = '0'  id='price_"+pid+"' class = 'price_ea' value = '"+this.item_price+"' disabled = 'disbaled' required></td><td class = 'table-input'><input type = 'hidden' class = 'pdIn' id='pid-"+pid+"' disabled = 'disabled'><input type = 'hidden' id = 'rowTot"+pid+"' class = 'row-total' value = '"+this.price_total+"' disabled = 'disabled'><span id = 'rowTotal-"+pid+"' class = 'rowTotal'>"+this.price_total+"</span></td><td class = 'table-input'>"

                    pid+1;
  
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
}
</script>
<?php 
    include('includes/foot.php');
?>
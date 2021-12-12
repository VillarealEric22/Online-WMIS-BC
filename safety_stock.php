<?php
    include('includes/navs.php');
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>Safety Stock and Reorder Point</h2>
                <div class="crud-buttons">
                    <button class = "btn modalbtn blue" id = "add_btn"><a href = "#ppi">Generate</a></button>
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
                        <td id = 'code'>Product Code</td>
                        <td id = 'sold'>Max Daily Usage</td>
                        <td id = 'ip'>Average Daily Usage</td>
                        <td id = 'qty'>Max Lead Time</td>                   
                        <td id = 'sales'>Average Lead Time</td>         
                        <td id = 'op'>Safety Stock</td>
                        <td id = 'or'>Reorder Point</td>
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
            </div>
        </div>
    </div>
</div>
<div id="ppi" class="modal">
        <!-- Modal content -->
    <div class="input-container">
        <div class="title-box"><div class="title"><span id = 'action'> Generate </span> Report </div><div class="close-div"><a href="#product" class = "link-2 close"></a></button></div></div>
        <div class="content">
            <form action="#">
                <input type = 'hidden' id = 'id' value = ''>
                <div class="extra-details">
                    <div class="input-box">
                        <span class="label">Date Range</span>
                        <input type="text" id = "date_range" class = "pull-right">
                    </div>
                </div>
                <div class="action-button">
                    <button formnovalidate="formnovalidate" class = "btn-cancel">Cancel</button>
                    <input type="submit" id = "generate" value="Generate"/>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>  

<script>
    $(document).ready(function(){
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
        var f_qty = 1;
        var f_sold = 1;
        var f_sales = 1;
        var f_ip = 1;
        var f_op = 1;
        var f_or = 1;
        var f_sell = 1;
        $("#code").click(function(){
            f_code *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_code,n);
        });
        $("#sold").click(function(){
            f_sold *= -1;DS
            var n = $(this).prevAll().length;
            sortTable(f_sold,n);
        });
        $("#ip").click(function(){
            f_ip *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_ip,n);
        });
        $("#qty").click(function(){
            f_qty *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_qty,n);
        });
        $("#sales").click(function(){
            f_sales *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_sales,n);
        });
        $("#op").click(function(){
            f_op *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_op,n);
        });
        $("#or").click(function(){
            f_or *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_or,n);
        });
        
        $("#generate").click(function(e){
            e.preventDefault();
            var from = $('#date_range').data('daterangepicker').startDate.format("YYYY/MM/DD");
            var to = $('#date_range').data('daterangepicker').endDate.format("YYYY/MM/DD");

            $.ajax({    //create an ajax request to display.php
                type: "POST",
                url: "includes/functions/reportscript.php",
                data: {
                    'func':"safety",
                    'from':from,
                    'to':to,
                },                             
                success: function(data){                    
                    $('#ppi').hide();
                    $('#table-data').html(data);
                },
                error: function(){
                    alert("Something went wrong");
                }
            });
        });
    });
</script>
<?php 
    include('includes/foot.php');
?>
<?php
    include('includes/navs.php');
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>Warehouse Items</h2>
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
                        <td id = 'name-h'>Product Name</td>
                        <td id = 'qty-h'>Available Qty.</td>
                        <td id = 'committed-h'>Committed</td>
                        <td id = 'warehouse-h'>Warehouse</td>
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
        var f_name = 1;
        var f_qty = 1;
        var f_committed = 1;
        var f_warehouse = 1;
        $("#code-h").click(function(){
            f_code *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_code,n);
        });
        $("#name-h").click(function(){
            f_name *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_name,n);
        });
        $("#qty-h").click(function(){
            f_qty *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_qty,n);
        });
        $("#committed-h").click(function(){
            f_committed *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_committed,n);
        });
        $("#warehouse-h").click(function(){
            f_warehouse *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_warehouse,n);
        });
    function loadData(){
        $.ajax({    //create an ajax request to display
            type: "POST",
            url: "includes/functions/load_data.php",
            data: {
                'func':"wh_items"
            },                             
            success: function(response){                    
                $("#table-data").html(response); 
                
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    }
})
</script>
<?php 
    include('includes/foot.php');
?>

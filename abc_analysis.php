<?php
    include('includes/navs.php');
?>
<div class = "details-tb">
    <div class = "table-view">
        <div class="function-row">
            <div class = "cardHeader">
                <h2>ABC Analysis</h2>
                <div class="crud-buttons">
                    <button class = "btn modalbtn blue" id = "add_btn"><a href = "#abc">Generate</a></button>
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
                        <td id = 'product-h'>Products</td>
                        <td id = 'sold-h'>Item Sold</td>
                        <td id = 'consump'>Consumption</td>
                        <td id = 'svol'>Sales Volume</td>
                        <td id = 'cvol'>Consumption Volume</td>
                        <td id = 'class'>Class</td>
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
    <div class="table-view">
        <canvas id="bar_chart" style="width:100%;"></canvas>
    </div>
</div>
<div id="abc" class="modal">
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
        var f_product = 1;
        var f_sold = 1;
        var f_consump = 1;
        var f_svol = 1;
        var f_cvol = 1;
        var f_class = 1;
        $("#product-h").click(function(){
            f_product *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_product,n);
        });
        $("#sold-h").click(function(){
            f_sold *= -1;DS
            var n = $(this).prevAll().length;
            sortTable(f_sold,n);
        });
        $("#consump").click(function(){
            f_consump *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_consump,n);
        });
        $("#svol").click(function(){
            f_svol *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_svol,n);
        });
        $("#cvol").click(function(){
            f_cvol *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_cvol,n);
        });
        $("#class").click(function(){
            f_class *= -1;
            var n = $(this).prevAll().length;
            sortTable(f_class,n);
        });
        $("#generate").click(function(e){
            e.preventDefault();
            var from = $('#date_range').data('daterangepicker').startDate.format("YYYY/MM/DD");
            var to = $('#date_range').data('daterangepicker').endDate.format("YYYY/MM/DD");

            if($('#generate').val().toString() == "Generate"){
                $.ajax({    //create an ajax request to display.php
                    type: "POST",
                    url: "includes/functions/reportscript.php",
                    data: {
                        'func':"pareto",
                        'from':from,
                        'to':to,
                    },                             
                    success: function(data){                    
                        $('#abc').hide();
                        $('#table-data').html(data);
                        makeChart();
                    },
                    error: function(){
                        alert("Something went wrong");
                    }
                });
            }
            else if($('#generate').val().toString() == "Create PDF"){
                $.ajax({    //create an ajax request to display.php
                    type: "POST",
                    url: "includes/functions/reportscript.php",
                    data: {
                        'func':"download-abc",
                        'from':from,
                        'to':to,
                    },                             
                    success: function(data){                    
                        
                    },
                    error: function(){
                        alert("Something went wrong");
                    }
                });
            }
            
        });
        $("#create_btn").click(function(e){
            $('#generate').val("Create PDF");
            
        });
        $("#add_btn").click(function(e){
            $('#generate').val("Generate");
            
        });
        function makeChart(){

            var from = $('#date_range').data('daterangepicker').startDate.format("YYYY/MM/DD");
            var to = $('#date_range').data('daterangepicker').endDate.format("YYYY/MM/DD");

            $.ajax({
                type: "POST",
                url: "includes/functions/reportscript.php",
                data: {
                    'func':"pareto_graph",
                    'from':from,
                    'to':to,
                },
                dataType:'JSON',                             
                success: function(data){                    
                    
                    var product = [];
                    var sales_vol = [];
                    var color = [];

                    for(var count = 0; count < data.length; count++){
                        product.push(data[count].products);
                        sales_vol.push(data[count].sales_vol);
                        color.push(data[count].color);
                    }
                    var chart_data = {
                        labels: product,
                        datasets:[
                            {
                                label: 'Sales Volume',
                                backgroundColor: color,
                                color:'#fff',
                                data:sales_vol
                            }
                        ]
                    };
                    var chart = $('#bar_chart');
                    var graph = new Chart(chart, {
                        type:"bar",
                        data: chart_data
                    });
                },
                error: function(){
                    alert(data);
                }
            });       
        }
    });
</script>
<?php 
    include('includes/foot.php');
?>

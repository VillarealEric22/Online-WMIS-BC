<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
<main>
    <div class="main-containter">
        <div class="sales">
            <div class="card">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-cash-register"></span>
                        Sales
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addSalesModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
                            <button href = "#editSalesModal" class = "modalBtn btn-success" > Edit <span class="las la-edit"></span></button>
                            <button href = "#deleteSalesModal" class = "modalBtn btn-danger"> Delete <span class="las la-trash"></span></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="row">
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
                                <label> Search: <input type="search" placeholder=""/></label> 
                            </div>
                        </div>
                        <div class="row">
                            <table id="sortable" class="table" width = "100%">
                                <thead>
                                    <tr>
                                        <td>Transaction ID</td>
                                        <td>Customer ID</td>
                                        <td>Product Code</td>
                                        <td>Item Price</td>
                                        <td>Quantity</td>
                                        <td>Total Price</td>
                                        <td>Transaction Date</td>
                                    </tr>
                                </thead>
                                <tbody class="tablecontent">
                                    <!--display to table-->
                                </tbody>
                            </table>
                        </div>
                        <div class="row-no-margin">
                            <div class="table-pagination">
                                <ul class = pagination>
                                    
                                </ul>
                            </div>
                            <div class="table-info"></div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <!--add modal-->
    <div id = "addSalesModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "transactionID">Transaction ID:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="pcode" name = "pcode">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "pname">Customer:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="pname" name = "pname">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "items">Items:</label>
                            </div>
                            <div class="input">
                                <div class="itemdiv">
                                <div>
                                    <div class="input">
                                        <label>Product Name </label><input type ="text" id="pname" name = "pname">
                                    </div>
                                         
                                    <div class="input">
                                        <label>Qty.</label><input type ="text" id="qty" nmae = "qty">
                                    </div>
                                         
                                    <div class="input">
                                        <label>Price</label><input type ="text" id="qty" nmae = "qty">
                                    </div>
                                    <div class="addrow"><a href="javascript:void(0);" class="addItem" title="Add field">add</a></div>
                                </div>
                                </div>
                            </div>  
                        </div>                        
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "price">Price:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="price" nmae = "price">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "color">Transaction Date:</label>
                            </div>
                            <div class="input">
                                <input type="date" id="transactiondate" name="transactiondate">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <a class="btn-confirm" href="">Confirm</a>
                </div>
            </div>
        </div>
    </div>
    <!--add modal end-->
</main>
<script type="text/javascript">
        $(document).ready(function () {
            $(".items").hide(); 
            $(".show").click(function() {
                $(this).closest('tr').nextUntil("tr:has(.show)").toggle("fast" ,function() {});     
            });
        })
        $(document).ready(function(){
            var addButton = $('.addItem'); //Add button selector
            var wrapper = $('.itemdiv'); //Input field wrapper
            var fieldHTML = '<div><div class="input"><label>Product Name </label><input type ="text" id="pname" name = "pname"></div><div class="input"><label>Qty.</label><input type ="text" id="qty" nmae = "qty"></div><div class="input"><label>Price</label><input type ="text" id="qty" nmae = "qty"></div><a href="javascript:void(0);" class="remove_button">remove</a></div>'; //New input field html 
            
            //Once add button is clicked
            $(addButton).click(function(){
                    $(wrapper).append(fieldHTML); //Add field html
            });
            
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
            });
        });
    </script>
<?php 
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>
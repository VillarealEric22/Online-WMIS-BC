<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
<main>
    <div class="main-containter">
        <div class="products">
            <div class="card">
                <div class="card-header">
                    <h2>     
                        <span class = "las la-boxes"></span>
                            <Select name="tableName" id="tbName" onchange="location.href=this.value">
                                <option value = "Packages.php"> Packages </option>
                                <option value = "Products.php"> Products </option>
                            </Select>
                    </h2>
                    <div class="CRUDbuttons">
                            <button href = "#addProductModal" class = "modalBtn btn-add"> Add <span class="las la-plus"></span></button>
                            <button href = "#editProductModal" class = "modalBtn btn-success" > Edit <span class="las la-edit"></span></button>
                            <button href = "#deleteProductModal" class = "modalBtn btn-danger"> Delete <span class="las la-trash"></span></button>
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
                                        <td>Package ID</td>
                                        <td>Product Code</td>
                                        <td>Quantity</td>
                                        <td>Package Price</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a class="show" href="#">Cake Package A</a></td>
                                        <td></td>
                                        <td></td>
                                        <td>99999</td>
                                    </tr>
                                    <tr class="items">
                                        <!--child row-->
                                        <td></td>
                                        <td>Oven</td>
                                        <td>3</td>
                                        <td></td>
                                    </tr>
                                    <tr class="items">
                                        <!--child row-->
                                        <td></td>
                                        <td>Plancha</td>
                                        <td>3</td>
                                        <td></td>
                                    </tr>
                                    <tr class="items">
                                        <!--child row-->
                                        <td></td>
                                        <td>Tray</td>
                                        <td>3</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><a class="show" href="#">Cake Package B</a></td>
                                        <td></td>
                                        <td></td>
                                        <td>99999</td>
                                    </tr>
                                    <tr class="items">
                                        <!--child row-->
                                        <td></td>
                                        <td>Oven</td>
                                        <td>1</td>
                                        <td></td>
                                    </tr>
                                    <tr class="items">
                                        <!--child row-->
                                        <td></td>
                                        <td>Plancha</td>
                                        <td>124</td>
                                        <td></td>
                                    </tr>
                                    <tr class="items">
                                        <!--child row-->
                                        <td></td>
                                        <td>Tray</td>
                                        <td>2</td>
                                        <td></td>
                                    </tr>
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
    <div id = "addProductModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form method = "post">
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addpkgname">Package Name:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addpkgname" name = "addpkgname">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "items">Items:</label>
                            </div>
                            <div class="input">
                                <div class="itemdiv">
                                <div>
                                    <div class="input-label">
                                        <label>Product Name </label>
                                    </div>
                                    <div class="input">
                                        <input type ="text" id="pkgaddpname" name = "pkgaddpname">
                                    </div>
                                    <div class="input-label">
                                        <label>Qty.</label> 
                                    </div>
                                    <div class="input">
                                        <input type ="text" id="pkgaddqty" nmae = "pkgaddqty">
                                    </div>
                                    <div class="addrow"><a href="javascript:void(0);" class="addItem" title="Add field">add</a></div>
                                </div>
                                </div>
                            </div>  
                        </div>    
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "pkgaddprice">Package Price:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="pkgaddprice" name = "pkgaddprice">
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
    <!--edit modal-->
    <div id = "editProductModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class = "modal-body">
                <form>
                    
                </form>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <a class="btn-confirm" href="">Confirm</a>
                </div>
            </div>
        </div>
    </div>
    <!--edit modal end-->
    <!--delete modal-->
    <div id = "deleteProductModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Item</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="modal-message">
                        Are you sure to delete item? This action is irreversible.
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <a class="btn-confirm" href="">Confirm</a>
                </div>
            </div>
        </div>
    </div>
    <!--delete modal end-->
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
            var fieldHTML = '<div><div class="input-label"><label>Product Name </label></div><div class="input"><input type ="text" id="pkgaddpname" name = "pkgaddpname"></div><div class="input-label"><label>Qty.</label></div><div class="input"><input type ="text" id="pkgaddqty" nmae = "pkgaddqty"></div><a href="javascript:void(0);" class="remove_button">remove</a></div>'; //New input field html 
            
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

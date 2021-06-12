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
                                        <td>Discount Code</td>
                                        <td>Total Price</td>
                                        <td>Transaction Date</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>00001</td>
                                        <td>00001</td>
                                        <td>100TG-Oven-Green</td>
                                        <td>99999</td>
                                        <td>2</td>
                                        <td>N/A</td>
                                        <td>199998</td>
                                        <td>01/20/21</td>
                                    </tr>
                                    <tr>
                                        <td>00001</td>
                                        <td>00001</td>
                                        <td>100TG-Oven-Green</td>
                                        <td>99999</td>
                                        <td>2</td>
                                        <td>N/A</td>
                                        <td>199998</td>
                                        <td>01/20/21</td>
                                    </tr>
                                    <tr>
                                        <td>00001</td>
                                        <td>00001</td>
                                        <td>100TG-Oven-Green</td>
                                        <td>99999</td>
                                        <td>2</td>
                                        <td>N/A</td>
                                        <td>199998</td>
                                        <td>01/20/21</td>
                                    </tr>
                                    <tr>
                                        <td>00001</td>
                                        <td>00001</td>
                                        <td>100TG-Oven-Green</td>
                                        <td>99999</td>
                                        <td>2</td>
                                        <td>N/A</td>
                                        <td>199998</td>
                                        <td>01/20/21</td>
                                    </tr>
                                    <tr>
                                        <td>00001</td>
                                        <td>00001</td>
                                        <td>100TG-Oven-Green</td>
                                        <td>99999</td>
                                        <td>2</td>
                                        <td>N/A</td>
                                        <td>199998</td>
                                        <td>01/20/21</td>
                                    </tr>
                                    <tr>
                                        <td>00001</td>
                                        <td>00001</td>
                                        <td>100TG-Oven-Green</td>
                                        <td>99999</td>
                                        <td>2</td>
                                        <td>N/A</td>
                                        <td>199998</td>
                                        <td>01/20/21</td>
                                    </tr>
                                    <tr>
                                        <td>00001</td>
                                        <td>00001</td>
                                        <td>100TG-Oven-Green</td>
                                        <td>99999</td>
                                        <td>2</td>
                                        <td>N/A</td>
                                        <td>199998</td>
                                        <td>01/20/21</td>
                                    </tr>
                                    <tr>
                                        <td>00001</td>
                                        <td>00001</td>
                                        <td>100TG-Oven-Green</td>
                                        <td>99999</td>
                                        <td>2</td>
                                        <td>N/A</td>
                                        <td>199998</td>
                                        <td>01/20/21</td>
                                    </tr>
                                    <tr>
                                        <td>00001</td>
                                        <td>00001</td>
                                        <td>100TG-Oven-Green</td>
                                        <td>99999</td>
                                        <td>2</td>
                                        <td>N/A</td>
                                        <td>199998</td>
                                        <td>01/20/21</td>
                                    </tr>
                                    <tr>
                                        <td>00001</td>
                                        <td>00001</td>
                                        <td>100TG-Oven-Green</td>
                                        <td>99999</td>
                                        <td>2</td>
                                        <td>N/A</td>
                                        <td>199998</td>
                                        <td>01/20/21</td>
                                    </tr>
                                    <tr>
                                        <td>00001</td>
                                        <td>00001</td>
                                        <td>100TG-Oven-Green</td>
                                        <td>99999</td>
                                        <td>2</td>
                                        <td>N/A</td>
                                        <td>199998</td>
                                        <td>01/20/21</td>
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
                                <label class = modal-form-label for = "pcode">Product Code:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="pcode" name = "pcode">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "pname">Name:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="pname" name = "pname">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="manufacturer">Manufacturer:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="manufacturer" name = "manufacturer">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "ptype">Product Type:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="ptype" name = "ptype"> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "capacity">Capacity:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="capacity" name = "capacity"> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "color">Color:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="color" name = "color">
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
    <div id = "editSalesModal" class="modal fade">
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
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "pcode">Product Code:</label>
                        </div>
                        <div class="input">
                            <input type="text" id="pcode" name = "pcode">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "pname">Name:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="pname" name = "pname">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for ="manufacturer">Manufacturer:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="manufacturer" name = "manufacturer">
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "ptype">Product Type:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="ptype" name = "ptype"> 
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "capacity">Capacity:</label>
                        </div>                              
                        <div class="input">                               
                            <input type ="text" id="capacity" name = "capacity"> 
                        </div>
                    </div>
                    <div class="input-row">
                        <div class="input-label">
                            <label class = modal-form-label for = "color">Color:</label>
                        </div>
                        <div class="input">
                            <input type ="text" id="color" name = "color">
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
    <div id = "deleteSalesModal" class="modal fade">
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
<?php 
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>
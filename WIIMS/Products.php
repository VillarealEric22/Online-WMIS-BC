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
                                    <option value = "Products.php" > Products </option>
                                    <option value = "Packages.php" > Packages </option>
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
                                        <td>Product Code</td>
                                        <td>Name</td>
                                        <td>Manufacturer</td>
                                        <td>Product Type</td>
                                        <td>Capacity</td>
                                        <td>Color</td>
                                        <td>Price</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        //connection info.
                                        $DATABASE_HOST = 'localhost';
                                        $DATABASE_USER = 'root';
                                        $DATABASE_PASS = '';
                                        $DATABASE_NAME = 'db_inventory';
                                        //connect using data above.
                                        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
                                        if ( mysqli_connect_errno() ) {
                                            // If there is an error with the connection, stop the script and display the error.
                                            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
                                        }
                                        $sql = "SELECT products.product_code, products.product_name, products.manufacturer, products.product_type, products.capacity, products.color, products.item_price FROM products";
                                        $result = $con->query($sql) or die($con->error); //or die($con->error) is for debugging of SQL Query
                                            while($rows= $result-> fetch_assoc()){
                                                echo "<tr><td>".$rows['product_code']."</td>";
                                                echo "<td>".$rows['product_name']."</td>";
                                                echo "<td>".$rows['manufacturer']."</td>";
                                                echo "<td>".$rows['product_type']."</td>";
                                                echo "<td>".$rows['capacity']."</td>";
                                                echo "<td>".$rows['color']."</td>";
                                                echo "<td>".$rows['item_price']."</td>";

                                            }
                                            echo "number of rows: " . $result->num_rows;
                                        $con->close();
                                    ?>
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
                    <form>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addptype">Product Type:</label>
                            </div>
                            <div class="input">
                            <Select name="tableName" id="tbName">
                                    <option value = "type 1" > type 1 </option>
                                    <option value = "type 2" > type 2 </option>
                                    <option value = "type 3" > type 3 </option>
                            </Select>
                            <button href = "#productTypeModal" class = "modalBtn"> ... </button>
                            </div>                           
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addproductname">Product Name:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addproductname" name = "addproductname">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addproductcode">Product Code:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="addproductcode" name = "addproductcode">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addcapacity">Capacity:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="addcapacity" name = "addcapacity"> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="addmanufacturer">Manufacturer:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addmanufacturer" name = "addmanufacturer">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addcolor">Color:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addcolor" name = "addcolor">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addprice">Price:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="addprice" name = "addprice">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "adddimensions">Dimensions:</label>
                            </div>
                            <Select name="unitLength" id="unitLength">
                                    <option value = "mm" > mm </option>
                                    <option value = "in" > in </option>
                                    <option value = "cm" > cm </option>
                            </Select>
                            <div class="input">
                                <label>(L)</label>
                                <input type ="text" id="addlength" name = "addlength">
                            </div>
                            <div class="input">
                                <label>(W)</label>
                                <input type ="text" id="addwidth" nmae = "addwidth">
                            </div>
                            <div class="input">
                                <label>(H)</label>
                                <input type ="text" id="addheight" nmae = "addheight">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "addsupplier">Supplier Name:</label>
                            </div>                              
                            <div class="input">                               
                            <Select name="addsuplier" id="addsupplier">
                                    <option value = "Products" > type 1 </option>
                                    <option value = "Packages" > type 2 </option>
                                    <option value = "Packages" > type 3 </option>
                            </Select>
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
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "edittype">Product Type:</label>
                            </div>
                            <div class="input">
                            <Select name="tableName" id="tbName">
                                    <option value = "type 1" > type 1 </option>
                                    <option value = "type 2" > type 2 </option>
                                    <option value = "type 3" > type 3 </option>
                            </Select>
                            <button href = "#productTypeModal" class = "modalBtn"> ... </button>
                            </div>                           
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editproductname">Product Name:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="editproductname" name = "editproductname">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editproductcode">Product Code:</label>
                            </div>
                            <div class="input">
                                <input type="text" id="editproductcode" name = "editproductcode">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editcapacity">Capacity:</label>
                            </div>                              
                            <div class="input">                               
                                <input type ="text" id="editcapacity" name = "editcapacity"> 
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for ="editmanufacturer">Manufacturer:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="editmanufacturer" name = "editmanufacturer">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editcolor">Color:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="editcolor" name = "editcolor">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editprice">Price:</label>
                            </div>
                            <div class="input">
                                <input type ="text" id="editprice" name = "editprice">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editdimensions">Dimensions:</label>
                            </div>
                            <Select name="unitLength" id="unitLength">
                                    <option value = "mm" > mm </option>
                                    <option value = "in" > in </option>
                                    <option value = "cm" > cm </option>
                            </Select>
                            <div class="input">
                                <label>(L)</label>
                                <input type ="text" id="editlength" name = "editlength">
                            </div>
                            <div class="input">
                                <label>(W)</label>
                                <input type ="text" id="editwidth" nmae = "editwidth">
                            </div>
                            <div class="input">
                                <label>(H)</label>
                                <input type ="text" id="editheight" nmae = "editheight">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-label">
                                <label class = modal-form-label for = "editsupplier">Supplier Name:</label>
                            </div>                              
                            <div class="input">                               
                            <Select name="editsuplier" id="editsupplier">
                                    <option value = "Products" > type 1 </option>
                                    <option value = "Packages" > type 2 </option>
                                    <option value = "Packages" > type 3 </option>
                            </Select>
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
    <div id = "productTypeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Product Type</h5>
                    <button class="close" type="button">
                        <span>×</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="modal-message">
                        <table id="ptypeTable" class="modalTable" width = "100%">
                                <thead>
                                    <tr>
                                        <td>Product Type</td>
                                        <td>Description</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input class ="medium-input" type="string"></td>
                                        <td><input class ="medium-input" type="string"></td>
                                        <td><button><span class="las la-plus"></span></button></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Oven</td>
                                        <td class = "description">Oven tol</td>
                                        <td><button><span class="las la-trash"></span></button></td>
                                    </tr>
                                    <tr>
                                        <td>Oven</td>
                                        <td class = "description">Oven tol</td>
                                        <td><button><span class="las la-trash"></span></button></td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-cancel" type="button">Cancel</button>
                    <a class="btn-confirm" href="">Confirm</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>

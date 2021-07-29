<?php 
    include('php/includes/header.php');
    include('php/includes/navbar.php');
?>
    <main>
    <div class="main-containter">
        <div class="products">
            <div class="card">
            <form method="POST">
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
                            <button href = "#editProductModal" class = "modalBtn btn-success" id = "edit_button"> Edit <span class="las la-edit"></span></button>
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
                                <label> Search: <input type="search" placeholder="" id = "searchInput"></label> 
                            </div>
                        </div>
                        <div class="row">
                            <table id="sortable" class="table" width = "100%">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td>Product Code</td>
                                        <td>Name</td>
                                        <td>Manufacturer</td>
                                        <td>Product Type</td>
                                        <td>Capacity</td>
                                        <td>Color</td>
                                        <td>Price</td>
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
            </form>
            </div>  
        </div>
    </div>
        <div class="recent-grid">
            <div class="inventory">
                <div class="card">
                    <div class="card-header">
                        <h2>Inventory</h2>
                        <form action="Inventory.php">
                            <button type="submit">See more <span class="las la-arrow-right"></span></button>
                        </form>
                    </div>
                    <div class="card-body">
                        <canvas id="PieChart" style = "width:100%;max-width:700px"></canvas>
                    </div>
                </div>
            </div>    
        </div>
    </main>
</div>
<?php
    include('php/includes/footer.php');
    include('php/includes/scripts.php');
?>

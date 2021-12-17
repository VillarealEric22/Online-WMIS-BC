function product(cvalue){
    var a = cvalue;
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "product",
        },
        dataType:"json",
        success: function(data){
            $.each(data, function(){
                var insert = "<option class = 'product' value='" + this.product_code + "'>" + this.product_code+ " - " +this.product_name+ "</option>";
                $("#sel-product_code_"+a).append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}

function wh_item_wh(pid){
    var id = pid;
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "wh_item_wh",
            'id':id
        },
        dataType:"json",
        success: function(data) {
            $.each(data, function(){
                var insert = "<option class = 'wh_code' value='" + this.warehouse_code + "'>" + this.warehouse_code + "</option>";
                $('#sel-warehouse-code_'+id).append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}
function supplierItem(cvalue){
    var id = $('#supplier_id').val();
    var a = cvalue;
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "product_s",
            'id':id
        },
        dataType:"json",
        success: function(data){
            $.each(data, function(){
                var insert = "<option class = 'product' value='" + this.product_code + "'>" + this.product_code+ " - " +this.product_name+ "</option>";
                $("#sel-product_code"+a).append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}
function whItem(cvalue){
    var id = $('#warehouse_code').val();
    var a = cvalue;
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "wh_item",
            'id':id
        },
        dataType:"json",
        success: function(data){
            $.each(data, function(){
                var insert = "<option class = 'product' value='" + this.product_code + "'>" + this.product_code+ " - " +this.product_name+ "</option>";
                $("#sel-product-code_"+a).append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}
function categ(){
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "productCategory",
        },
        dataType:"json",
        success: function(data){
            $.each(data, function(){
                var insert = "<option class = 'product_type' value='" + this.id + "'>" + this.product_type + "</option>";
                $("#product_type").append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}
function categ2(){
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "productCategory",
        },
        dataType:"json",
        success: function(data){
            $.each(data, function(){
                var insert = "<option class = 'product_type' value='" + this.id + "'>" + this.product_type + "</option>";
                $("#product_type-s").append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}
function warranty(){
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "warrantyCode",
        },
        dataType:"json",
        success: function(data) {
            $.each(data, function(){
                var insert = "<option class = 'warranty' value='" + this.id + "'>" + this.warranty_code + "</option>";
                $("#warranty_code").append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}
function supplier(){
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "supplier",
        },
        dataType:"json",
        success: function(data) {
            $.each(data, function(){
                var insert = "<option class = 'supplier' value='" + this.supplier_id + "'>" + this.supplier_name + "</option>";
                $("#supplier_id").append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}
function pullout_pid(){
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "order_no",
        },
        dataType:"json",
        success: function(data) {
            $.each(data, function(){
                var insert = "<option class = 'po_id' value='" + this.purchase_order_id + "'>" + this.purchase_order_id + "</option>";
                $("#purchase_id").append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}
function customer(){
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "customer",
        },
        dataType:"json",
        success: function(data) {
            $.each(data, function(){
                var insert = "<option class = 'customer' value='" + this.customer_id + "'>" + this.c_name + "</option>";
                $("#customer_id").append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}
function inventoryOR(){
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "inventory",
        },
        dataType:"json",
        success: function(data) {
            $.each(data, function(){
                var insert = "<option class = 'inv-or' value='" + this.purchase_order_id + "'>" + this.purchase_order_id + "</option>";
                $("#purchase_id").append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}
function returnOR(){
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "transaction_no",
        },
        dataType:"json",
        success: function(data) {
            $.each(data, function(){
                var insert = "<option class = 't_no' value='" + this.transaction_no+ "'>" + this.transaction_no + "</option>";
                $("#transaction_id").append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    });
}

function warehouseCode(cvalue){
    var a = cvalue;
    var item = $('#sel-product-code_'+a).val();
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "warehouse_pull",
            'product':item,
        },
        dataType:"json",
        success: function(data) {
            $.each(data, function(){
                var insert = "<option class = 'wh_code' value='" + this.warehouse_code + "'>" + this.warehouse_name + "</option>";
                $('#sel-warehouse-code_'+a).append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}
function warehouseCode2(){
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "warehouse_code",
        },
        dataType:"json",
        success: function(data) {
            $.each(data, function(){
                var insert = "<option class = 'wh_code' value='" + this.warehouse_code + "'>" + this.warehouse_name + "</option>";
                $('#warehouse_code').append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}
function whManager(){
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "manager",
        },
        dataType:"json",
        success: function(data) {
            $.each(data, function(){
                var insert = "<option class = 'uname' value='" + this.employee_id + "'>" + this.employee + "</option>";
                $('#whmanager').append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}
function emp(){
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "employee",
        },
        dataType:"json",
        success: function(data) {
            $.each(data, function(){
                var insert = "<option class = 'e_id' value='" + this.employee_id + "'>"+ this.employee + "</option>";
                $('#employee_id').append(insert);
            })
        },
        error: function(data){
            alert(data);
        }
    }); 
}
function transfer(){
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "transfer",
        },
        dataType:"json",
        success: function(data) {
            $.each(data, function(){
                var insert = "<option class = 'transfer-id' value='" + this.transfer_id + "'>"+ this.transfer_id + "</option>";
                $('#transfer_id').append(insert);
            })
        },
        error: function(){
            alert("error");
        }
    }); 
}
function transfer_wh(id){
    var vid = id;
    $.ajax({
        method: "POST",
        url: "includes/functions/populate_sources.php",
        cache: false,
        async: false,
        data: {
            'func': "transfer-dest",
            'id': vid
        },
        dataType:"json",
        success: function(data) {
            $.each(data, function(){
                var insert = "<option class = 'wh-dest' value='" + this.warehouse_dest + "'>"+ this.warehouse_dest + "</option>";
                $('#warehouse_dest').append(insert);
            })
        },
        error: function(){
            alert("error");
        }
    }); 
    
}

function id_order(){         
    $.ajax({
        method: "POST",
        url: "includes/functions/auto_inputs.php",
        cache:false,
        async: false,
        data: {
            'func': "order-id",
        },
        dataType:"json",
        success: function(data) {
            $('#purchase_order_id').val(data.id);
        },
        error: function(data){
            alert(data);
        }
    });
}
function id_inventory(){         
    $.ajax({
        method: "POST",
        url: "includes/functions/auto_inputs.php",
        cache:false,
        async: false,
        data: {
            'func': "inventory-id",
        },
        dataType:"json",
        success: function(data) {
            $('#inventory_id').val(data.id);
        },
        error: function(data){
            alert(data);
        }
    });
}
function id_transfer(){         
    $.ajax({
        method: "POST",
        url: "includes/functions/auto_inputs.php",
        cache:false,
        async: false,
        data: {
            'func': "transfer-id",
        },
        dataType:"json",
        success: function(data) {
            $('#transfer_id-in').val(data.id);
        },
        error: function(data){
            alert(data);
        }
    });
}
function id_return(){         
    $.ajax({
        method: "POST",
        url: "includes/functions/auto_inputs.php",
        cache:false,
        async: false,
        data: {
            'func': "return-id",
        },
        dataType:"json",
        success: function(data) {
            $('#return_id').val(data.id);
        },
        error: function(data){
            alert(data);
        }
    });
}
function id_pullout(){         
    $.ajax({
        method: "POST",
        url: "includes/functions/auto_inputs.php",
        cache:false,
        async: false,
        data: {
            'func': "pullout-id",
        },
        dataType:"json",
        success: function(data) {
            $('#pullout_id').val(data.id);
        },
        error: function(data){
            alert(data);
        }
    });
}
function id_sales(){         
    $.ajax({
        method: "POST",
        url: "includes/functions/auto_inputs.php",
        cache:false,
        async: false,
        data: {
            'func': "sales-id",
        },
        dataType:"json",
        success: function(data) {
            $('#transaction_no').val(data.id);
        },
        error: function(data){
            alert(data);
        }
    });
}
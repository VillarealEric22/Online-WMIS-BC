function setPrice(pid, id){
    var a = pid;
    var id = id;
    $.ajax({
        url: "includes/functions/populate_sources.php",
        method: "POST",
        dataType:"json",
        data:{
            'id':id,
            'func':"autoprice"
        },
        success:function(data){
            $('#price-'+a).val(data.item_price);
        },
        error:function(){
            alert("error");
        }
    });
}
function rowTotal(pid){
    var id = pid;
    var unit_price = parseFloat($('#price_'+id).val());
    var qty = $('#amount_'+id).val();
    var total = qty * unit_price;
    $('#rowTotal-'+id).html(total);
    $('#rowTot'+id).val(total);
    
}
function grandTotal(){
    var gTot = 0;
    var rTotal = 0;
    $(".row-total").each(function () {
        rTotal = parseFloat($(this).val());
        gTot += rTotal;
    });
    $('#grandTotal').html(gTot);
    $('#gTotal').val(gTot);
}

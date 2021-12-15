// Dropdown for user 
document.querySelector(".user-wrapper ul li").addEventListener("click", function(){
    this.classList.toggle("active");
});
//sidebar toggle
function toggleMenu(){
    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.navigation');
    let main = document.querySelector('.main');
    toggle.classList.toggle('active');
    navigation.classList.toggle('active');
    main.classList.toggle('active');
}

//pagination
var table = '#sortable'

$('#maxRows').on('change', function(){
    $('.pagination').html('')
    var trnum = 0
    var maxRows = parseInt($(this).val())
    var totalRows = $(table+' tbody tr').length
    $(table+' tr:gt(0)').each(function(){
        trnum++
        if(trnum > maxRows){
            $(this).hide()
        }
        if(trnum <= maxRows){
            $(this).show()
        }
    })
    if(totalRows > maxRows){
        var pagenum = Math.ceil(totalRows/maxRows)
        for(var i=1; i<= pagenum;){
            $('.pagination').append('<li data-page = "'+i+'">\<span>' + i++ +'<span class = "sr-only"></span></span>\</li>').show
        }
    }
    $('.pagination li:first-child').addClass('active')
    $('.pagination li').on('click',function(){
        var pageNum = $(this).attr('data-page')
        var trIndex = 0;
        $('.pagination li').removeClass('active')
        $(this).addClass('active')
        $(table+' tr:gt(0)').each(function(){
            trIndex++
            if(trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
                $(this).hide()
            }
            else{
                $(this).show()
            }
        })
    })
});

$(document).ready(function(){
    //restrict to alpha numeric
    $('input').on('input', function() {
        var c = this.selectionStart,
            r = /[^A-Za-z0-9_-( \w+)*]/gi,
            v = $(this).val();
        if(r.test(v)) {
          $(this).val(v.replace(r, ''));
          c--;
        }
        this.setSelectionRange(c, c);
      });
    //set date today
    date();
    function date(){
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

        $("#transaction_date").val(today);
    }
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#date_range').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#date_range').daterangepicker({
            startDate: start,
            endDate: end,
            format: 'DD/MM/YYYY',
            ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });

    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day);

    //search table
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
            $("#sortable tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $("#product_type-s").on("change", function() {
        var value = $(this).val().toLowerCase();
            $("#sortable tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
     //remove item from temporary queue/cart
     $(document).on('click', '.removeItem', function () {

        $('#p'+ $(this).closest('tr').find('.pdIn').attr('id')).remove();
        $('#w'+ $(this).closest('tr').find('.pdIn').attr('id')).remove();
        $('#r'+ $(this).closest('tr').find('.pdIn').attr('id')).remove();
        $(this).closest('tr').remove();
        grandTotal();
        return false;
    });
    //add row for non-pos transaction
    $('#orderProduct').on('click', function(e) {
        e.preventDefault();
        
        var cvalue = parseInt($('#counter').val()) + 1;
        var nxt = parseInt(cvalue);
        $('#counter').val(nxt);
        var data = "<tr id='ppid-"+cvalue+"'><td class = 'table-input' colspan='4'><select id = 'sel-product_code"+cvalue+"' class='sel-product_code' autocomplete='off' style = 'width:100%' required></select></td></tr><tr id ='row-"+cvalue+"'><td class = 'table-input'><input type='number' min ='0' placeholder ='0' id='amount_"+cvalue+"' class = 'qty' required></td><td class = 'table-input'><span class='unit'> &#8369; </span><input type='number' min ='0' placeholder = '0' id='price_"+cvalue+"' class = 'price_ea' required></td><td class = 'table-input'><input type = 'hidden' class = 'pdIn' id='pid-"+cvalue+"'><input type = 'hidden' id = 'rowTot"+cvalue+"' class = 'row-total' value = '0'><span> &#8369; </span> &nbsp; <span id = 'rowTotal-"+cvalue+"' class = 'rowTotal'>0.00</span></td><td class = 'table-input'><button formnovalidate='formnovalidate' class = 'removeItem'>remove</button></td></tr>";
        $('#itemRows').append(data);
        //onload: call the select2 initialize function 
        $(".sel-product_code").each(function() {
            initializeSelect2($(this));
        });
        rowTotal(cvalue);
        grandTotal();
        supplierItem(cvalue);
    });

    $('#addProduct').on('click', function (e) {
        e.preventDefault();

        var cvalue = parseInt($('#counter').val()) + 1;
        var nxt = parseInt(cvalue);
        $('#counter').val(nxt);
        var data = "<tr id='ppid-"+cvalue+"'><td class = 'table-input' colspan='4'><select id = 'sel-product-code_"+cvalue+"' class='sel-product_code' autocomplete='off' style = 'width:100%'  required></select></td></tr><tr id ='row-"+cvalue+"'><td class = 'table-input'><input type='number' min ='0' placeholder ='0' id ='alert-"+cvalue+"' value = '' class = 'qty_avail' disabled></td><td class = 'table-input'><input type='number' min ='0' placeholder = '0' id='amount_"+cvalue+"' class = 'qty' required></td><td class = 'table-input'><input type = 'hidden' class = 'pdIn' id='pid-"+cvalue+"'><button formnovalidate='formnovalidate' class = 'removeItem'>remove</button></td></tr>"
        $('#itemRows').append(data);
        //onload: call the select2 initialize function 
        $(".sel-product_code").each(function() {
            initializeSelect2($(this));
        });
        whItem(cvalue);

    });
    //add row for pos transaction
    $(document).on('click', ".select_pos_item", function (e) {
        e.preventDefault();
        
        var pid = $(this).attr('data-pcode');
        var flag = true;
        $('.pdIn').each(function (){
            if (pid == $(this).val()) {
                var stock = $('#amount_'+pid).attr('max');
                var stotal = parseInt($('#amount_'+pid).val()) + 1;
                
                if (stotal <= stock) {
                    $('#amount_' +pid).val(stotal);
                } else {
                    alert('not enough stocks');
                }
                rowTotal(pid);
                $('#amount_' +pid).focus();
                flag = false;
            }   
        });   
        if(flag){
            var cvalue = parseInt($('#counter').val()) + 1;
            var nxt = parseInt(cvalue);
            $('#counter').val(nxt);
            
            var data = "<tr id='ppid-"+pid+"'><td class = 'table-input' colspan='4'><select id = 'sel-product_code_"+pid+"' class='sel-product_code' autocomplete='off' style = 'width:100%'></select required></td></tr><tr id='wpid-"+pid+"'><td class = 'table-input' colspan=4'><select id = 'sel-warehouse-code_"+pid+"' class='sel-warehouse_code' autocomplete='off' style = 'width:100%' required></select></td></tr><tr id = 'rpid-"+pid+"'><td class = 'table-input'><input type='hidden' id='alert-'" + pid + "' value=''><input type='number' id='amount_"+pid+"' value = '0' min ='0' placeholder ='0' class = 'qty' required></td><td class = 'table-input'><span class='unit'> &#8369; </span><input type='number' min ='0' placeholder = '"+ $(this).attr('data-price') + "' id='price_"+pid+"' class = 'price_ea' value='"+ $(this).attr('data-price') + "' required></td><td class = 'table-input'><input type = 'hidden' class = 'pdIn' id='pid-"+pid+"' value ='"+pid+"'><input type = 'hidden' id = 'rowTot"+pid+"' class = 'row-total' value = '0'><span> &#8369; </span> &nbsp; <span id = 'rowTotal-"+pid+"' class = 'rowTotal'>0.00</span></td><td class = 'table-input'><button formnovalidate='formnovalidate' class = 'removeItem'>remove</button></td></tr>"
            $('#itemRows').append(data);
            //onload: call the select2 initialize function
            $(".sel-product_code").each(function() {
                initializeSelect2($(this));
            });
            $(".sel-warehouse_code").each(function() {
                initializeSelect2WH($(this));
            });
            product(pid);
            wh_item_wh(pid);
            $('#sel-product_code_'+pid).val(pid).change();
            setmaxdefault(pid);
        }
        grandTotal();
    });
        function setmaxdefault(pid){
            var id = pid;

            var val = $('#sel-product_code_'+id).val();
            var wh = $('#sel-warehouse-code_'+id).val();
            $.ajax({
                method: "POST",
                url: "includes/functions/auto_inputs.php",
                cache:false,
                async: false,
                data: {
                    'func': "set_max",
                    'id':val,
                    'wh':wh
                },
                dataType:"json",
                success: function(data) {
                    $('#alert-'+id).val(data.quantity);
                    $('#amount_'+id).attr({"max" : data.quantity});
                    $('#amount_'+id).val('1');
                    rowTotal(id);
                    grandTotal();
                },
                error: function(data){
                    alert(data);
                }
            });
        }
    $(document).on('keyup', '.qty', function(e){
        var max = parseInt($(this).attr('max'));
        e.preventDefault();
        if ($(this).val() > max
            && e.keyCode !== 46 // keycode for delete
            && e.keyCode !== 8 // keycode for backspace
            ) {
            e.preventDefault();
            $(this).val(max);
        }
    });
    $(document).on('keyup change', '.price_ea', function(){
        var pid = $(this).attr('id');
        var arr = pid.split('_');
        pid = arr[1];
        rowTotal(pid);
        grandTotal();
    });
    $(document).on('keyup change', '.qty', function(){
        var pid = $(this).attr('id');
        var arr = pid.split('_');
        pid = arr[1];
        rowTotal(pid);
        grandTotal();
    });
    function setMax(pid){
        
    }
});

//Initialize Select2
    //Dynamic Select2
    function initializeSelect2(selectElementObj) {
        selectElementObj.select2({
            placeholder: 'Select product',
            width: 'resolve',
        });
    }
    $(".sel-product_code").each(function() {
        initializeSelect2($(this));
    });
    function initializeSelect2WH(selectElementObje) {
        selectElementObje.select2({
            placeholder: 'Select warehouse',
            width: 'resolve',
        });
    }
    $(".sel-warehouse_code").each(function() {
        initializeSelect2WH($(this));
    });
    function initializeSelect2Ret(selectElementObject) {
        selectElementObject.select2({
            placeholder: 'Select Reason for Return',
            width: 'resolve',
        });
    }
    $(".return_type").each(function() {
        initializeSelect2Ret($(this));
    });
//Static Select2
$(document).ready(function(){
    $('#customer_id').select2({
        placeholder: 'Select a customer',
        width: 'resolve'
    });
    $('#supplier_id').select2({
        placeholder: 'Select a supplier',
        width: 'resolve'
    });
    $('#transaction_id').select2({
        placeholder: 'Select transaction id',
        width: 'resolve'
    });
    $('#transfer_id').select2({
        placeholder: 'Select transaction id',
        width: 'resolve'
    });
    $('#purchase_id').select2({
        placeholder: 'Select purchase order id',
        width: 'resolve'
    });
    $('#r_purchase_id').select2({
        placeholder: 'Select purchase order id',
        width: 'resolve'
    });
    $('#product_type').select2({
        placeholder: 'Select product type',
        width: 'resolve'
    });
    $('#warranty_code').select2({
        placeholder: 'Select warranty code',
        width: 'resolve'
    });
    $('#warehouse_code').select2({
        placeholder: 'Select warehouse code',
        width: 'resolve'
    });
    $('.sel-warehouse_code').select2({
        placeholder: 'Select warehouse code',
        width: 'resolve'
    });
    $('.sel-product_code').select2({
        placeholder: 'Select product',
        width: 'resolve'
    });
    $('#ro_style').select2({
        placeholder: 'Select re-order strategy',
        width: 'resolve'
    });
    $('#warehouse_source').select2({
        placeholder: 'Select source',
        width: 'resolve'
    });
    $('#warehouse_dest').select2({
        placeholder: 'Select destination',
        width: 'resolve'
    });
    $('#whmanager').select2({
        placeholder: 'Select warehouse manager',
        width: 'resolve'
    });
    $('#sex').select2({
        placeholder: 'Select sex',
        width: 'resolve'
    });
    $('#esex').select2({
        placeholder: 'Select sex',
        width: 'resolve'
    });
    $('#role').select2({
        placeholder: 'Select role',
        width: 'resolve'
    });
    $('#employee_id').select2({
        placeholder: 'Select employee id',
        width: 'resolve'
    });
});
//select tr
$(document).ready(function() {
    $('#sortable').on("click",'.tablerow',function(event) {
      if (event.target.type !== 'checkbox') {
        $(':checkbox', this).trigger('click');
      }
    });
    $('#sortable').on("change", 'input[type="checkbox"]', function (e) {
        if ($(this).is(":checked")) { //If the checkbox is checked
            $(this).closest('tr').addClass("selected"); 
            //Add class on checkbox checked
        } else {
            $(this).closest('tr').removeClass("selected");
            //Remove class on checkbox uncheck
        }
    });
});

//Disbaled-Enable Buttons
$(document).ready(function () {
    $("#sortable").on("click",'.tablerow',function() {
        if ($('.selectable:checked').length === 0) {
            $('#delete_btn').attr('disabled', 'disabled');
            $('#edit_btn').attr('disabled', 'disabled');
        }
        else if ($('.selectable:checked').length >= 2) {
            $('#delete_btn').removeAttr('disabled');
            $('#edit_btn').attr('disabled', 'disabled');
        }
        else {
            $('#delete_btn').removeAttr('disabled');
            $('#edit_btn').removeAttr('disabled');
        }
    });
});

// Get the button that opens the modal
var btn = document.getElementsByClassName("modalbtn");
// All page modals
var modals = document.querySelectorAll('.modal');
// Get the element that closes the modal
var span = document.getElementsByClassName("close");
var cancel = document.getElementsByClassName("btn-cancel");

// When the user clicks the button, open the modal 
for (var i = 0; i < btn.length; i++) {
    btn[i].onclick = function(e) {
       e.preventDefault();
       modal = document.querySelector(e.target.getAttribute("href"));
       modal.style.display = "flex";
    }
}
// When the user clicks on x, close the modal
for (var i = 0; i < span.length; i++) {
    span[i].onclick = function() {
       for (var index in modals) {
        if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";    
       }
    }
}
// When the user clicks on cancel, close the modal
for (var i = 0; i < cancel.length; i++) {
    cancel[i].onclick = function() {
       for (var index in modals) {
        if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";    
       }
    }
}
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }

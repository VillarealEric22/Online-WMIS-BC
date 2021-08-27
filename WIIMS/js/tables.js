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
})
$('.modalTable').find('.description').each(function() {
    $(this).click(function() {
      $('.modalTable td').not($(this)).prop('contenteditable', false);
      $(this).prop('contenteditable', true);
    });
    $(this).blur(function() {
      $(this).prop('contenteditable', false);
    });
  });


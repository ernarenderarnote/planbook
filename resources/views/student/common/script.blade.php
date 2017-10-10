<script type="text/javascript" src="/js/jquery.min.js"></script> 
<script type="text/javascript" src="/js/bootstrap.min.js" ></script> 
<script type="text/javascript" src="/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/js/custom.js"></script>
<!-- datepicker js-->
<script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<!-- time picker js -->
<script src="{{ asset('/plugins/jonthornton-timepicker/jquery.timepicker.min.js') }}"></script>

@stack('before-main-js')
<script>
$(document).ready(function(){
	
$('.selectedClassYear li a').on('click',function(e){ 
	
	lselected = $(this).text();
    var background   = $(this).css('background-color');
    $(this).parents('.dropdown').find('.btn').html(lselected +' <span class="caret"></span>');
   }); 

});

</script>
@stack('js')

@extends('layouts.teacher')

@section('content')
@php $url = request()->view ; @endphp
<div id="dynamicCalendarContent" >

</div>

@endsection

@push('js')
<script type="text/javascript">
$(document).ready(function() {
	var url = '@php echo $url @endphp' ;
	if(url == 'week'){
	$("#dynamicCalendarContent").load("/teacher/dashboard/weekCalendar");
		$(".get-calendar").click(function(e){

		$("#dynamicCalendarContent").load("/teacher/dashboard/weekCalendar"+$(this).attr('href') ,function(){

		    //$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
		});

		e.preventDefault();
	});	
	}
	else if(url == 'day'){
		$("#dynamicCalendarContent").load("/teacher/dashboard/dayCalendar");
		$(".get-calendar").click(function(e){
		$("#dynamicCalendarContent").load("/teacher/dashboard/dayCalendar"+$(this).attr('href') ,function(){
		    //$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
		});

		e.preventDefault();
	});
	}
	else{
		$("#dynamicCalendarContent").load("/teacher/dashboard/showCalendar");
		$(".get-calendar").click(function(e){

		$("#dynamicCalendarContent").load("/teacher/dashboard/showCalendar"+$(this).attr('href') ,function(){

		    //$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
		});

		e.preventDefault();
	});
	}
	$(".copydropcrossicons").click(function(){
          $(".lesondropdown").hide();
         });
         $(".renew-button").click(function(){
          $(".actiondropdown").toggle();
         });
         
         $(".standard-button").click(function(){
          $(".standardedit-modal").show();
         });
         
         
		 $(".cancelstandard-button").click(function(){
          $(".standardedit-modal").hide();
         });
		
});
</script>
@endpush
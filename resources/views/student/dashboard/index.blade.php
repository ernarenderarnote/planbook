@extends('layouts.student')

@section('content')
@php $url = request()->view ; @endphp
<div id="dynamicCalendarContent" >

</div>
<div id="main-loader" class="pageLoader" >
  <div class="loader-content"> <span class="loading-text">Loading</span> <img src="../../images/loading.gif"> </div>
</div>
@endsection

@push('js')
    <!--Script to Load the Calendars-->
	<script type="text/javascript">
	$(document).ready(function() {
		var currentUrl = '@php echo $url @endphp' ;
		if(currentUrl == 'week'){
		$("#dynamicCalendarContent").load("/student/dashboard/weekCalendar");
			$(".get-calendar").click(function(e){

			$("#dynamicCalendarContent").load("/student/dashboard/weekCalendar"+$(this).attr('href') ,function(){

			});
			e.preventDefault();
		});	
		}
		else if(currentUrl == 'day'){
			$("#dynamicCalendarContent").load("/student/dashboard/dayCalendar");
			$(".get-calendar").click(function(e){
			$("#dynamicCalendarContent").load("/student/dashboard/dayCalendar"+$(this).attr('href') ,function(){
				//$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
			});

			e.preventDefault();
		});
		}
		else{
			$("#dynamicCalendarContent").load("/student/dashboard/showCalendar");
			$(".get-calendar").click(function(e){

			$("#dynamicCalendarContent").load("/student/dashboard/showCalendar"+$(this).attr('href') ,function(){
			});

			e.preventDefault();
		});
		}
   
	    
	});	 
	</script>
	<script type="text/javascript">
		$(window).load(function() {
			$(".pageLoader").hide();
		});
	</script>
	<script>
		$('.view-dropdown').on('click', function(event){
			event.stopPropagation();
		});
		
	</script>	
@endpush
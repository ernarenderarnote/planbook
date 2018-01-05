
<script>
	
</script>
@inject('monthView', 'App\Services\Month')

@php 

$selectedYear = auth()->user()->selectedYear()->first();

$visibleDay = collect($selectedYear->class_schedule)->where("is_class", "1")->pluck("text")->map(function($day){ return "day-". strtolower($day); })->all();

$weeksInMonth = $monthView->_weeksInMonth();

$classes = $monthView->getClasses();

$user_plan = $monthView->userPlans(Auth::user()->id);

$plan = $user_plan->layout_name; 
	
@endphp
<style type="text/css">
   .month-view [data-day]{
      /*display: none !important;*/
   }
   .day-sunday [data-day="sunday"], .day-monday [data-day="monday"],
   .day-tuesday [data-day="tuesday"], .day-wednesday [data-day="wednesday"],
   .day-thursday [data-day="thursday"], .day-friday [data-day="friday"],
   .day-saturday [data-day="saturday"]{
      display: block !important;
   }
</style>
	<div class="listtab-content tab-content activeCalendar" id="ActiveCalendar">
		<div class="calendar-view container-fluid tab-pane active month-view" id="Month">
		   <div class="container-fluid {{ implode(' ', $visibleDay)}}" >
			  <div class="view-title">
				 <div class="header-title">{{ date('M Y',strtotime($monthView->getYear().'-'.$monthView->getMonth().'-1')) }}</div>
			  </div>
			  <div class="weeks-d">
				 <ul class="p-0 m-0 text-center">
					{!! $monthView->_createLabels() !!}
				 </ul>
			  </div>
			  <div class="calendar-data">

				 @for( $i=0; $i<$weeksInMonth; $i++ )
					<ul class="p-0 m-0">
					
					   @for($j=1;$j<=7;$j++)
						  @php $content = $monthView->_showDay($i*7+$j);@endphp
						  <li data-date="{{ $content['date'] }}" @if($content['date'] != "") data-day="{{ strtolower(date('l', strtotime($content['date']) )) }}" @endif>
						  <div class="dates text-right">{{ $content['day'] }}</div>
						  
						  @include("teacher.dashboard.lesson.show")
					   @endfor
					   </li>
					</ul>
				 @endfor
			  </div>
			  {!! $monthView->_createNavi() !!}
		   </div>
		</div>
		
	</div>
	<!-- Add class Popup Starts Here -->
	<div class="d-render-popoup t-data-popup" id="dynamicRenderDiv" style="display:none;">
	 </div>
@push('js')
<script type="text/javascript">
   
</script>
@endpush
<script src="{{ asset('/js/common_action.js') }}"></script>

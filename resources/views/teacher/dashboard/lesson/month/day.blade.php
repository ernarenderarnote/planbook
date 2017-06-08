	@inject('monthView', 'App\Services\Month')

	@php 

	$selectedYear = auth()->user()->selectedYear()->first();
	$visibleDay = collect($selectedYear->class_schedule)->where("is_class", "1")->pluck("text")->map(function($day){ return "day-". strtolower($day); })->all();

	$weeksInMonth = $monthView->_weeksInMonth();

	$classes = $monthView->getDayClasses();

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
	<div class="listtab-content tab-content" id="ActiveCalendar">
		<!--Day content start here-->
		@php 
		$currentDate = $monthView->getDay(); 
		$currentDayName = date('l Y-m-d', strtotime($currentDate));
		@endphp
		<div class="daycontent tab-pane active" id="day">
			<div class="date">{{ $currentDayName  }}</div>
			@php	
		    $DayName = $monthView->getDay(); 
			$filtered = $classes->where('start_date', '<=' , $DayName)->where('end_date', '>=', $DayName)->where('user_id', '=' , Auth::user()->id )->all();
			@endphp
			@if(!empty($filtered))
				@foreach($filtered as $filter)
					@php
					 $url = empty($filter->classlesson);
					 $dayFormat = date("l m/d/Y");
					 $weekDay = date('l', strtotime($currentDate));
					 
					 $hasClass = !collect(json_decode($filter->class_schedule))
									->where("text", $weekDay)
									->where("is_class" , "1")
									->isEmpty();
					@endphp
		  
					@if($hasClass)
						<div class="languagearts daytab-content" style="background-color:{{ $filter['class_color'] }}; color:#fff;"> {{ $filter['class_name'] }} 
							<span class="icons">
								<ul>
									<li class="dropdown"><img src="/images/move-icon.png" class="move-icon" > </li>
									<li class="dropdown"> <img src="/images/downarrow2.png" class="downarrow-icon downarrowtoggle">
										<div class="lesondropdown">
											<div class="lessondropdown-header"> Lesson Actions 
												<span class="cross-icon copydropcrossicons"> 
													<i class="fa fa-close" aria-hidden="true"></i>
												</span>
											</div>
											<div class="lesondropdown-body lessondrop-bodymain">
												<ul>
													<li data-toggle="modal" data-target="#editmodal" > <i class="fa fa-pencil" aria-hidden="true"></i> Edit Lesson</li>
													<li data-toggle="modal" data-target="#movemodal"> <i class="fa fa-arrows" aria-hidden="true"></i> Move Lesson</li>
													<li class="copy-field"> <i class="fa fa-copy" aria-hidden="true"></i> Copy
														<div class="dropdown copy-dropdown">
															<button class="btn btn-copy dropdown-toggle" type="button" data-toggle="dropdown"> All
																<div class="caret-button"><span class="caret"></span></div>
															</button>
															<ul class="dropdown-menu copydropdown-inner">
															   <li>All Selection</li>
															   <li>
																  <input type="checkbox">
																  Lesson </li>
															   <li>
																  <input type="checkbox">
																  Homework </li>
															   <li>
																  <input type="checkbox">
																  Notes </li>
															   <li>
																  <input type="checkbox">
																  Standards </li>
															   <li>
																  <input type="checkbox">
																  Attachments </li>
															   <li>Done</li>
															</ul>
														</div>
													</li>
													<li data-toggle="modal" data-target="#pastemodal"> <i class="fa fa-paste" aria-hidden="true"></i> Paste</li>
													<li> <i class="fa fa-arrow-right" aria-hidden="true"></i> Bump
														<div class="copy-incrementfunction">
															<input type="button" class="decrementBtn" value="-" >
															<input type="text" value="1" class="copydropdown-value">
															<input type="button" class="incrementBtn" value="+" >
														</div>
													</li>
													<li> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
														<div class="copy-incrementfunction">
															<input type="button" class="decrementBtn" value="-" >
															<input type="text" value="1" id="spinner1" class="copydropdown-value">
															<input type="button" class="incrementBtn"  value="+" >
														</div>
													</li>
													<li> <i class="fa fa-forward" aria-hidden="true"></i> Extend Lesson
														<div class="copy-incrementfunction">
															<input type="button" class="decrementBtn" value="-" >
															<input type="text" value="1" class="copydropdown-value">
															<input type="button" class="incrementBtn" value="+" >
														</div>
													</li>
													<li> <i class="fa fa-forward" aria-hidden="true"></i> Extend Standards
														<div class="copy-incrementfunction">
															<input type="button" class="decrementBtn" value="-" >
															<input type="text" value="1" class="copydropdown-value">
															<input type="button" class="incrementBtn" value="+" >
														</div>
													</li>
												  <li data-toggle="modal" data-target="#deletemodal"> <i class="fa fa fa-trash" aria-hidden="true"></i> Delete Lessons</li>
												  <li data-toggle="modal" data-target="#movemodal"> <i class="fa fa-calendar" aria-hidden="true"></i> No Class Day</li>
												</ul>
											</div>
										</div>
									</li>
								</ul>
							</span>  
						</div>
					@endif
				@endforeach
			@endif
		</div>
		{!! $monthView->_createDayNavi() !!}
		<!--End Day View-->
	</div>	
	<!--edit lesson popup start-->
	
	<script type="text/javascript">
	$(document).ready(function(){
		$(".downarrowtoggle").click(function(){
			$(".lesondropdown").hide();
			$(this).next(".lesondropdown").show();
			
		});
		
		$('body').click(function(e) {
		 if($(e.target).is('.downarrowtoggle'))	
			 return false;
			if (!$(e.target).closest('.lesondropdown').length){
				$(".lesondropdown").hide();
			}
		});
		
		$(".copydropcrossicons").click(function(){
			 $(this).parents(".lesondropdown").hide();
		});
	});		 
	</script>
	
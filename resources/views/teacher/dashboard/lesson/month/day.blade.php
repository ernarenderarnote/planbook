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
			$ts = strtotime($DayName);
			$filtered = $classes->where('start_date', '<=' , $DayName)->where('end_date', '>=', $DayName)->where('user_id', '=' , Auth::user()->id )->all();
			@endphp
			@if(!empty($filtered))
				@foreach($filtered as $filters)
					@php
					 $url = empty($filters->classlesson);
					 $dayFormat = date("l m/d/Y");
					 $daysName = date("Y-m-d", $ts); 
					 $dateToPass = date("l Y-m-d",$ts);
					 $dbDate = date("Y-m-d",$ts);
					 $weekDay = date('l', strtotime($currentDate));
					 
					 $hasClass = !collect(json_decode($filters->class_schedule))
									->where("text", $weekDay)
									->where("is_class" , "1")
									->isEmpty();
									$classID = $filters['id'];
									$sqlDate = date('Y-m-d', strtotime($daysName));
									$lessonsData = $monthView->getLessons($classID,$sqlDate);
					@endphp
		  
					@if($hasClass)
						<div class="mainClass" style="border-color: {{ $filters['class_color'] }}">			
							<div class="languagearts week-tabcontentinner" style="background-color:{{ $filters['class_color'] }}; color:#fff; border-color: {{ $filters['class_color'] }};">
							@forelse($lessonsData as $lData)		
							 {!! $filters['class_name'] !!} {!!$lData['lesson_start_time']!!}  {!!$lData['lesson_end_time']!!}
							  @empty 
							  {!! $filters['class_name'] !!}
							  @endforelse
								<span class="week-icons">
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
														<li class="editBtn" id="editBtn" targetID = "{{ $filters['id'] }}" targetDay = "{{ $weekDay }}"  targetDate="{{ $dateToPass  }}"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit Lesson</li>
														<li data-toggle="modal" id="moveBtn" targetID = "{{ $filters['id'] }}" targetClass = "{{ $filters['class_name'] }}"  targetDate="{{ $dateToPass  }}"> <i class="fa fa-arrows" aria-hidden="true"></i> Move Lesson</li>
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
														<li> 
															<i class="fa fa-arrow-right" aria-hidden="true"></i> 
															<span class="weekBump" token="{{ csrf_token() }}" targetID = "{{ $filters['id'] }}" targetDate="{{ $dbDate  }}">Bump</span>
															<div class="copy-incrementfunction">
																<input type="button" class="decrementBtn" value="-" >
																<input type="text" value="1" class="copydropdown-value">
																<input type="button" class="incrementBtn" value="+" >
															</div>
														</li>
														<li>
															<i class="fa fa-arrow-left" aria-hidden="true"></i> 
															<span class="weekBack" token="{{ csrf_token() }}" targetID = "{{ $filters['id'] }}" targetDate="{{ $dbDate  }}">Back</span>
															<div class="copy-incrementfunction">
																<input type="button" class="decrementBtn" value="-" >
																<input type="text" value="1" class="copydropdown-value">
																<input type="button" class="incrementBtn" value="+" >
															</div>
														</li>
														<li> 
															<i class="fa fa-forward" aria-hidden="true"></i>
															<span class="weekExtend" token="{{ csrf_token() }}" targetID = "{{ $filters['id'] }}" targetDate="{{ $dbDate  }}">Extend Lesson</span>
															<div class="copy-incrementfunction">
																<input type="button" class="decrementBtn" value="-" >
																<input type="text" value="1" class="copydropdown-value">
																<input type="button" class="incrementBtn" value="+" >
															</div>
														</li>
														<li>
															<i class="fa fa-forward" aria-hidden="true"></i>
															<span class="weekStandardsExtend" token="{{ csrf_token() }}" targetID = "{{ $filters['id'] }}" targetDate="{{ $dbDate  }}"> Extend Standards</span>
															<div class="copy-incrementfunction">
																<input type="button" class="decrementBtn" value="-" >
																<input type="text" value="1" class="copydropdown-value">
																<input type="button" class="incrementBtn" value="+" >
															</div>
														</li>
													  <li class="deleteLessons" data-toggle="modal" token="{{ csrf_token() }}" targetID = "{{ $filters['id'] }}" targetDate="{{ $dbDate  }}" ><i class="fa fa fa-trash" aria-hidden="true"></i> Delete Lessons</li>
													  <li data-toggle="modal" token="{{ csrf_token() }}" data-target="#movemodal"><i class="fa fa-calendar" aria-hidden="true"></i> No Class Day</li>
													</ul>
												</div>
											</div>
										</li>
									</ul>
								</span> 
							</div>
							<div class="appendText">
								@php
								$classID = $filters['id'];
								$sqlDate = date('Y-m-d', strtotime($daysName));
								$lessonsData = $monthView->getLessons($classID,$sqlDate);
								@endphp
								
								@forelse($lessonsData as $lData)
									@php 
										$groups = array();
										$attach = $lData['attachments'];
										$groups = explode(',',$attach);
									@endphp
									@if($lData['lesson_title'])
									<div class="t-heading" style="border-bottom: 1px solid {{ $filters['class_color'] }}">{{ $lData['lesson_title'] }}</div>
									@endif
									@if($lData['unit'])
									<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}">{{ $lData['unit'] }}</div>
									@endif	
									@if($lData['lesson_text'])	
									<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}">{!! $lData['lesson_text'] !!}</div>
									@endif
									@if($lData['homework'])	
									<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Homework</h5>{!! $lData['homework'] !!}</div>
									@endif
									@if($lData['notes'])	
									<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Notes</h5>{!! $lData['notes'] !!}</div>
									@endif
									@if($groups)	
									<div class="t-cel"><h4>Attachments:</h4>
										@forelse($groups as $group)
											@if($group)
												<a target="_blank" href="../../uploads/myfiles/{{ $group }}">{{ $group }}</a>
											@endif
										@empty
										
										@endforelse
									</div>
									@endif
									@empty
									
								
								@endforelse
								
								
							</div>
						</div>	
					@endif
				@endforeach
			@endif
		</div>
		{!! $monthView->_createDayNavi() !!}
		<!--End Day View-->
	</div>	
	<script src="{{ asset('/js/common_action.js') }}"></script>
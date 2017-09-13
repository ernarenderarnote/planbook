	@inject('monthView', 'App\Services\Month')

	@php 

	$selectedYear = auth()->user()->selectedYear()->first();
	$visibleDay = collect($selectedYear->class_schedule)->where("is_class", "1")->pluck("text")->map(function($day){ return "day-". strtolower($day); })->all();

	$weeksInMonth = $monthView->_weeksInMonth();

	$classes = $monthView->getWeekClasses();

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
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<div class="listtab-content tab-content" id="ActiveCalendar">
		<!--Week Calendar View -->
		<div class="weekcontent tab-pane active in" id="week">
            <div class="week-data">
               <ul>
			   @php
			    $date = $monthView->getWeek();
				$ts = strtotime($date);
				$dow = date('w', $ts);
				$offset = $dow - 1;
				if ($offset < 0) {
					$offset = 6;
				}
				$ts = $ts - $offset*86400;
				@endphp
				@for ($i = 0; $i < 5; $i++, $ts += 86400)
				@php $weekDays = date("l m/d/Y", $ts); 
				@endphp
                  <li class="week-head">{{ $weekDays }}</li>
                @endfor
               </ul>
            </div>
			
			<div class="week-bodydata">
				<ul>
					@php
					$date = $monthView->getWeek();
					$ts = strtotime($date);
					$dow = date('w', $ts);
					$offset = $dow - 1;
					if ($offset < 0) {
						$offset = 6;
					}
					$ts = $ts - $offset*86400;
					@endphp
					@for ($i = 0; $i < 5; $i++, $ts += 86400)
						@php	
						$daysName = date("Y-m-d", $ts); 
						$AllDays = date("l Y-m-d",strtotime("+$i days"));
						$filtered = $classes->where('start_date', '<=' , $daysName)->where('end_date', '>=', $daysName)->where('user_id', '=' , Auth::user()->id )->all();
						@endphp				
						<li class="weektab-content">
							@forelse($filtered as $filters)
							   
								  @php
									 $url = empty($filter->classlesson);
									 $weekDay = date("l", $ts);
									 $dateToPass = date("l Y-m-d",$ts);
									 $dbDate = date("Y-m-d",$ts);
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
							@else
							<div class="mainClass" style="border:1px solid purple;">		 
								<div class="languagearts week-tabcontentinner" style="background-color:Purple; color:#fff; border-color:purple;">
									No Class
								</div>
							</div>	
							@endif
							@empty	
							@endforelse  
							
						</li>
					@endfor	  
				</ul>   
            </div>
        </div>
		 {!! $monthView->_createWeekNavi() !!}
		<!--End Week View-->
	</div>
	<!-- Add class Popup Starts Here -->
	<div class="d-render-popoup t-data-popup" id="dynamicRenderDiv" style="display:none;">
	</div>
	<div id="deletemodal" class="modal fade movemodalcontent" role="dialog" style="display: none;">
		<div class="modal-dialog"> 
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Delete Lesson</h4>
				</div>
				<div class="modal-body">
					<p>Would you like your lessons shifted back to accommodate for the deleted lesson?</p>
					<div class="button-group">
					  <button class="renew-button wshiftLessons" data-dismiss="modal"> Shift Lessons</button>
					  <button class="renew-button wnshiftLessons" data-dismiss="modal"> Do not Shift Lessons</button>
					  <button class="close-button" data-dismiss="modal"> Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<script src="{{ asset('/js/common_action.js') }}"></script>
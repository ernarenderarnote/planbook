	@inject('monthView', 'App\Services\Month')

	@php 

	$selectedYear = auth()->guard('students')->user()->selectedYear()->first();
	$visibleDay = collect($selectedYear->class_schedule)->where("is_class", "1")->pluck("text")->map(function($day){ return "day-". strtolower($day); })->all();

	$weeksInMonth = $monthView->_weeksInMonth();

	$classes = $monthView->getWeekClasses();
	$user_id = auth()->guard('students')->user()->teacher_id;
	$user_plan = $monthView->userPlans($user_id);

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
						$filtered = $classes->where('start_date', '<=' , $daysName)->where('end_date', '>=', $daysName)->where('user_id', '=' ,auth()->guard('students')->user()->teacher_id )->all();
						$user_id = auth()->guard('students')->user()->teacher_id;
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
									$lessonsData = $monthView->getLessons($classID,$sqlDate,$user_id);
									$eventsData  = $monthView->getEvents($sqlDate,$user_id);
								@endphp 
								@if($hasClass)
								
							<div class="mainClass" style="border-color: {{ $filters['class_color'] }}">			
								<div class="languagearts week-tabcontentinner" style="background-color:{{ $filters['class_color'] }}; color:#fff; border-color: {{ $filters['class_color'] }};">
								@forelse($lessonsData as $lData)		
								 {!! $filters['class_name'] !!} {!!$lData['lesson_start_time']!!}  {!!$lData['lesson_end_time']!!}
								  @empty 
								  {!! $filters['class_name'] !!}
								  @endforelse
									
								</div>
								<div class="appendText">
									@php
									$classID = $filters['id'];
									$sqlDate = date('Y-m-d', strtotime($daysName));
									$lessonsData = $monthView->getLessons($classID,$sqlDate,$user_id);
									$assignmentData = $monthView->getAssignments($classID,$sqlDate,$user_id);
									$assessmentData = $monthView->getAssessments($classID,$sqlDate,$user_id);
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
											@if($lData['objective'])
											<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Objective / Essential Question</h5>{!! $lData['objective'] !!}</div>
											@endif

											@if($lData['direct'])
											<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Direct Instruction</h5>{!! $lData['direct'] !!}</div>
											@endif

											@if($lData['independent'])
											<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Independent Practice</h5>{!! $lData['independent'] !!}</div>
											@endif
											@if($lData['guided'])
											<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Guided Practice</h5>{!! $lData['guided'] !!}</div>
											@endif
											@if($lData['differentation'])	
											<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Differentiation / Accommodations</h5>{!! $lData['differentation'] !!}</div>
											@endif
											@if($lData['homework'])	
											<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}">@if($plan=='detailed')<h5>Homework / Evidence of Learning</h5> @else <h5>Homework</h5> @endif {!! $lData['homework'] !!}</div>
											@endif
											@if($lData['instructional'])	
											<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Instructional Strategies</h5>{!! $lData['instructional'] !!}</div>
											@endif
											@if($lData['notes'])	
											<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}">@if($plan=='detailed')<h5>Notes / Reflection</h5>@else <h5>Notes</h5> @endif {!! $lData['notes'] !!}</div>
											@endif
											@if($lData['material'])	
											<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Materials / Resources / Technology</h5>{!! $lData['material'] !!}</div>
											@endif
											@if($groups)	
											<div class="t-cel" style="border-bottom: 1px solid {{ $filters['class_color'] }}">
												@forelse($groups as $group)
													@if($group)
														<a target="_blank" href="../../uploads/myfiles/{{ $group }}">{{ $group }}</a><br/>
													@endif
												@empty
												
												@endforelse
											</div>
											@endif
											@empty
											
										
										@endforelse
										
										@forelse($assignmentData as $assignment)
											@if($assignment['title'])
											<div class="t-heading" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Assignment</h5>{{ $assignment['title'] }}</div>
											@endif
										@empty
										@endforelse

										@forelse($assessmentData as $assessment)
											@if($assessment['title'])
											<div class="t-heading" style="border-bottom: 1px solid {{ $filters['class_color'] }}"><h5>Assessment</h5>{{ $assessment['title'] }}</div>
											@endif
										@empty
										@endforelse
										
									</div>
								</div>  
							@else
							
							@endif
							@empty	
							@endforelse  
							@forelse($eventsData as $event)
							<div class="languagearts week-tabcontentinner week-tabbottom" style="background-color:#c3d9ff; color:#0000ff;">
								{{$event['event_title']}}
								
						    </div> 
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
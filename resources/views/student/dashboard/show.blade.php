
@php 
   $filtered = $classes->where('start_date', '<=' , $content['date'])->where('end_date', '>=', $content['date'])->where('user_id', '=' , auth()->guard('students')->user()->teacher_id )->all();


@endphp
@if(!empty($filtered))
<div class="cell-main-data">
   @foreach($filtered as $filters)
   
      @php
         $url = empty($filters->classlesson);
		 $DayName = $content['date'] ;
		 $ts = strtotime($DayName);
		 $daysName = date("Y-m-d", $ts); 
		 $dateToPass = date("l Y-m-d",$ts);
		 $dbDate = date("Y-m-d",$ts);
		 $weekDay = date('l', strtotime($content['date']) );
		 
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
							//print_R($groups);
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
						<div class="t-cel">
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
</div>
@endif
<script>
	$("body").on('click','.listtab-content .downarrow-icon',function(){
		$(".calendar-view .calendar-data li .cell-main-data").removeClass('overflow-v');
		$(this).parents(".calendar-view .calendar-data li .cell-main-data").addClass("overflow-v");
			
	});

	$(".lessondropdown-header .cross-icon i").click(function(e) {
		$(this).parents(".calendar-view .calendar-data li .cell-main-data").removeClass("overflow-v");
	 });
	
</script>
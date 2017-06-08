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
								    $units = $monthView->getUnits($filters['id']);
									$url = empty($filter->classlesson); 
									$weekDay = date("l", $ts);
									 
									 $hasClass = !collect(json_decode($filters->class_schedule))
									->where("text", $weekDay)
									->where("is_class" , "1")
									->isEmpty();
									$getTime = collect(json_decode($filters->class_schedule))
									->where("text", $weekDay)
									->where("is_class" , "1")
									->all();
									$classStartTime ;
									$classEndTime ;
								@endphp 
								@foreach($getTime as $gtime)
								  @php
									$classStartTime = $gtime->start_time;
									$classEndTime = $gtime->end_time;
									@endphp
								@endforeach
								@if($hasClass)
									@php
									print_r(@$data);
									  @endphp
						<div class="mainClass">			
							<div class="languagearts week-tabcontentinner" style="background-color:{{ $filters['class_color'] }}; color:#fff; border-color: {{ $filters['class_color'] }};">
							  {{ $filters['class_name'] }} 
								 
								 
								<span class="week-icons">
									<ul>
										<li class="dropdown"><img src="/images/move-icon.png" class="move-icon" ></li>
										<li class="dropdown"> <img src="/images/downarrow2.png" class="downarrow-icon downarrowtoggle">
											<div class="lesondropdown">
												<div class="lessondropdown-header"> Lesson Actions 
													<span class="cross-icon copydropcrossicons"> 
														<i class="fa fa-close" aria-hidden="true"></i>
													</span>
												</div>
												<div class="lesondropdown-body lessondrop-bodymain">
													<ul>
														<li class="editBtn" > <i class="fa fa-pencil" title="{{ $filters['id'] }}" aria-hidden="true"></i> Edit Lesson</li>
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
																<input type="text" value="1" class="copydropdown-value">
																<input type="button" class="incrementBtn" value="+" >
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
							<div class="appendText">
								@php
								$classID = $filters['id'];
								$sqlDate = date('Y-d-m', strtotime($daysName));
								$lessonsData = $monthView->getLessons($classID,$sqlDate);
								@endphp
								
								@forelse($lessonsData as $lData)
									<div class="t-heading"><h2>{{ $lData['lesson_title'] }}</h2></div>
									<div class="t-cel">{{ $lData['lesson_start_time'] }}</div>
									<div class="t-cel">{{ $lData['lesson_end_time'] }}</div>
									<div class="t-cel">{{ $lData['unit'] }}</div>
									<div class="t-cel">{!! $lData['lesson_text'] !!}</div>
									<div class="t-cel">{!! $lData['notes'] !!}</div>
									<div class="t-cel">{!! $lData['homework'] !!}</div>
								
									@empty
									<div class="t-heading"><h2></h2></div>
									<div class="t-cel"></div>
									<div class="t-cel"></div>
									<div class="t-cel"></div>
									<div class="t-cel"></div>
									<div class="t-cel"></div>
									<div class="t-cel"></div>
								
								@endforelse
								
								
							</div>
							<div class="modal fade editmodalcontent" id="editModal" role="dialog">
								<form method="post" action="" id="editlessonform" class="editlessonform">
									{{ csrf_field() }}
									@include("teacher.dashboard.lesson.create")
								</form>	
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
    <script>
  $(document).ready(function(){
	var clickedClass;  
    $(".editBtn").click(function(){
	   clickedClass = $(this).closest(".mainClass");
       $(this).closest(".mainClass").find("div.modal").modal();
    });
	$( ".editlessonform" ).on( "submit", function( event ) {
	  event.preventDefault();
	  var data =  $( this ).serialize();
	  $.ajax({
		  type:'POST',
		  url: BASE_URL +'/teacher/dashboard/editlessons',
		  data: data,
		  //dataType: 'json',
		  beforeSend: function () {
			//obj.html('Sending... <i class="fa fa-send"></i>');
		  },
		  complete: function () {
			//obj.html('Sent <i class="fa fa-send"></i>');
		  },

		  success: function (response) {
			/* clickedClass.find("ul.appendText").html(
			"<li>"+response.lessonTitle+"</li>"+
			"<li>"+response.starttime+"</li>"+
			"<li>"+response.endtime+"</li>"+
			"<li>"+response.units+"</li>"+
			"<li>"+response.lessonTxt+"</li>"+
			"<li>"+response.notesTxt+"</li>"+
			"<li>"+response.homeworkTxt+"</li>"
			); */
			$('#modal').modal().hide();
			clickedClass.find("div.appendText").html(response);
			clickedClass.find("div.modal").modal('hide');
			console.log(response);

			},


		  error: function(data){
			console.log("error");
			console.log(data);
		  }

		});
	});  
});

</script>
<script>
$(document).ready(function(){
    var count = 0;
    var height = 0;
    $(".weektab-content").each(function(){
         $(this).find(".mainClass").each(function(index){
            var h = $(this).outerHeight(true)
           if(h > height)
             height = h;
		     count = index;
			 
        });
    });
	alert(count);
    $(".weektab-content .mainClass").height(height);
    
});
</script>

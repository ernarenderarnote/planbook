
@php 
   $filtered = $classes->where('start_date', '<=' , $content['date'])->where('end_date', '>=', $content['date'])->where('user_id', '=' , Auth::user()->id )->all();
@endphp
@if(!empty($filtered))
<div class="cell-main-data">
   @foreach($filtered as $filter)
   
      @php
         $url = empty($filter->classlesson);
		 
		 $weekDay = date('l', strtotime($content['date']) );
		 
		 $hasClass = !collect(json_decode($filter->class_schedule))
						->where("text", $weekDay)
						->where("is_class" , "1")
						->isEmpty();
      @endphp
	  
		@if($hasClass)
			<div class="lesson">
				<div class="lesson-heading" style="background-color:{{ $filter['class_color'] }}; color:#fff;" >
					{{ $filter['class_name'] }}
					<span class="icons">
						<ul class="icon-ul">
							<li class="dropdown"><img src="/images/move-icon.png" class="move-icon" > </li>
							<li class="dropdown"> <img src="/images/downarrow2.png" class="downarrow-icon downarrowtoggle">
								<div class="lesondropdown actionlesson">
									<div class="lessondropdown-header"> Lesson Actions 
										<span class="cross-icon copydropcrossicons"> 
											<i class="fa fa-close" aria-hidden="true"></i>
										</span>
									</div>
									<div class="lesondropdown-body lessondrop-bodymain">
										<ul class="actionul">
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
													<input type="button" class="decrementBtn"  value="-" >
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
					<span class="lesson-timing"> <!-- 7:45am-8:00am --> </span>
					
				</div>
			</div>  
			
		@endif
   @endforeach
</div>
@endif
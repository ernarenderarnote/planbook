<div class="modal-dialog">
   <!-- Modal content-->
	@php 
		$class_id;
		$class_name; 
	@endphp	
	@if($userClasses)
    @forelse($userClasses as $className)
		@php $class_id = $className['id'];
			$class_name = $className['class_name'];
		@endphp	
		@empty
	@endforelse
	@if($checkScore  && $class_id!='')
		<div class="modal-content">
			<form method="post" action="#" class="editlessonform editscore-form">
				{{ csrf_field() }}
				<input type="hidden" name="class_id" value="{{$class_id}}">
				 <div class="modal-header">
					<div class="normalLesson pull-left">
					   <p>Score Weighting</p>
					</div>
					<div class="actionright pull-right">
					   <button class="actiondropbutton renew-button scoreSubmit">Save</button>
					   <a class="closebutton" data-dismiss="modal"><i class="fa fa-close d-popoup-close" aria-hidden="true"></i></a> 
					</div>
				 </div>
				<div class="alert alert-danger message" style="display:none">
					<strong>Warning!</strong>Percents must total to 100.
				</div>
				 <div class="modal-body editscore-body">
					<p>Percents for Assignments and Assessments must total to 100 percent. To add sample score weights, <a href="#">click here</a></p>
					<p>Score Weighting for <span style="color:#0057C1; font-weight:bold;" id="scoreWeightLabel">{{ $class_name }}</span></p>
					<div class="added-daysection added-assessmentbox">
					   <p>Assignments <a href="javascript:;" class="main-buton assignmentAdd"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
				    </div>
					<div class="addedassignment assignment-table">
					    <table>
						  <thead>
							 <tr class="tHeader">
								<th style="width:350px;">Assignment Type</th>
								<th>Percent</th>
								<th style="background-color:#dbdfe8; border:none;"></th>
							 </tr>
						  </thead>
						  <tbody>
							@php
								$assignment = json_decode($checkScore->assignment);
								$assessment = json_decode($checkScore->assessment);
								$standard   = json_decode($checkScore->standard);
							@endphp
							@if($assignment!='')
								@forelse($assignment as $key=>$value) 
									<tr>	 
										 <td><input id="nameAssignmentWeight0" name="assignment[{{$key}}][title]" size="45" value="{{ $value->title }}" type="text"></td>
										 <td><input id="percentAssignmentWeight0" name="assignment[{{$key}}][marks]" size="6" value="{{ $value->marks }}" type="text" class="perchantage-input perMarks"></td>
										 <td><i class="fa fa-close closeicon-assessment" aria-hidden="true"></i></td>
									</tr>
									@empty	
								@endforelse
							@endif	
						  </tbody>
					   </table>
					</div>
					<div class="added-daysection added-assessmentbox">
					   <p>Assessments <a href="javascript:;" class="assessmentAdd main-buton"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
					</div>
					<div class="assignment-table addedassessment">
					   <table>
						  <thead>
							 
							 <tr class="tHeader">
								<th style="width:350px;">Assessment Type</th>
								<th>Percent</th>
								<th style="background-color:#dbdfe8; border:none;"></th>
							 </tr>
							
						  </thead>
						  <tbody>
							@if($assessment!='')
								@forelse($assessment as $key=>$value)
									<tr>
										<td><input id="nameAssignmentWeight0" name="assessment[{{$key}}][title]" size="45" value="{{ $value->title }}" type="text"></td>
										<td><input id="percentAssignmentWeight0" name="assessment[{{$key}}][marks]" size="6" value="{{ $value->marks }}" type="text" class="perchantage-input perMarks" ></td>
										<td><i class="fa fa-close closeicon-assessment" aria-hidden="true"></i></td>
									 </tr>	
									@empty
								@endforelse 
							@endif		
						  </tbody>
					   </table>
					</div>
					<div class="added-daysection added-assessmentbox">
					   <p>Standards<a href="javascript:;" class="main-buton standardAdd"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
					</div>
					<div class="assignment-table addedStandards">
					   <table>
						  <thead>
							 <tr class="tHeader">
								<th style="width:75px;">ID</th>
								<th style="width:348px;">Name</th>
								<th style="background-color:#dbdfe8; border:none;"></th>
							 </tr>
						  </thead>
						  <tbody>
							@if($standard!='')
								@forelse($standard as $key=>$value) 
								<tr>
									<td><input size="6" name="standard[{{$key}}][id]" value="{{ $value->id }}" type="text"></td>
									<td><input size="45" name="standard[{{$key}}][title]" value="{{ $value->title }}" type="text" class="perchantage-input"></td>
									<td><i class="fa fa-close closeicon-assessment" aria-hidden="true"></i></td>
								</tr>
								@empty
								<h1></h1>
								@endforelse
							@endif	
						  </tbody>
					   </table>
					</div>
				</div>
			</form>
	    </div>
	   @else
	   <div class="modal-content">
		  <form method="post" action="#" class="editlessonform editscore-form">
			{{ csrf_field() }}
			<input type="hidden" name="class_id" value="{{$class_id}}">
			 <div class="modal-header">
				<div class="normalLesson pull-left">
				   <p>Score Weighting</p>
				</div>
				<div class="actionright pull-right">
				   <button class="actiondropbutton renew-button scoreSubmit">Save</button>
				   <a class="closebutton" data-dismiss="modal"><i class="fa fa-close d-popoup-close" aria-hidden="true"></i></a> 
				</div>
			 </div>
			 <div class="modal-body editscore-body">
				<p>Percents for Assignments and Assessments must total to 100 percent. To add sample score weights, <a href="#">click here</a></p>
				<p>Score Weighting for <span style="color:#0057C1; font-weight:bold;" id="scoreWeightLabel">{{ $class_name }}</span></p>
				<div class="added-daysection added-assessmentbox">
				   <p>Assignments <a href="javascript:;" class="main-buton assignmentAdd"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
			   </div>
				<div class="addedassignment assignment-table">
				   <table>
					  <thead>
						 <tr class="tHeader">
							<th style="width:350px;">Assignment Type</th>
							<th>Percent</th>
							<th style="background-color:#dbdfe8; border:none;"></th>
						 </tr>
					  </thead>
					  <tbody>
						 
					  </tbody>
				   </table>
				</div>
				<div class="added-daysection added-assessmentbox">
				   <p>Assessments <a href="javascript:;" class="assessmentAdd main-buton"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
				</div>
				<div class="assignment-table addedassessment">
				   <table>
					  <thead>
						 <tr class="tHeader">
							<th style="width:350px;">Assessment Type</th>
							<th>Percent</th>
							<th style="background-color:#dbdfe8; border:none;"></th>
						 </tr>
					  
					  </thead>
					  <tbody>
						 
					  </tbody>
				   </table>
				</div>
				<div class="added-daysection added-assessmentbox">
				   <p>Standards<a href="javascript:;" class="main-buton standardAdd"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
				</div>
				<div class="assignment-table addedStandards">
				   <table>
					  <thead>
						 <tr class="tHeader">
							<th style="width:75px;">ID</th>
							<th style="width:348px;">Name</th>
							<th style="background-color:#dbdfe8; border:none;"></th>
						 </tr>
					  </thead>
					  <tbody>
						 
					  </tbody>
				   </table>
				</div>
			 </div>
		  </form>
	   </div>
	@endif 
	@else
		@if($checkScore)
		<div class="modal-content">
			<form method="post" action="#" class="editlessonform editscore-form">
				{{ csrf_field() }}
				<input type="hidden" name="class_id" value="0">
				 <div class="modal-header">
					<div class="normalLesson pull-left">
					   <p>Score Weighting</p>
					</div>
					<div class="actionright pull-right">
					   <button class="actiondropbutton renew-button scoreSubmit">Save</button>
					   <a class="closebutton" data-dismiss="modal"><i class="fa fa-close d-popoup-close" aria-hidden="true"></i></a> 
					</div>
				 </div>
				<div class="alert alert-danger message" style="display:none">
					<strong>Warning!</strong>Percents must total to 100.
				</div>
				 <div class="modal-body editscore-body">
					<p>Percents for Assignments and Assessments must total to 100 percent. To add sample score weights, <a href="#">click here</a></p>
					<p>Score Weighting for <span style="color:#0057C1; font-weight:bold;" id="scoreWeightLabel">All Classes</span></p>
					<div class="added-daysection added-assessmentbox">
					   <p>Assignments <a href="javascript:;" class="main-buton assignmentAdd"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
				    </div>
					<div class="addedassignment assignment-table">
					    <table>
						  <thead>
							 <tr class="tHeader">
								<th style="width:350px;">Assignment Type</th>
								<th>Percent</th>
								<th style="background-color:#dbdfe8; border:none;"></th>
							 </tr>
						  </thead>
						  <tbody>
							@php
								$assignment = json_decode($checkScore->assignment);
								$assessment = json_decode($checkScore->assessment);
								$standard   = json_decode($checkScore->standard);
							@endphp
							@if($assignment!='')
								@forelse($assignment as $key=>$value) 
									<tr>	 
										 <td><input id="nameAssignmentWeight0" name="assignment[{{$key}}][title]" size="45" value="{{ $value->title }}" type="text"></td>
										 <td><input id="percentAssignmentWeight0" name="assignment[{{$key}}][marks]" size="6" value="{{ $value->marks }}" type="text" class="perchantage-input perMarks"></td>
										 <td><i class="fa fa-close closeicon-assessment" aria-hidden="true"></i></td>
									</tr>
									@empty	
								@endforelse
							@endif	
						  </tbody>
					   </table>
					</div>
					<div class="added-daysection added-assessmentbox">
					   <p>Assessments <a href="javascript:;" class="assessmentAdd main-buton"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
					</div>
					<div class="assignment-table addedassessment">
					   <table>
						  <thead>
							 
							 <tr class="tHeader">
								<th style="width:350px;">Assessment Type</th>
								<th>Percent</th>
								<th style="background-color:#dbdfe8; border:none;"></th>
							 </tr>
							
						  </thead>
						  <tbody>
							@if($assessment!='')
								@forelse($assessment as $key=>$value)
									<tr>
										<td><input id="nameAssignmentWeight0" name="assessment[{{$key}}][title]" size="45" value="{{ $value->title }}" type="text"></td>
										<td><input id="percentAssignmentWeight0" name="assessment[{{$key}}][marks]" size="6" value="{{ $value->marks }}" type="text" class="perchantage-input perMarks" ></td>
										<td><i class="fa fa-close closeicon-assessment" aria-hidden="true"></i></td>
									 </tr>	
									@empty
								@endforelse 
							@endif		
						  </tbody>
					   </table>
					</div>
					<div class="added-daysection added-assessmentbox">
					   <p>Standards<a href="javascript:;" class="main-buton standardAdd"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
					</div>
					<div class="assignment-table addedStandards">
					   <table>
						  <thead>
							 <tr class="tHeader">
								<th style="width:75px;">ID</th>
								<th style="width:348px;">Name</th>
								<th style="background-color:#dbdfe8; border:none;"></th>
							 </tr>
						  </thead>
						  <tbody>
							@if($standard!='')
								@forelse($standard as $key=>$value) 
								<tr>
									<td><input size="6" name="standard[{{$key}}][id]" value="{{ $value->id }}" type="text"></td>
									<td><input size="45" name="standard[{{$key}}][title]" value="{{ $value->title }}" type="text" class="perchantage-input"></td>
									<td><i class="fa fa-close closeicon-assessment" aria-hidden="true"></i></td>
								</tr>
								@empty
								<h1></h1>
								@endforelse
							@endif	
						  </tbody>
					   </table>
					</div>
				</div>
			</form>
	    </div>
	   @else
		<div class="modal-content">
		  <form method="post" action="#" class="editlessonform editscore-form">
			{{ csrf_field() }}
			<input type="hidden" name="class_id" value="0">
			 <div class="modal-header">
				<div class="normalLesson pull-left">
				   <p>Score Weighting</p>
				</div>
				<div class="actionright pull-right">
				   <button class="actiondropbutton renew-button scoreSubmit">Save</button>
				   <a class="closebutton" data-dismiss="modal"><i class="fa fa-close d-popoup-close" aria-hidden="true"></i></a> 
				</div>
			 </div>
			 <div class="modal-body editscore-body">
				<p>Percents for Assignments and Assessments must total to 100 percent. To add sample score weights, <a href="#">click here</a></p>
				<p>Score Weighting for <span style="color:#0057C1; font-weight:bold;" id="scoreWeightLabel">All Classes</span></p>
				<div class="added-daysection added-assessmentbox">
				   <p>Assignments <a href="javascript:;" class="main-buton assignmentAdd"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
			   </div>
				<div class="addedassignment assignment-table">
				   <table>
					  <thead>
						 <tr class="tHeader">
							<th style="width:350px;">Assignment Type</th>
							<th>Percent</th>
							<th style="background-color:#dbdfe8; border:none;"></th>
						 </tr>
					  </thead>
					  <tbody>
						 
					  </tbody>
				   </table>
				</div>
				<div class="added-daysection added-assessmentbox">
				   <p>Assessments <a href="javascript:;" class="assessmentAdd main-buton"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
				</div>
				<div class="assignment-table addedassessment">
				   <table>
					  <thead>
						 <tr class="tHeader">
							<th style="width:350px;">Assessment Type</th>
							<th>Percent</th>
							<th style="background-color:#dbdfe8; border:none;"></th>
						 </tr>
					  
					  </thead>
					  <tbody>
						 
					  </tbody>
				   </table>
				</div>
				<div class="added-daysection added-assessmentbox">
				   <p>Standards<a href="javascript:;" class="main-buton standardAdd"><i class="fa fa-plus" aria-hidden="true"></i></a></p>
				</div>
				<div class="assignment-table addedStandards">
				   <table>
					  <thead>
						 <tr class="tHeader">
							<th style="width:75px;">ID</th>
							<th style="width:348px;">Name</th>
							<th style="background-color:#dbdfe8; border:none;"></th>
						 </tr>
					  </thead>
					  <tbody>
						 
					  </tbody>
				   </table>
				</div>
			 </div>
		  </form>
	   </div>
	@endif   
	@endif
</div>




@extends('layouts.teacher')

@section('content')
@php $url = request()->view ; @endphp
<div id="dynamicCalendarContent" >

</div>
<div id="main-loader" class="pageLoader" >
  <div class="loader-content"> <span class="loading-text">Loading</span> <img src="../../images/loading.gif"> </div>
</div>
<div id="editmodal" class="modal fade editmodalcontent" role="dialog">
   <div class="modal-dialog"> 
	  <!-- Modal content-->
	  <div class="modal-content">
	  <form method="post" action="" class="editlessonform">
	    {{ csrf_field() }}
		 <div class="modal-header">
			<div class="normalLesson pull-left">
			   <p>Lesson</p>
			</div>
			<div class="actionright pull-right">
			   <div class="actionbutton">
				  <a class="actiondropbutton renew-button">Actions <span class="caret"></span></a>
				  <!--  action dropdown start -->
				  <div class="actiondropdown">
					 <div class="lesondropdown-body">
						<ul>
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
								 <input type="button" onclick="incrementValue()" value="-">
								 <input type="text" placeholder="2" class="copydropdown-value">
								 <input type="button" onclick="decrementValue()" value="+">
							  </div>
						   </li>
						   <li> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back
							  <div class="copy-incrementfunction">
								 <input type="button" onclick="incrementValue()" value="-">
								 <input type="text" placeholder="2" class="copydropdown-value">
								 <input type="button" onclick="decrementValue()" value="+">
							  </div>
						   </li>
						   <li> <i class="fa fa-forward" aria-hidden="true"></i> Extend Lesson
							  <div class="copy-incrementfunction">
								 <input type="button" onclick="incrementValue()" value="-">
								 <input type="text" placeholder="2" class="copydropdown-value">
								 <input type="button" onclick="decrementValue()" value="+">
							  </div>
						   </li>
						   <li> <i class="fa fa-forward" aria-hidden="true"></i> Extend Standards
							  <div class="copy-incrementfunction">
								 <input type="button" onclick="incrementValue()" value="-">
								 <input type="text" placeholder="2" class="copydropdown-value">
								 <input type="button" onclick="decrementValue()" value="+">
							  </div>
						   </li>
						   <li data-toggle="modal" data-target="#deletemodal"> <i class="fa fa fa-trash" aria-hidden="true"></i> Delete Lessons</li>
						   <li data-toggle="modal" data-target="#movemodal"> <i class="fa fa-calendar" aria-hidden="true"></i> No Class Day</li>
						</ul>
					 </div>
				  </div>
				  <!--action dropdown end --> 
			   </div>
			   <button type="submit" class="lessonsAdd btn btn-primary" name="lessonsForm" >Save</button>
			   <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> 
			</div>
		 </div>
		 <div class="modal-body">
			
			   <div class="row">
				  <div class="col-md-4 form-group">
					 <label>Class</label>
					 <p class="editlessonformtext userClass"></p>
				  </div>
				  <div class="col-md-4 form-group divStart">
					 <label>Start Time</label>
					 <input type="text" name="starttime" value="" class="input-fields startTime timepicker ui-timepicker-input">
				  </div>
				  <div class="col-md-4 form-group ">
					 <label>Units</label>
					 <select name="units" class="unitOptions">
						<option value="">Select Units</option>
					 </select>
				  </div>
			   </div>
			   <div class="row">
				  <div class="col-md-4 form-group">
					 <label>Date</label>
					 <p class="editlessonformtext selectedDate"></p>
				  </div>
				  <input type="hidden" name="lesson_date" value="" id="lesson_date">
					 <input type="hidden" name="classId" value="" id="classId">
				  <div class="col-md-4 form-group divend">
					 <label>End Time</label>
					 
					 <input type="text" name="endtime" value="" class="input-fields endTime">
				  </div>
				  <div class="col-md-4 form-group checkbox-field">
					<label>
						<input type="checkbox" name="lockLesson" value="1">
						Lock lesson to date
					</label>
				  </div>
			   </div>
			   <div class="row">
				  <div class="form-group col-md-12 titlefield">
					 <label>Title</label>
					 <input type="text" id="lessonTitle" name="title" value="" >
				  </div>
			   </div>
			   <div class="editsectiontabs">
			   	@php $plan = $user_plan->layout_name; @endphp
				  <ul class="nav nav-tabs editorTabs">
				  	@if($plan=='basic')
						<li class="lessonTab active"><a data-toggle="tab" href="#lesson">Lesson</a></li>
						<li class="homeworkTab"><a data-toggle="tab" href="#homework">Homework</a></li>
						<li class="notesTab"><a data-toggle="tab" href="#notes">Notes</a></li>
						<li class="standardTab"><a data-toggle="tab" href="#standards">Standards</a></li>
				  	@elseif($plan=='instructional')
				  		<li class="lessonTab active"><a data-toggle="tab" href="#Iobjective">Objective</a></li>
						<li class="homeworkTab"><a data-toggle="tab" href="#Idirect">Direct</a></li>
						<li class="notesTab"><a data-toggle="tab" href="#Iguided">Guided</a></li>
						<li class="standardTab"><a data-toggle="tab" href="#Iindependent">Independent</a></li>
				  		<li class="lessonTab"><a data-toggle="tab" href="#Ilesson">Lesson</a></li>
						<li class="homeworkTab"><a data-toggle="tab" href="#Ihomework">Homework</a></li>
						<li class="notesTab"><a data-toggle="tab" href="#Inotes">Notes</a></li>
						<li class="standardTab"><a data-toggle="tab" href="#Istandards">Standards</a></li>			
				  	@elseif($plan=='detailed')
				  		<li class="standardTab active"><a data-toggle="tab" href="#Dstandards">Standards</a></li>
				  		<li class="lessonTab"><a data-toggle="tab" href="#Dobjective">Objective</a></li>
						<li class="lessonTab"><a data-toggle="tab" href="#Dlesson">Lesson</a></li>
						<li class="homeworkTab"><a data-toggle="tab" href="#Ddifferentiation">Differentiation</a></li>
						<li class="homeworkTab"><a data-toggle="tab" href="#Dhomework">Homework</a></li>
						<li class="notesTab"><a data-toggle="tab" href="#Dinstructional">Instructional</a></li>
						<li class="standardTab"><a data-toggle="tab" href="#Dmaterials">Materials</a></li>
						<li class="notesTab"><a data-toggle="tab" href="#Dnotes">Notes</a></li>
						

				  	@endif

				  </ul>
				  @if($plan=='basic')
					<div class="tab-content">
						<div id="lesson" class="tab-pane fade in active">
							<div class="edittabsheader">Lesson</div>
							<div class="edittabmiddle">
							   <textarea class="editorMce" class="lessonTxt" name="lessonTxt" id="lessonTxt" placeholder="Write Somehting"></textarea>
							</div>
						</div>
						<div id="homework" class="tab-pane fade">
							<div class="edittabsheader">Homework</div>
							<div class="edittabmiddle">
							   <textarea name="homework" class="editorMce" id="homeworkTxt" placeholder="Write Somehting">

								</textarea>
							</div>
						</div>
						<div id="notes" class="tab-pane fade">
							<div class="edittabsheader">Notes</div>
							<div class="edittabmiddle">
							   <textarea class="editorMce" name="notes"  id="notesTxt" placeholder="Write Somehting">

								</textarea>
							</div>
						</div>
						<div id="standards" class="tab-pane fade">
							<div class="edittabsheader">Standards <a class="standard-button"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
							<input type="submit" name="standards[]" value="">
							<div class="edittabmiddle"></div>
						 </div>
					</div>
				@elseif($plan=='instructional')  
					<div class="tab-content">
						<div id="Iobjective" class="tab-pane fade in active">
							<div class="edittabsheader">Objective</div>
							<div class="edittabmiddle">
							   <textarea class="editorMce" name="objectiveTxt" id="objectiveTxt" placeholder="Write Somehting"></textarea>
							</div>
						</div>
						<div id="Idirect" class="tab-pane fade">
							<div class="edittabsheader">Direct Instruction</div>
							<div class="edittabmiddle">
							   <textarea class="editorMce" name="directTxt" id="directTxt" placeholder="Write Somehting"></textarea>
							</div>
						</div>
						<div id="Iguided" class="tab-pane fade">
							<div class="edittabsheader">Guided Practice</div>
							<div class="edittabmiddle">
							   <textarea class="editorMce" name="guidedTxt" id="guidedTxt" placeholder="Write Somehting"></textarea>
							</div>
						</div>
						<div id="Iindependent" class="tab-pane fade">
							<div class="edittabsheader">Independent Practice</div>
							<div class="edittabmiddle">
							   <textarea class="editorMce" name="independentTxt" id="independentTxt" placeholder="Write Somehting"></textarea>
							</div>
						</div>
						<div id="Ilesson" class="tab-pane fade">
							<div class="edittabsheader">Lesson</div>
							<div class="edittabmiddle">
							   <textarea class="editorMce" name="lessonTxt" id="lessonTxt" placeholder="Write Somehting"></textarea>
							</div>
						</div>
						<div id="Ihomework" class="tab-pane fade">
							<div class="edittabsheader">Homework</div>
							<div class="edittabmiddle">
							   <textarea name="homework" class="editorMce" id="homeworkTxt" placeholder="Write Somehting">

								</textarea>
							</div>
						</div>
						<div id="Inotes" class="tab-pane fade">
							<div class="edittabsheader">Notes</div>
							<div class="edittabmiddle">
							   <textarea class="editorMce" name="notes"  id="notesTxt" placeholder="Write Somehting">

								</textarea>
							</div>
						</div>
						<div id="Istandards" class="tab-pane fade">
							<div class="edittabsheader">Standards <a class="standard-button"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
							<input type="submit" name="standards[]" value="">
							<div class="edittabmiddle"></div>
						 </div>
					</div>
				@elseif($plan=='detailed')
					<div class="tab-content">
						<div id="Dstandards" class="tab-pane fade in active">
							<div class="edittabsheader">Standards <a class="standard-button"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
							<input type="submit" name="standards[]" value="">
							<div class="edittabmiddle"></div>
						</div>
					
						<div id="Dobjective" class="tab-pane fade ">
							<div class="edittabsheader">Objectives / Essential Question</div>
							<div class="edittabmiddle">
							   <textarea class="editorMce" name="objectiveTxt" id="objectiveTxt" placeholder="Write Somehting"></textarea>
							</div>
						</div>
						<div id="Dlesson" class="tab-pane fade">
							<div class="edittabsheader">Lesson</div>
							<div class="edittabmiddle">
							   <textarea class="editorMce" name="lessonTxt" id="lessonTxt" placeholder="Write Somehting"></textarea>
							</div>
						</div>
						<div id="Ddifferentiation" class="tab-pane fade">
							<div class="edittabsheader">Differentiation / Accommodations</div>
							<div class="edittabmiddle">
							   <textarea class="editorMce" name="differentiation" id="differentiationTxt" placeholder="Write Somehting"></textarea>
							</div>
						</div>
						<div id="Dhomework" class="tab-pane fade">
							<div class="edittabsheader">Homework</div>
							<div class="edittabmiddle">
							   <textarea name="homework" class="editorMce" id="homeworkTxt" placeholder="Write Somehting">

								</textarea>
							</div>
						</div>
						<div id="Dinstructional" class="tab-pane fade">
							<div class="edittabsheader">Instructional Strategies</div>
							<div class="edittabmiddle">
							   <textarea name="instructional" class="editorMce" id="instructionalTxt" placeholder="Write Somehting">

								</textarea>
							</div>
						</div>
						<div id="Dmaterials" class="tab-pane fade">
							<div class="edittabsheader">Materials / Resources / Technology</div>
							<div class="edittabmiddle">
							   <textarea name="material" class="editorMce" id="materialTxt" placeholder="Write Somehting">

								</textarea>
							</div>
						</div>
						<div id="Dnotes" class="tab-pane fade">
							<div class="edittabsheader">Notes</div>
							<div class="edittabmiddle">
							   <textarea class="editorMce" name="notes"  id="notesTxt" placeholder="Write Somehting">

								</textarea>
							</div>
						</div>
						
					</div>
				@endif
			   </div>
			   <div class="attachment-field">
				  <div class="form-group">
					 <label>Attachments</label>
					 <a class="main-buton attachment-button fileattachmentmain" target><img src="/images/paperclip.png"></a> <a class="main-buton attachment-button"> <img src="/images/google-drive.png"></a> </div>
			   </div>
			   <div class="filetable">
				  <table id="attachedFiles" class="attachedFiles">
					 
				  </table>
			   </div>
		 </div>
		</form>
	  </div>  
   </div>
</div>
<!--fileattachment modal start here-->
<div class="fileattachment-modal">
    <div class="fileattachment-header">My Files</div>
    <div class="fileattachment-body">
		<form name="fileattachment" id="fileAttachment" action="" method="post" enctype="multipart/form-data">
		   {{ csrf_field() }}
			<div>
				<input type="text" id="myInput" placeholder="Search File(s)" class="form-control">
			</div>
			<div class="file-attchedtext">
				<ul class="list-group checked-list-box" id="myUL">
					<div class="file-attchedmain">
						
						
					</div>
				</ul>
			</div>
			<div class="file-attchedbutton">
				<button Type="button" class="main-buton applyfilebuton filebuttons">Apply</button>
				<button type="button" class="main-buton  filebuttons">Clear all</button>
				<div class="main-buton file-attchment">
					<input type="file" id="uploadFile" name="fileuploaddata">
					<span class="upload-text">Upload New File</span> </div>
				<a href="#" class="close-filebutton filebuttons">Cancel</a>
			</div>
		</form>  
	</div>
	<div class="popupProgress" style="display:none;">
		<div class='progress' id="progress_div">
			<div class='bar' id='bar1'></div>
			<div class='percent' id='Imgpercent'>0%</div>
		</div>
    </div>		
</div>
<!--File apply and embed modal here-->
<div class="applyfilemodalcontent" id="applyfilemodal" >
  <div class="fileattachment-header">Image Actions</div>
  <div class="fileattachment-body applycontentbody ">
    <form method="post" action="#" class="applyImgForm">
      <div class="attachOrEmbedBody" id="attachOrEmbedBody"><span></span></div>
      <div class="button-group">
        <button type="button" class="main-buton fileAttach">Attach</button>
        <button type="button" class="main-buton embedfilebutton" type="button">Embed</button>
        <button type="button" class="close-button closefile-button">Cancel</button>
      </div>
    </form>
  </div>
</div>
<div class="applyfilemodalcontent embedfilecontent" id="embedfilemodal">
  <div class="fileattachment-header">Embed Image</div>
  <div class="fileattachment-body applycontentbody">
    <form method="post" action="">
      <p>Select lesson section for image</p>
      <div class="button-group">
        <button type="button" class="main-buton ebdLesson">Lesson</button>
        <button type="button" class="main-buton ebdhomework">Homework</button>
        <button type="button" class="main-buton ebdnotes">Notes</button>
        <button class="close-button closeembedfile-button" type="button">Cancel</button>
      </div>
    </form>
  </div>
</div>

<!--Standards Modal -->
<div class="standardedit-modal">
	<div class="standardeditheader"> Standards </div>
	<div class="standardedit-body">
		<form method="post" action="#">
		   <div class="row">
			  <div class="col-md-9">
				 <div class="form-group">
					<label> State/Local</label>
					<select name="commoncare">
					   <option value="cc">U.S. - Common Core</option>
					   <option value="cc">U.S. - Common Core</option>
					</select >
					<a data-toggle="modal" data-target="#standardstatemore"> more </a> 
				 </div>
				 <div class="form-group">
					<label> Grade</label>
					<select id="grade">
					   <option value="-1">Pre-K</option>
					   <option value="0" selected="selected">Kindergarten</option>
					   <option value="1">Grade 1</option>
					   <option value="2">Grade 2</option>
					   <option value="3">Grade 3</option>
					   <option value="4">Grade 4</option>
					   <option value="5">Grade 5</option>
					   <option value="6">Grade 6</option>
					   <option value="7">Grade 7</option>
					   <option value="8">Grade 8</option>
					   <option value="9">Grade 9</option>
					   <option value="10">Grade 10</option>
					   <option value="11">Grade 11</option>
					   <option value="12">Grade 12</option>
					</select>
				 </div>
				 <div class="form-group">
					<label> Subject</label>
					<select id="subject">
					   <option value="S35">I Can  - Language</option>
					   <option value="S36">I Can - Math</option>
					   <option value="S33">I Can - Reading</option>
					   <option value="S34">I Can - Writing</option>
					   <option value="L">Language</option>
					   <option value="MP">Mathematical Practice</option>
					   <option value="M">Mathematics</option>
					   <option value="RF">Reading Foundational Skills</option>
					   <option value="RI">Reading Informational Text</option>
					   <option value="RL">Reading Literature</option>
					   <option value="SL">Speaking and Listening</option>
					   <option value="W">Writing</option>
					</select>
					<a data-toggle="modal" data-target="#standardsubjectmore" > more </a> 
				 </div>
				 <div class="form-group">
					<label> Category</label>
					<select id="category">
					   <option value="VA">View All</option>
					   <option value="C1">Speaking and Listening</option>
					</select>
				 </div>
				 <div class="form-group">
					<label> Search</label>
					<input type="text">
					<a> Search </a> <a>All</a> 
				 </div>
			  </div>
			  <div class="col-md-3 pl-0 pr-0">
				 <p class="standardform-text">Standards not here? To add standards, enter them into a spreadsheet (<a href="#">click here</a> for sample file), and send to support@yellowbus.com. </p>
			  </div>
		   </div>
		   <div class="standardmodaltable">
			  <p>Click on each standard to select.</p>
			  <div class="standardtablemain">
				 <div class="well">
					<div class="header-standard"><span class="standardmodal-row1">ID</span><span class="standardtablerow2">Description</span></div>
					<ul class="list-group checked-list-box">
					   <li class="list-group-item"><span class="standardmodal-row1 standardrow1inner">K.SL.1.a</span><span class="standardtablerow2">I can listen, take turns, and talk to friends in a small group.</span></li>
					   <li class="list-group-item"><span class="standardmodal-row1 standardrow1inner">K.SL.1.b</span><span class="standardtablerow2">I can have a conversation with my friends.</span></li>
					   <li class="list-group-item"><span class="standardmodal-row1 standardrow1inner">K.SL.2</span><span class="standardtablerow2"> I can listen to a speaker then ask or answer questions to show I understand the topic.</span></li>
					   <li class="list-group-item"><span class="standardmodal-row1 standardrow1inner">K.SL.3</span><span class="standardtablerow2">I can ask and answer questions to get help or information when I don't understand.</span></li>
					   <li class="list-group-item"><span class="standardmodal-row1 standardrow1inner">K.SL.4</span><span class="standardtablerow2">I can describe people, places, things, and events.</span></li>
					   <li class="list-group-item"><span class="standardmodal-row1 standardrow1inner">K.SL.5</span><span class="standardtablerow2">I can add details to my drawings.</span></li>
					   <li class="list-group-item"><span class="standardmodal-row1 standardrow1inner">K.SL.6</span><span class="standardtablerow2">I can speak clearly to express my ideas, thoughts, and feelings.</span></li>
					   <li class="list-group-item"><span class="standardmodal-row1 standardrow1inner">K.SL.1.a</span><span class="standardtablerow2">I can print upper and lower case letters.</span></li>
					</ul>
				 </div>
			  </div>
		   </div>
		   <div class="standardmodal-buttons">
			  <button type="button" class="main-buton">Apply</button>
			  <button type="button" class="main-buton">Clear All</button>
			  <a class="cancelstandard-button"> Cancel</a> 
		   </div>
		</form>
	</div>
</div>

<!--standardstate more popup start-->
<div id="standardstatemore" class="modal fade movemodalcontent standardstatemoremodal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
		   <div class="modal-header">
			  <h4 class="modal-title">Select Standard Subjects</h4>
		   </div>
		   <div class="modal-body">
			  <div class="well statelist-main">
				 <ul class="list-group checked-list-box">
					<li class="list-group-item">Australia - National Curriculum (ACARA)</li>
					<li class="list-group-item">Australia - New South Wales</li>
					<li class="list-group-item">Australia - Victoria</li>
					<li class="list-group-item">Australia - Western Curriculum (SCSA)</li>
					<li class="list-group-item">Canada - Alberta</li>
					<li class="list-group-item">Cras justo odio</li>
					<li class="list-group-item">Canada - British Columbia</li>
					<li class="list-group-item">Canada - Manitoba</li>
					<li class="list-group-item">Canada - New Brunswick</li>
					<li class="list-group-item"> Canada - Newfoundland and Labrador</li>
				 </ul>
			  </div>
			  <div class="button-group statemore-buttons">
				 <button class="renew-button" > Save</button>
				 <button class="renew-button"> Clear All</button>
				 <button class="close-button" data-dismiss="modal"> Close</button>
			  </div>
		   </div>
		</div>
	</div>
</div>
<!--standardsubject more2 popup start-->
<div id="standardsubjectmore" class="modal fade movemodalcontent standardstatemoremodal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
		   <div class="modal-header">
			  <h4 class="modal-title">Select National/State/Local Collections</h4>
		   </div>
		    <div class="modal-body">
				<div class="well statelist-main">
					<ul class="list-group checked-list-box">
						<li class="list-group-item">I Can - Language</li>
						<li class="list-group-item">I Can - Math</li>
						<li class="list-group-item">I Can - Readinga</li>
						<li class="list-group-item">I Can - Writing</li>
						<li class="list-group-item">Languagea</li>
						<li class="list-group-item">Mathematical Practice</li>
						<li class="list-group-item">Mathematics</li>
						<li class="list-group-item">Reading Foundational Skills</li>
						<li class="list-group-item">Reading Informational Text</li>
						<li class="list-group-item">Reading Literature</li>
					</ul>
				</div>
			    <div class="button-group statemore-buttons">
					<button class="renew-button" > Save</button>
					<button class="renew-button"> Clear All</button>
					<button class="close-button" data-dismiss="modal"> Close</button>
			    </div>
		    </div>
		</div>
	</div>
</div>

<!--Move & copy Modal-->
<div id="movemodal" class="modal fade movemodalcontent in" role="dialog" style="display:none;">
	<div class="modal-dialog"> 
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Move Lesson</h4>
			</div>
			<div class="modal-body">
				<p>You are moving on your language arts lesson on <span id="moveWtxt"></span> </p>
				<p>Enter a new date and class for lesson below:</p>
				<form method="post" action="#" class="movemodal-form">
					{{ csrf_field() }}
					<div class="form-group">
					    <input type="hidden" name="classID" value="" id="classMid">
					    <input type="hidden" name="classDate" value="" id="classMdate">
						<label>Lesson Date</label>
						<input class="input-fields datepicker" name="addedTo" id="demo20" type="text">
					</div>
					<div class="form-group">
						<label>Class Name</label>
						<select id="moveLessClass" class="input-fields">
						    <option value="">--Select Class--</option> 
						</select>
					</div>
					<div class="button-group">
						<a href="" class="moveLbtn renew-button">Move Lesson</a>
						<a href="" class="copyLbtn renew-button">Copy Lesson</a>
						<a href="#" class="close-button">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>  
@endsection

@push('js')
    <!--Script to Load the Calendars-->
	<script type="text/javascript">
	$(document).ready(function() {
		var currentUrl = '@php echo $url @endphp' ;
		if(currentUrl == 'week'){
		$("#dynamicCalendarContent").load("/teacher/dashboard/weekCalendar");
			$(".get-calendar").click(function(e){

			$("#dynamicCalendarContent").load("/teacher/dashboard/weekCalendar"+$(this).attr('href') ,function(){

			});
			e.preventDefault();
		});	
		}
		else if(currentUrl == 'day'){
			$("#dynamicCalendarContent").load("/teacher/dashboard/dayCalendar");
			$(".get-calendar").click(function(e){
			$("#dynamicCalendarContent").load("/teacher/dashboard/dayCalendar"+$(this).attr('href') ,function(){
				//$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
			});

			e.preventDefault();
		});
		}
		else if(currentUrl == 'list'){
			$("#dynamicCalendarContent").load("/teacher/dashboard/listCalendar");
			$(".get-calendar").click(function(e){
			$("#dynamicCalendarContent").load("/teacher/dashboard/listCalendar"+$(this).attr('href') ,function(){
				//$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
			});

			e.preventDefault();
		});
		}

		else{
			$("#dynamicCalendarContent").load("/teacher/dashboard/showCalendar");
			$(".get-calendar").click(function(e){

			$("#dynamicCalendarContent").load("/teacher/dashboard/showCalendar"+$(this).attr('href') ,function(){

				//$('.datepicker').datepicker({format: 'dd/mm/yyyy',});
			});

			e.preventDefault();
		});
		}
		$(".copydropcrossicons").click(function(){
			  $(".lesondropdown").hide();
			 });
			 $(".renew-button").click(function(){
			  $(".actiondropdown").toggle();
			 });
			 
			 $(".standard-button").click(function(){
			  $(".standardedit-modal").show();
			 });
			 $(".close-filebutton").click(function(){
			  $(".fileattachment-modal").hide();
			 });
			 $(".cancelstandard-button").click(function(){
			  $(".standardedit-modal").hide();
			 });

	
		/*editor script*/
         tinymce.init({
           selector: '.editorMce',
           height: 400,
           theme: 'modern',
			setup: function (editor) {                  
			editor.on('focus', function(e) {
			editor.selection.select(editor.getBody(), true);
			editor.selection.collapse(false);
			});                                             
			},
           plugins: [
             'advlist autolink lists link image charmap print preview hr anchor pagebreak',
             'searchreplace wordcount visualblocks visualchars code fullscreen',
             'insertdatetime media nonbreaking save table contextmenu directionality',
             'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
           ],
           toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
           toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
           image_advtab: true,
           templates: [
             { title: 'Test template 1', content: 'Test 1' },
             { title: 'Test template 2', content: 'Test 2' }
           ],
           content_css: [
             
            
           ]
          });
   
	    /*Assign attr for add lessons form*/
			var clickedClass;  
			$("body").on('click','.editBtn',function(event){
				clickedClass = $(this).parents();
			    var classID = $(this).attr('targetId');
				var day = $(this).attr('targetDay');
				var date = $(this).attr('targetDate');
				$('#lesson_date').val(date);
			    event.preventDefault();
			    tinyMCE.triggerSave();
				$.ajax({
					  type:'POST',
					  url: BASE_URL +'/teacher/dashboard/getClasses',
					  data: {
							"_token": "{{ csrf_token() }}"	,
							"classID":classID,
							"day":day,
							"sendDate":date
							},
					  beforeSend: function () {
						//obj.html('Sending... <i class="fa fa-send"></i>');
					  },
					  complete: function () {
						//obj.html('Sent <i class="fa fa-send"></i>');
					  },
					  success: function (response){ 
					  	var plan = response.user_plan.layout_name;
						if(!response.length){
							$('#lessonTitle').val('');
						$('.unitOptions').html("<option value=''>Select Units</option>");
							if(plan=='basic'){
								tinyMCE.get('lessonTxt').setContent('');
								tinyMCE.get('homeworkTxt').setContent('');
								tinyMCE.get('notesTxt').setContent('');
							}
							else if(plan=='instructional'){
								tinyMCE.get('objectiveTxt').setContent('');
								tinyMCE.get('directTxt').setContent('');
								tinyMCE.get('guidedTxt').setContent('');
								tinyMCE.get('independentTxt').setContent('');
								tinyMCE.get('lessonTxt').setContent('');
								tinyMCE.get('homeworkTxt').setContent('');
								tinyMCE.get('notesTxt').setContent('');								
							}
							else if(plan=='detailed'){
								tinyMCE.get('objectiveTxt').setContent('');
								tinyMCE.get('lessonTxt').setContent('');
								tinyMCE.get('differentiationTxt').setContent('');
								tinyMCE.get('homeworkTxt').setContent('');
								tinyMCE.get('instructionalTxt').setContent('');
								tinyMCE.get('materialTxt').setContent('');
								tinyMCE.get('notesTxt').setContent('');
								
							}
						
						}  
						var unit;
						
						$('#classId').val(classID);
						$('.unitOptions').empty();
						/*for (unit in response.unit) {
							unit = response.unit[unit];
							if(unit != null){
							$('.unitOptions').append("<option value>"+unit+"</option>");
							}
							
							
						}*/
						var result = response.unit;
						$.each(result, function(k, v) {
						    console.log(k +'is'+ v);
						    $('.unitOptions').append("<option value='"+k+"'>"+v+"</option>");
						});
						/*if(!response.unit.length){
							$('.unitOptions').html("<option value=''>Select Units</option>");
						}*/
						var userClass = response.userClass; 
						if(response.times !=null){
							var start_time = response.times.lesson_start_time;	
							var end_time = response.times.lesson_end_time;
						}
							
						var lessonDetail = response.lessonDetails;
						var plan         = response.user_plan.layout_name; 
						if(lessonDetail!=null && lessonDetail.attachments != null ){
							$('#attachedFiles').html('');
							var attachment = lessonDetail.attachments;
							var splittedattachment = attachment.split(',');		
							for ( var i = 0;  i < splittedattachment.length; i++ ) {
								$('#attachedFiles').append("<tr style='display:block'><td class='filename' id='selectedFile'><a href='#'>"+splittedattachment[ i ]+"</a></td><td><label><input type='hidden' id='check_file' name='attach[]' value="+splittedattachment[ i ]+"> <input type='checkbox'>Private</label></td><td><div class='main-buton trash-button'><i class='fa fa-trash' aria-hidden='true'></i></div></td></tr>");
							}
					  }	
						$('.userClass').text(userClass);
						$('.selectedDate').text(date);
						if(start_time != null){
							$('.startTime').val(start_time);	
						}
						else{
							$('.divStart').html("<label>Start Time</label><input type='time' name='starttime' class='input-fields startTime'>");
						}
						if(end_time != null){
							$('.endTime').val(end_time);
							
						}
						else{
							$('.divend').html("<label>End Time</label><input type='time' name='endtime' class='input-fields endTime'>");
						}
						if(lessonDetail != null)
						{
							$('#lessonTitle').val(lessonDetail.lesson_title);
							if(plan =='basic'){
								if(lessonDetail.lesson_text !== null){
									tinyMCE.get('lessonTxt').setContent(lessonDetail.lesson_text);
								}
								else{
									tinyMCE.get('lessonTxt').setContent('');
								}
								if(lessonDetail.homework !== null){
									tinyMCE.get('homeworkTxt').setContent(lessonDetail.homework);
								}
								else{
									tinyMCE.get('homeworkTxt').setContent('');
								}
								if(lessonDetail.notes !== null){
								tinyMCE.get('notesTxt').setContent(lessonDetail.notes);
								}
								else{
									tinyMCE.get('notesTxt').setContent('');
								}
							}
							else if(plan=='instructional'){
								if(lessonDetail.objective != null){
									tinyMCE.get('objectiveTxt').setContent(lessonDetail.objective);
								}
								else{
									tinyMCE.get('objectiveTxt').setContent('');
								}	

								if(lessonDetail.direct != null){
									tinyMCE.get('directTxt').setContent(lessonDetail.direct);
								}
								else{
									tinyMCE.get('directTxt').setContent('');
								}	

								if(lessonDetail.guided != null){
									tinyMCE.get('guidedTxt').setContent(lessonDetail.guided);
								}
								else{
									tinyMCE.get('guidedTxt').setContent('');
								}	
								
								if(lessonDetail.independent != null){
									tinyMCE.get('independentTxt').setContent(lessonDetail.independent);
								}
								else{
									tinyMCE.get('independentTxt').setContent('');
								}	
				
								if(lessonDetail.lesson_text !== null){
									tinyMCE.get('lessonTxt').setContent(lessonDetail.lesson_text);
								}
								else{
									tinyMCE.get('lessonTxt').setContent('');
								}
								if(lessonDetail.homework !== null){
									tinyMCE.get('homeworkTxt').setContent(lessonDetail.homework);
								}
								else{
									tinyMCE.get('homeworkTxt').setContent('');
								}
								if(lessonDetail.notes !== null){
								tinyMCE.get('notesTxt').setContent(lessonDetail.notes);
								}
								else{
									tinyMCE.get('notesTxt').setContent('');
								}							
							}

							else if(plan =='detailed'){			
								
								if(lessonDetail.objective != null){
									tinyMCE.get('objectiveTxt').setContent(lessonDetail.objective);
								}
								else{
									tinyMCE.get('objectiveTxt').setContent('');
								}
								if(lessonDetail.lesson_text !== null){
									tinyMCE.get('lessonTxt').setContent(lessonDetail.lesson_text);
								}
								else{
									tinyMCE.get('lessonTxt').setContent('');
								}

								if(lessonDetail.differentiation != null){
									tinyMCE.get('differentiationTxt').setContent(lessonDetail.differentiation);
								}
								else{
									tinyMCE.get('differentiationTxt').setContent('');
								}
								if(lessonDetail.homework !== null){
									tinyMCE.get('homeworkTxt').setContent(lessonDetail.homework);
								}
								else{
									tinyMCE.get('homeworkTxt').setContent('');
								}
								if(lessonDetail.instructional != null){
									tinyMCE.get('instructionalTxt').setContent(lessonDetail.instructional);
								}
								else{
									tinyMCE.get('instructionalTxt').setContent('');
								}
								if(lessonDetail.material != null){
									tinyMCE.get('materialTxt').setContent(lessonDetail.material);
								}
								else{
									tinyMCE.get('materialTxt').setContent('');
								}
								if(lessonDetail.notes !== null){
									tinyMCE.get('notesTxt').setContent(lessonDetail.notes);
								}
								else{
									tinyMCE.get('notesTxt').setContent('');
								}
		
							}
							

						}
						else{
						console.log('no data');
						}
						$('#editmodal').modal();
						$('#editmodal').draggable();
						$('.modal-content').resizable();
					},
					    error: function(error){
						console.log("error");
					  }
				});
			});
			
			/*Adding lessons*/
			$( 'body' ).on( "submit",".editlessonform",function( event ) {

				  var data =  $('.editlessonform').serialize();
				  tinyMCE.triggerSave();
				  event.preventDefault();				  
				  $.ajax({
				  type:'POST',
				  url: BASE_URL +'/teacher/dashboard/addlessons',
				  data: data,
				  beforeSend: function () {
					$(".pageLoader").show();
				  },
				  complete: function () {
	
				  },

				  success: function (response) {
					$('#editmodal').modal('hide');
					if(currentUrl =='week'){	
						$("#dynamicCalendarContent").load("/teacher/dashboard/weekCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else if(currentUrl == 'day'){
						$("#dynamicCalendarContent").load("/teacher/dashboard/dayCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else if(currentUrl == 'list'){
						$("#dynamicCalendarContent").load("/teacher/dashboard/listCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else{
						$("#dynamicCalendarContent").load("/teacher/dashboard/showCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}	
				},
				  error: function(data){
					
				  }
				});
			});	
			/*Show user upload files*/
			$("body").on('click','.fileattachmentmain',function(e){
				e.preventDefault();
				$.ajax({
				  type:'get',
				  contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
				  dataType : "html",
				  data:{"_token": "{{ csrf_token() }}"},
				  url: 'authUploads',
				  success:function(response){
					$('.file-attchedmain').append(response);  
					$(".fileattachment-modal").show();
				  },
				  error: function(response){
					console.log("error");
					console.log(response);
				  }

				});	
			}) ; 
			/*End Show user upload files*/
			
			/*File upload with processing bar*/
			
			$('body').on('change','#uploadFile',function(e){
				var validExts = "*.pdf; *.jpg".replace(/\s+|\*/g, '').split(";");
				for(var i=0; i<e.target.files.length; i++){
					fileExt = e.target.files[i].name.substring(e.target.files[i].name.lastIndexOf('.'));
					if (validExts.indexOf(fileExt) < 0) {
						alert("Invalid file selected, valid files are of " + validExts.toString() + " types.");
						return false;
					}

					if(e.target.files[i].size > 300*1024*1024){
						alert("File too large, we only accept 300MB");
						return false;
					}
					$('#main-loader').css('display','block');
				}
				console.log(e.target.files);
				var $this = $(this);
				var formData = new FormData();
				formData.append("file", e.target.files[0]);
				formData.append("uploadSize", ((e.target.files[0].size)/1024).toFixed(2));
				formData.append("_token", $this.closest('form').find("[name='_token']").val());
				
				$.ajax({
					xhr: function() {
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", function(evt) {
					  if (evt.lengthComputable) {
						$('.popupProgress').css("display","block");  
						var percentComplete = evt.loaded / evt.total;
						percentComplete = parseInt(percentComplete * 100);
						console.log(percentComplete);
						var percentVal = percentComplete + '%';
						 $('#bar1').width(percentVal);
						 $('#Imgpercent').html(percentVal);
						if (percentComplete === 100) {

						}

					  }
					}, false);

					return xhr;
				  },		
				  type:'POST',
				  url: 'attachFiles',
				  data: formData,
				  cache:false,
				  contentType: false,
				  processData: false,

				  success:function(data){
					$(".file-attchedmain").load("authUploads"); 
					//$('#main-loader').css('display','none');
					setTimeout(function(){
						$('.popupProgress').css("display","none"); 
						
					}, 1000); 	
					},
					error: function(data){
					console.log("error");
					console.log(data);
				  }

				});
			}); 
			$('.datepicker').datepicker({format: 'yyyy-mm-dd',autoclose:true});
		
		
			/*Move Lesson Popup Attr Assign*/
			
			$('body').on('click','#moveBtn',function(){
			var classID = $(this).attr('targetID');	
			var className = $(this).attr('targetClass');	
			var classDate = $(this).attr('targetDate');	
			var sqlDate =  classDate.split(' ');
			$('#classMdate').val(sqlDate[1]);
			$('#moveWtxt').html(classDate);
			$('#classMid').val(classID);
			$('#moveLessClass').html("<option value='"+className+"'>"+className+"</option>");	
			$('#movemodal').modal();
			});
			
			/*Move Lesson submit data*/
			$('body').on('click','.moveLbtn',function(event){
			var data = $(this).closest('form').serialize();	
		    event.preventDefault();		
			$.ajax({
				  type:'POST',
				  url: BASE_URL +'/teacher/dashboard/movelessons',
				  data:data,
				  beforeSend: function () {
					$(".pageLoader").show();  
				  },
				  complete: function () {	
				  },

				  success: function (response) {
					$('#movemodal').modal('hide');
					if(currentUrl =='week'){	
						$("#dynamicCalendarContent").load("/teacher/dashboard/weekCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else if(currentUrl == 'day'){
						$("#dynamicCalendarContent").load("/teacher/dashboard/dayCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else if(currentUrl == 'list'){
						$("#dynamicCalendarContent").load("/teacher/dashboard/listCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else{
						$("#dynamicCalendarContent").load("/teacher/dashboard/showCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}	
					
				},
				  error: function(data){
				  }
				});
			
			/*Copy Lesson submit data*/
			$('body').on('click','.copyLbtn',function(event){
			var data = $(this).closest('form').serialize();	
		    event.preventDefault();		
			$.ajax({
				  type:'POST',
				  url: BASE_URL +'/teacher/dashboard/copylessons',
				  data:data,
				  beforeSend: function () {
				  },
				  complete: function () {	
				  },

				  success: function (response) {
					$('#movemodal').modal('hide');
					if(currentUrl =='week'){	
						$("#dynamicCalendarContent").load("/teacher/dashboard/weekCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else if(currentUrl == 'day'){
						$("#dynamicCalendarContent").load("/teacher/dashboard/dayCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else if(currentUrl == 'list'){
						$("#dynamicCalendarContent").load("/teacher/dashboard/listCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}
					else{
						$("#dynamicCalendarContent").load("/teacher/dashboard/showCalendar" ,function(){
							$(".pageLoader").hide();  
						});
					}	
				},
				  error: function(data){
				  }
				});
			});	
			
		});
		 
		$( "body" ).on('keyup','#myInput',function() {
			var value = $(this).val();
			$("#myUL li").each(function () {
				if ($(this).text().search(value) > -1) {
					$(this).show();
				} else {
					$(this).hide();
				}
			});	
		});
	
	<!--Apply images and embed script-->

		 $(".closefile-button").click(function(){
          $("#applyfilemodal").hide();
         });
			$("body").on('click','.applyfilebuton',function(){
			$('.fileattachment-modal').css('display','none');
			$("#applyfilemodal").show();
			
			});
			$('body').on('click','.fileAttach',function(){
				$('.attachedFiles tr').css('display','block');
				$('#applyfilemodal').hide();
			});
			$('body').on('click','.ebdLesson',function(){
				$("#applyfilemodalcontent").hide();
				var id = tinymce.activeEditor.selection.getNode().id;
				$('.lessonTab').addClass('active').siblings().removeClass('active');
				if($('#homework').hasClass('active') || $('#notes').hasClass('active')){
				$('#homework').removeClass('active');
				$('#notes').removeClass('active');
				$('#lesson').addClass('active in'); 
				}
				   var val = tinymce.get('lessonTxt').getContent();
					tinymce.execCommand('mceFocus',false,'lessonTxt');
					$("form.applyImgForm :input[name = embID]").each(function(index, elm){
						var imgVal = $(this).val();
						tinymce.get('lessonTxt').execCommand("mceInsertContent", false, "<br/><img style='width:200px; max-width: 100%; height: 200px;' src='/uploads/myfiles/"+imgVal+"'/>");
					});
					$("#embedfilemodal").hide();
					});
			$('body').on('click','.ebdhomework',function(){
				$("#applyfilemodalcontent").hide();
				$('.homeworkTab').addClass('active').siblings().removeClass('active');
				if($('#lesson').hasClass('active') || $('#notes').hasClass('active')){
				$('#lesson').removeClass('active');
				$('#notes').removeClass('active');
				$('#homework').addClass('active in'); 
				}
				$("form.applyImgForm :input[name = embID]").each(function(index, elm){
						var imgVal = $(this).val();
						tinymce.get('homeworkTxt').execCommand("mceInsertContent", false, "<br/><img style='width:200px; max-width: 100%; height: 200px;' src='/uploads/myfiles/"+imgVal+"'/>");
					});
				$("#embedfilemodal").hide();	
			});
			$('body').on('click','.ebdnotes',function(){
				$("#applyfilemodalcontent").hide();
				$('.notesTab').addClass('active').siblings().removeClass('active');
				if($('#lesson').hasClass('active') || $('#homework').hasClass('active')){
				$('#lesson').removeClass('active');
				$('#homework').removeClass('active');
				$('#notes').addClass('active in'); 
				}
				$("form.applyImgForm :input[name = embID]").each(function(index, elm){
						var imgVal = $(this).val();
						tinymce.get('notesTxt').execCommand("mceInsertContent", false, "<br/><img style='width:200px; max-width: 100%; height: 200px;' src='/uploads/myfiles/"+imgVal+"'/>");
					});
				$("#embedfilemodal").hide();
			});
		  $(".embedfilebutton").click(function(){
          $("#embedfilemodal").show();
		  $('#applyfilemodal').hide();
         });
		  $(".closeembedfile-button").click(function(){
          $("#embedfilemodal").hide();
         });
	});	 
	
	
	
	</script>
	<script type="text/javascript">
		$(window).load(function() {
			$(".pageLoader").hide();
			if(('.appendText .t-cel:last-child').length!=0){
				$('.appendText .t-cel:last-child').css('border-bottom','none');	
			}
			else{
				$('.appendText .t-cel:last-child').css('border-bottom','none');	
			}
		});
		$(document).ready(function(){
		  $('.appendText .t-cel:last-child').css('border-bottom','none');
		});
	</script>
	<script>
		$('.view-dropdown').on('click', function(event){
			event.stopPropagation();
		});
		/*https://medium.com/@krunallathiya/login-with-facebook-in-laravel-5-4-3c783fdc2b9d*/
	</script>	


@endpush
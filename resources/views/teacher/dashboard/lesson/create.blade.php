<div class="modal-dialog"> 
  <!-- Modal content-->
  <div class="modal-content">
	 <div class="modal-header">
		<div class="normalLesson pull-left">
		   <p>Lesson</p>
		</div>
		<div class="actionright pull-right">
		   <div class="actionbutton">
			  <button class="actiondropbutton renew-button">Actions <span class="caret"></span></button>
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
		   <input  type="submit" class="actiondropbutton renew-button" value="Save"></input >
		   <a class="closebutton" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true"></i></a> </div>
	 </div>
	 <div class="modal-body">
		
		   <div class="row">
			  <div class="col-md-4 form-group">
				 <label>Class</label>
				 <input type="hidden" name="user_id" value="">
				 @php  $classID = $filters['id']; @endphp
            	 <input type="hidden" name="class_id" value="{{ $classID }}">			 
				 <p class="editlessonformtext">{{ $filters['class_name'] }}</p>
			  </div>
			  <div class="col-md-4 form-group">
				 <label>Start Time</label>
				 @if($classStartTime)
			
				 <input type="text" name="starttime" value="{{ $classStartTime }}" class="input-fields">
				 @else
				<input type="time" name="starttime" value="" class="input-fields"> 
				 
				 @endif
			  </div>
			  <div class="col-md-4 form-group">
				 <label>Units</label>
				 <select name="units">
					<option value="">Select Units</option>
					@foreach($units as $unit)
					<option value="{{ $unit->unit_title }}">{{ $unit->unit_title }}</option>
					@endforeach
				 </select>
			  </div>
		   </div>
		   <div class="row">
			  <div class="col-md-4 form-group">
				 <label>Date</label>
				 @php $dateCurrent = date('l m/d/Y', strtotime($daysName)); 
					  $sendDate = date('Y-d-m', strtotime($daysName))
				 @endphp
				 <p class="editlessonformtext">{{ $dateCurrent }}</p>
				 <input type="hidden" name="lesson_date" value="{{ $sendDate }}">
			  </div>
			  <div class="col-md-4 form-group">
				 <label>End Time</label>
				 @if($classEndTime)
				 <input type="text" name="endtime" value="{{ $classEndTime }}" class="input-fields">
				 @else
					<input type="time" name="endtime" value="" class="input-fields"> 
				 @endif
			  </div>
			  <div class="col-md-4 form-group checkbox-field">
				 <label>
					<input type="checkbox" name="lockLesson" value="1">
					Lock lesson to date</label>
			  </div>
		   </div>
		   <div class="row">
			  <div class="form-group col-md-12 titlefield">
				 <label>Title</label>
				 <input type="text" name="lessonTitle">
			  </div>
		   </div>
		   <div class="editsectiontabs">
			  <ul class="nav nav-tabs">
				 <li class="active"><a data-toggle="tab" href="#lesson">Lesson</a></li>
				 <li><a data-toggle="tab" href="#homework">Homework</a></li>
				 <li><a data-toggle="tab" href="#notes">Notes</a></li>
				 <li><a data-toggle="tab" href="#standards">Standards</a></li>
			  </ul>
			  <div class="tab-content">
				 <div id="lesson" class="tab-pane fade in active">
					<div class="edittabsheader">Lesson</div>
					<div class="edittabmiddle">
					   <textarea name="lessonTxt" placeholder="Write Somehting">    </textarea>
					</div>
				 </div>
				 <div id="homework" class="tab-pane fade">
					<div class="edittabsheader">Homework</div>
					<div class="edittabmiddle">
					   <textarea name="homeworkTxt" placeholder="Write Somehting">

						</textarea>
					</div>
				 </div>
				 <div id="notes" class="tab-pane fade">
					<div class="edittabsheader">Notes</div>
					<div class="edittabmiddle">
					   <textarea name="notesTxt" placeholder="Write Somehting">

						</textarea>
					</div>
				 </div>
				 <div id="standards" class="tab-pane fade">
					<div class="edittabsheader">Standards <a class="standard-button"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
					<div class="edittabmiddle"></div>
				 </div>
			  </div>
		   </div>
		   <div class="attachment-field">
			  <div class="form-group">
				 <label>Attachments</label>
				 <a class="main-buton attachment-button fileattachmentmain"> <img src="/images/paperclip.png"></a> <a class="main-buton attachment-button"> <img src="/images/google-drive.png"></a> </div>
		   </div>
		   <div class="filetable">
			  <table>
				 <tr>
					<td class="filename"><a href="#"> site.jpg </a></td>
					<td><label>
						  <input type="checkbox">
						  Private</label></td>
					<td><div class="main-buton trash-button"><i class="fa fa-trash" aria-hidden="true"></i></div></td>
				 </tr>
			  </table>
		   </div>
		
	 </div>
  </div>
</div>
<div class="fileattachment-modal" style="display: none;">
  <div class="fileattachment-header">My Files</div>
  <div class="fileattachment-body">
    <div>
      <input placeholder="Search File(s)" id="filterFilePickerFiles" type="text" class="file-attchedinput">
    </div>
    <div class="file-attchedtext"> </div>
    <div class="file-attchedbutton">
      <button class="main-buton filebuttons">Apply</button>
      <button class="main-buton  filebuttons">Clear all</button>
      <div class="main-buton file-attchment">
        <input type="file" name="fileToUpload">
        <span class="upload-text">Upload New File</span> </div>
      <button class="close-filebutton filebuttons">Cancel</button>
    </div>
  </div>
</div>							   
<div class="standardedit-modal" style="display:none;">
  <div class="standardeditheader"> Standards </div>
  <div class="standardedit-body">
      <div class="row">
        <div class="col-md-9">
          <div class="form-group">
            <label> State/Local</label>
            <select name="commoncare">
              <option value="cc">U.S. - Common Core</option>
              <option value="cc">U.S. - Common Core</option>
            </select>
            <a data-toggle="modal" data-target="#standardstatemore"> more </a> </div>
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
            <a data-toggle="modal" data-target="#standardsubjectmore"> more </a> </div>
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
            <a> Search </a> <a>All</a> </div>
        </div>
        <div class="col-md-3 pl-0 pr-0">
          <p class="standardform-text">Standards not here? To add standards, enter them into a spreadsheet (<a href="#">click here</a> for sample file), and send to support@yellowbus.com. </p>
        </div>
      </div>
      <div class="standardmodaltable">
        <p>Click on each standard to select.</p>
        <div class="standardtable-inner">
          <table class="table" border="1">
            <thead>
              <tr>
                <th>ID</th>
                <th class="description-field">Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="checkbox" name="k1">
                  K.SL.1.a</td>
                <td>I can listen, take turns, and talk to friends in a small group.</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="k2">
                  K.SL.1.b</td>
                <td>I can have a conversation with my friends.</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="k3">
                  K.SL.2</td>
                <td>I can listen to a speaker then ask or answer questions to show I understand the topic.</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="k4">
                  K.SL.3</td>
                <td>I can ask and answer questions to get help or information when I don't understand.</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="k5">
                  K.SL.4</td>
                <td>I can ask and answer questions to get help or information when I don't understand.</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="k6">
                  K.SL.5</td>
                <td>I can ask and answer questions to get help or information when I don't understand.</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="k7">
                  K.SL.6</td>
                <td>I can ask and answer questions to get help or information when I don't understand.</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="k8">
                  K.SL.7</td>
                <td>I can ask and answer questions to get help or information when I don't understand.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="standardmodal-buttons">
        <button type="button" class="main-buton">Apply</button>
        <button type="button" class="main-buton">Clear All</button>
        <a class="cancelstandard-button"> Cancel</a> </div>
  </div>
</div>	
	   
	<script>
         tinymce.init({
           selector: 'textarea',
           height: 400,
           theme: 'modern',
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
    </script>
	<!--Count check boxes-->	
	<script>
		var increment =0;
		
		$(document).on("change", ':checkbox', function(event) { 
		   if(this.checked){
               increment++;
			   $('.btn-copy').html(increment);
			}
			else{
				increment--;
				$('.btn-copy').html(increment);
			}
			if(increment=='0'){
			$('.btn-copy').html('All');	
			}
			
		});
		<!--Increment and Decrement-->
		$(document).on("click", '.incrementBtn', function(event) {
		var val = $(this).siblings(".copydropdown-value").val();
		if(val<=9){
			val++;
		}
		$(this).siblings(".copydropdown-value").val(val);
		});
		$(document).on("click", '.decrementBtn', function(event) {
		var val = $(this).siblings(".copydropdown-value").val();
		if(val>=1){
			val--;
		}
		$(this).siblings(".copydropdown-value").val(val);
		});
		$(".fileattachmentmain").click(function(){
          $(".fileattachment-modal").show();
         });
		 $(".close-filebutton").click(function(){
          $(".fileattachment-modal").hide();
         });
		  $(".standard-button").click(function(){
          $(".standardedit-modal").show();
         });
         
         
		 $(".cancelstandard-button").click(function(){
          $(".standardedit-modal").hide();
         });
	</script>